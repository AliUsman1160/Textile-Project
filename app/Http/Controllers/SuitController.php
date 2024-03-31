<?php

namespace App\Http\Controllers;

use App\Models\Suitpurchase;
use App\Models\Variety;
use Illuminate\Http\Request;
use App\Models\Suitsale;
use App\Models\Purchaser;
use App\Models\Supplier;
use Carbon\Carbon;


class SuitController extends Controller
{
    public function Sale_Suit()
    {
        $purchasers = Purchaser::all();

        $suitsales = Suitsale::selectRaw('
            MAX(id) as id,
            purchaser,
            GROUP_CONCAT(variety) as varieties,
            SUM(totalPrice) as total_price,
            billid,
            addby,
            MIN(created_at) as created_at
        ')
        ->groupBy('purchaser')
        ->groupBy('billid')
        ->groupBy('addby')
        ->orderBy('created_at', 'desc')
        ->paginate(10);


      
        return view('suit.salesuit', ['suitsales' => $suitsales, 'purchasers'=> $purchasers]);
    }
    public function Add_slae_suit()
    {
        $purchasers = Purchaser::all(); 
        $varieties = Variety::all(); 
        return view("suit.addsalesuit", compact('purchasers','varieties'));
    }
    

    public function AddSuitSaleeRecord(Request $request)
    {
        $lastBillId = Suitsale::orderBy('id', 'desc')->value('billid');
        $updatedBillId = $lastBillId !== null ? $lastBillId + 1 : 1;

        $addedVarieties = json_decode($request->input('added_varieties'), true);
        $purchaser = $request->input('purchaser');
        $totalbill = $request->input('total_bill');
        
        $user = auth()->user();
        $userName = $user->name;
        foreach ($addedVarieties as $variety) {
            $variety['purchaser'] = $purchaser;
            $variety['billid'] = $updatedBillId;
            $variety['addby'] = $userName;
            Suitsale::create($variety);
            $varietyrecord = Variety::where('name', $variety['variety'])->first();
            if($varietyrecord){
                $varietyrecord->meter =  $varietyrecord->meter - $variety['meter'];
                $varietyrecord->save();
            }

        }

        $purchaser = Purchaser::where('name', $purchaser)->first();

        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price + $totalbill;
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }

        // dd("All good.");
        return redirect()->route('slae_suit')->with('add', true);
    }

    public function DeleteSuitSale($id){
        $records = Suitsale::where('billid', $id)->get();
        $totalPrice = $records->sum('totalPrice');
        $purchaser = $records->isEmpty() ? null : $records->first()->purchaser;
        $suitsales =   Suitsale::where('billid', $id)->get();
        foreach( $suitsales as $suitale ){
            $varietyrecord = Variety::where('name', $suitale['variety'])->first();
            if($varietyrecord){
                $varietyrecord->meter =  $varietyrecord->meter + $suitale['meter'];
                $varietyrecord->save();
            }
        }
        Suitsale::where('billid', $id)->delete();

       
        $purchaser = Purchaser::where('name', $purchaser)->first();
        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price - $totalPrice;
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }


        return redirect()->route('slae_suit')->with('delete', true);
    }

  

    public function suitsalefilter(Request $request)
    {
        $request->validate([
            'purchaser' => 'nullable|string',
            'date' => 'nullable|date',
        ]);
    
        $query = Suitsale::selectRaw('
                MAX(id) as id,
                purchaser,
                GROUP_CONCAT(variety) as varieties,
                SUM(totalPrice) as total_price,
                billid,
                addby,
                MIN(created_at) as created_at
            ')
            ->groupBy('purchaser')
            ->groupBy('billid')
            ->groupBy('addby')
            ->orderBy('created_at', 'desc');
           
    
        if ($request->filled('purchaser')) {
            $query->where('purchaser', '=', $request->input('purchaser'));
        }
    
        if ($request->filled('date') && $request->input('date') !== "null") {
            $formattedDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            $query->whereDate('created_at', '=', $formattedDate);
        }
    
        $suitsales = $query->paginate(10); // Use get() instead of paginate(20)
    
        $purchasers = Purchaser::all();
        return view('suit.salesuit', ['suitsales' => $suitsales, 'purchasers' => $purchasers]);
    }
    public function Purchase_suit()
    {
    
        $suppliers = Supplier::all();
    
        $suitpurchases = Suitpurchase::orderBy('created_at', 'desc')->paginate(10);
        return view('suit.purchasesuit', ['suitpurchases' => $suitpurchases, 'suppliers'=> $suppliers]);
    }
    
    public function Add_purchase_suit()
    {
        $varities = Variety::all();
        $suppliers = Supplier::all(); 

        return view("suit.addpurchasesuit", ['suppliers' => $suppliers, 'varities'=> $varities]);

    }

    public function AddSuitPurchaseRecord(Request $request){
        $validatedData = $request->validate([
            'variety'=> 'required|string',
            'meter'=> 'required|numeric',
            'price' => 'required|numeric',
            'supplier' => 'required|string',
            'pay_price' => 'nullable|numeric|lte:' . request()->input('price'),
        ]);

        $panding_price = $validatedData['price'] - ($validatedData['pay_price'] ?? 0);
        $payment_status = $panding_price === 0 ? 'payed' : 'pending';

        $suitpurchase = new Suitpurchase([
            'variety' => $validatedData['variety'],
            'meter' => $validatedData['meter'],
            'price' => $validatedData['price'],
            'pay_price' => $validatedData['pay_price'],
            'panding_price' => $panding_price,
            'supplier' => $validatedData['supplier'],
            'payment_status' => $payment_status,
        ]);
        $suitpurchase->save();

        $supplier = Supplier::where('name', $validatedData['supplier'])->first();

        if ($supplier) {
            $supplier->panding_price = $supplier->panding_price + $panding_price;
            if($supplier->panding_price > 0){
                $supplier->save();
            }else{
                $supplier->panding_price = 0;
            }
            $supplier->save();
        }

        $varity = Variety::where('name', $validatedData['variety'])->first();

        if ($varity) {
            $varity->meter = $varity->meter + $validatedData['meter'];
            $varity->save();
        }



        return redirect()->route('purchase_suit')->with('add', true);

    }

    public function DeleteSuitPurchase($id){
        $suitsPurchase = Suitpurchase::find($id);
        $pre_panding_price = $suitsPurchase->panding_price;
        $pre_meter = $suitsPurchase->meter;
        $supplier = Supplier::where('name', $suitsPurchase->supplier)->first();
        if ($supplier) {
            $supplier->panding_price = $supplier->panding_price - $pre_panding_price;
            if($supplier->panding_price > 0){
                $supplier->save();
            }else{
                $supplier->panding_price = 0;
            }
            $supplier->save();
        }
        $varity = Variety::where('name', $suitsPurchase->variety)->first();
        if ($varity) {
            $varity->meter = $varity->meter - $pre_meter;
            $varity->save();
        }
        if (!$suitsPurchase) {
            return redirect()->route('slae_yarn')->with('error', 'suitsPurchase record not found.');
        }

        $suitsPurchase->delete();

        return redirect()->route('purchase_suit')->with('delete', true);
    }

    public function EditSuitPurchasePage(Request $request){
        $suitpurchase = Suitpurchase::findOrFail($request->id);
        $suppliers = Supplier::all(); 
        $varities = Variety::all();
        return view('suit.updatepurchasesuit', compact('suitpurchase', 'suppliers', 'varities'));
    }
    

    public function updatesuitpurchase(Request $request, $id){
        $validatedData = $request->validate([
            'variety'=> 'required|string',
            'meter'=> 'required|numeric',
            'price' => 'required|numeric',
            'supplier' => 'required|string',
            'pay_price' => 'nullable|numeric|lte:' . request()->input('price'),
        ]);
        $panding_price = $validatedData['price'] - ($validatedData['pay_price'] ?? 0);
        $payment_status = $panding_price === 0 ? 'payed' : 'pending';

        $suitPurchase = Suitpurchase::findOrFail($id);
        $pre_panding_price = $suitPurchase->panding_price;
        $pre_meter = $suitPurchase->meter;
        $supplier = Supplier::where('name', $suitPurchase->supplier)->first();
        if ($supplier) {
            $supplier->panding_price = $supplier->panding_price - $pre_panding_price;
            if($supplier->panding_price > 0){
                $supplier->save();
            }else{
                $supplier->panding_price = 0;
            }
            $supplier->save();
        }
        $variety = Variety::where('name', $suitPurchase->variety)->first();
        if ($variety) {
            $variety->meter = $variety->meter - $pre_meter;
            if($variety->meter >= 0) {
                $variety->save();
            }
        }
    
        $suitPurchase->update([
            'variety' => $validatedData['variety'],
            'meter' => $validatedData['meter'],
            'price' => $validatedData['price'],
            'pay_price' => $validatedData['pay_price'],
            'panding_price' => $panding_price,
            'supplier' => $validatedData['supplier'],
            'payment_status' => $payment_status,
        ]);
        $supplier = Supplier::where('name', $validatedData['supplier'])->first();
        if ($supplier) {
            $supplier->panding_price = $supplier->panding_price + $panding_price;
            if($supplier->panding_price > 0){
                $supplier->save();
            }else{
                $supplier->panding_price = 0;
            }
            $supplier->save();
        }

        
        $varity = Variety::where('name', $validatedData['variety'])->first();

        if ($varity) {
            $varity->meter = $varity->meter + $validatedData['meter'];
            $varity->save();
        }
        return redirect()->route('purchase_suit')->with('Update', true);
    }

    public function suitpurchasefilter(Request $request){  
        $request->validate([
            'payment_status' => 'nullable|string',
            'supplier' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $query = Suitpurchase::orderBy('created_at', 'desc');

        if ($request->filled('payment_status')) {
            $query->where('payment_status', '=', $request->input('payment_status'));
        }

        if ($request->filled('supplier')) {
            $query->where('supplier', '=', $request->input('supplier'));
        }

        if ($request->filled('date') && $request->input('date') !== "null") {
            $formattedDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            $query->whereDate('updated_at', '=', $formattedDate);
        }

        $suppliers = Supplier::all();
        $suitpurchases = $query->paginate(10);
        return view('suit.purchasesuit', ['suitpurchases' => $suitpurchases, 'suppliers'=> $suppliers]);

    }
}
