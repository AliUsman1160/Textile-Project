<?php

namespace App\Http\Controllers;

use App\Models\YarnInventory;
use App\Models\Yarnsale;
use App\Models\Yarnpurchase;
use Illuminate\Http\Request;
use App\Models\Purchaser;
use App\Models\Broker;
use App\Models\Supplier;
use Carbon\Carbon;




class YarnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function Sale_Yarn()
    {
        $purchasers = Purchaser::all();
        $yarnsales = Yarnsale::orderBy('created_at', 'desc')->paginate(10);
        return view('Yarn.saleyarn', ['yarnsales' => $yarnsales, 'purchasers' => $purchasers]);
    }

    public function Add_slae_yarn()
    {
        $purchasers = Purchaser::all();
        $brokers = Broker::all();

        return view('Yarn.addSaleYarn', [
            'purchasers' => $purchasers,
            'brokers' => $brokers,
        ]);
    }

    public function AddYarnSaleRecod(Request $request)
    {

        $validatedData = $request->validate([
            'bag' => 'required|numeric|min:0',
            'cones' => 'required|numeric|min:0',
            'count' => 'required|numeric|min:0',
            'type' => 'required|string',
            'brand' => 'required|string',
            'purchaser' => 'required|string',
            'price_bag' => 'required|numeric|min:0',
            'broker' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'received_price' => 'required|numeric|lte:' . request()->input('total_price'),
        ]);
        
        $panding_price = $validatedData['total_price'] - ($validatedData['received_price'] ?? 0);
        
        $payment_status = $panding_price === 0 ? 'received' : 'pending';
        $user = auth()->user();
        $userName = $user->name;

        $existingRecord = YarnInventory::where('cones', $validatedData['cones'])
        ->where('count', $validatedData['count'])
        ->where('type', $validatedData['type'])
        ->first();

        if($existingRecord && ( $validatedData['bag'] >  $existingRecord->bag)){
            return redirect()->route('slae_yarn')->with('invontry_error', true);
        }

        if ($existingRecord && ($existingRecord->bag >  $validatedData['bag'])) {
            $existingRecord->update([
                'bag' => $existingRecord->bag -  $validatedData['bag'] ,
            ]);
        }else{
            return redirect()->route('slae_yarn')->with('invontry_error', true);
        }
    

        $yarnsale = new Yarnsale([
            'bag' => $validatedData['bag'],
            'cones' => $validatedData['cones'],
            'count' => $validatedData['count'],
            'type' => $validatedData['type'],
            'brand' => $validatedData['brand'],
            'purchaser' => $validatedData['purchaser'],
            'price_bag' => $validatedData['price_bag'],
            'broker' => $validatedData['broker'],
            'total_price' => $validatedData['total_price'],
            'received_price' => $validatedData['received_price'],
            'panding_price' => $panding_price,
            'payment_status' => $payment_status,
            'addby' => $userName,
        ]);
        
        $yarnsale->save();
        $purchaser = Purchaser::where('name', $validatedData['purchaser'])->first();

        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price + $panding_price;
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }

       

        return redirect()->route('slae_yarn')->with('add', true);
    }

    public function deleteYarnSale($id)
    {
        $yarnSale = Yarnsale::find($id);
        $existingRecord = YarnInventory::where('cones',  $yarnSale->cones)
        ->where('count', $yarnSale->count)
        ->where('type', $yarnSale->type)
        ->first();

        if ($existingRecord) {
            $existingRecord->update([
                'bag' => $existingRecord->bag + $yarnSale->bag,
            ]);
        }


        $pre_panding_price = $yarnSale->panding_price;
        $purchaser = Purchaser::where('name', $yarnSale->purchaser)->first();
        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price - $pre_panding_price;
            $purchaser->save();
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }

        $yarnsale = Yarnsale::find($id);
        if (!$yarnsale) {
            return redirect()->route('slae_yarn')->with('error', 'Yarnsale record not found.');
        }

        $yarnsale->delete();
        return redirect()->route('slae_yarn')->with('delete', true);
    }

    public function EditYarnSalePage(Request $request)
    {
        $yarnSale = YarnSale::findOrFail($request->id);
        $purchasers = Purchaser::all();
        $brokers = Broker::all();

        return view('Yarn.updateSaleYarn', compact('yarnSale', 'purchasers', 'brokers'));
    }


    public function updateSaleYarnRecord(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bag' => 'required|numeric|min:0',
            'cones' => 'required|numeric|min:0',
            'count' => 'required|numeric|min:0',
            'type' => 'required|string',
            'brand' => 'required|string',
            'purchaser' => 'required|string',
            'price_bag' => 'required|numeric|min:0',
            'broker' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'received_price' => 'nullable|numeric|lte:' . request()->input('total_price'),
        ]);
        $panding_price = $validatedData['total_price'] - ($validatedData['received_price'] ?? 0);
        $payment_status = $panding_price === 0 ? 'received' : 'pending';

        $yarnSale = Yarnsale::find($id);
        $pre_panding_price = $yarnSale->panding_price;
        $purchaser = Purchaser::where('name', $yarnSale->purchaser)->first();
        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price - $pre_panding_price;
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }


        $yarnSale = YarnSale::findOrFail($id);
        $existingRecord = YarnInventory::where('cones', $validatedData['cones'])
        ->where('count', $validatedData['count'])
        ->where('type', $validatedData['type'])
        ->first();

    
        if($existingRecord && ( $validatedData['bag'] >  ($existingRecord->bag + $yarnSale->bag))){
            return redirect()->route('slae_yarn')->with('invontry_error', true);
        }

        if ($existingRecord) {
            $existingRecord->update([
                'bag' => $existingRecord->bag + $yarnSale->bag,
            ]);
        }
       
        $yarnSale->update([
            'bag' => $validatedData['bag'],
            'cones' => $validatedData['cones'],
            'count' => $validatedData['count'],
            'type' => $validatedData['type'],
            'brand' => $validatedData['brand'],
            'purchaser' => $validatedData['purchaser'],
            'price_bag' => $validatedData['price_bag'],
            'broker' => $validatedData['broker'],
            'total_price' => $validatedData['total_price'],
            'received_price' => $validatedData['received_price'],
            'panding_price' => $panding_price,
            'payment_status' => $payment_status,
        ]);
        $purchaser = Purchaser::where('name', $validatedData['purchaser'])->first();

        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price + $panding_price;
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }
        $existingRecord = YarnInventory::where('cones', $validatedData['cones'])
        ->where('count', $validatedData['count'])
        ->where('type', $validatedData['type'])
        ->first();

        if ($existingRecord) {
            $existingRecord->update([
                'bag' => $existingRecord->bag - $validatedData['bag'],
            ]);
        }

        return redirect()->route('slae_yarn')->with('Update', true);
    }


    public function yarnsalefilter(Request $request)
    {

        $request->validate([
            'payment_status' => 'nullable|string',
            'purchaser' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $query = Yarnsale::orderBy('created_at', 'desc');

        if ($request->filled('payment_status')) {
            $query->where('payment_status', '=', $request->input('payment_status'));
        }

        if ($request->filled('purchaser')) {
            $query->where('purchaser', '=', $request->input('purchaser'));
        }

        if ($request->filled('date') && $request->input('date') !== "null") {
            $formattedDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            $query->whereDate('updated_at', '=', $formattedDate);
        }

        $yarnsales = $query->paginate(20);

        $purchasers = Purchaser::all();
        return view('Yarn.saleyarn', ['yarnsales' => $yarnsales, 'purchasers' => $purchasers]);
    }








    public function Sale_Yarn_Payments()
    {
        $salepayments = YarnSale::select('purchaser')
            ->selectRaw('COUNT(*) AS num_records, SUM(total_price) AS total_price')
            ->where('payment_status', 'notreceived')
            ->groupBy('purchaser')
            ->havingRaw('num_records >= 1')
            ->get();

        return view('Yarn.salepayments', ['salepayments' => $salepayments]);

    }



    public function Purchace_yarn()
    {
        $suppliers = Supplier::all();

        $yarnpurchases = Yarnpurchase::orderBy('created_at', 'desc')->paginate(10);
        return view('Yarn.purchaceYarn', ['yarnpurchases' => $yarnpurchases, 'suppliers' => $suppliers]);
    }

    public function Add_purchace_yarn()
    {
        // Fetch all suppliers from the database
        $suppliers = Supplier::all(); // Assuming Supplier is your model for suppliers

        // Fetch all brokers from the database
        $brokers = Broker::all(); // Assuming Broker is your model for brokers

        return view('Yarn.addPurchaceYarn', ['suppliers' => $suppliers, 'brokers' => $brokers]);
    }


    public function AddYarnPurchaceRecod(Request $request)
    {
        $validatedData = $request->validate([
            'bag' => 'required|numeric|min:0',
            'cones' => 'required|numeric|min:0',
            'count' => 'required|numeric|min:0',
            'type' => 'required|string',
            'brand' => 'required|string',
            'supplier' => 'required|string',
            'price_bag' => 'required|numeric|min:0',
            'broker' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'pay_price' => 'required|numeric|lte:' . request()->input('total_price'),
        ]);
        
        $panding_price = $validatedData['total_price'] - ($validatedData['pay_price'] ?? 0);
        $payment_status = $panding_price === 0 ? 'payed' : 'pending';
        
        $user = auth()->user();
        $userName = $user->name;

        $Yarnpurchase = new Yarnpurchase([
            'bag' => $validatedData['bag'],
            'cones' => $validatedData['cones'],
            'count' => $validatedData['count'],
            'type' => $validatedData['type'],
            'brand' => $validatedData['brand'],
            'supplier' => $validatedData['supplier'],
            'price_bag' => $validatedData['price_bag'],
            'broker' => $validatedData['broker'],
            'total_price' => $validatedData['total_price'],
            'pay_price' => $validatedData['pay_price'],
            'panding_price' => $panding_price,
            'payment_status' => $payment_status,
            'addby' => $userName,
        ]);

        $Yarnpurchase->save();

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

        
        $existingRecord = YarnInventory::where('cones', $validatedData['cones'])
        ->where('count', $validatedData['count'])
        ->where('type', $validatedData['type'])
        ->first();

        if ($existingRecord) {
            $existingRecord->update([
                'bag' => $existingRecord->bag + $validatedData['bag'],
            ]);
        } else {
            YarnInventory::create($validatedData);
        }



        return redirect()->route('purchace_yarn')->with('add', true);
    }

    public function deleteYarnPurchace($id)
    {
        $yarnpurchase = Yarnpurchase::find($id);
        $existingRecord = YarnInventory::where('cones',  $yarnpurchase->cones)
        ->where('count', $yarnpurchase->count)
        ->where('type', $yarnpurchase->type)
        ->first();

        if ($existingRecord) {
            $existingRecord->update([
                'bag' => $existingRecord->bag - $yarnpurchase->bag,
            ]);
        }

        $pre_panding_price = $yarnpurchase->panding_price;
        $supplier = Supplier::where('name', $yarnpurchase->supplier)->first();
        if ($supplier) {
            $supplier->panding_price = $supplier->panding_price - $pre_panding_price;
            if($supplier->panding_price > 0){
                $supplier->save();
            }else{
                $supplier->panding_price = 0;
            }
            $supplier->save();
        }
        $yarnpurcahce = Yarnpurchase::find($id);

        if (!$yarnpurcahce) {
            // Yarnpurcahce record not found
            return redirect()->route('slae_yarn')->with('error', 'Yarnpurcahce record not found.');
        }

        $yarnpurcahce->delete();

        return redirect()->route('purchace_yarn')->with('delete', true);
    }
    public function EditYarnPurchcePage(Request $request)
    {
        $yarnpurchace = Yarnpurchase::findOrFail($request->id);

        // Fetch all suppliers and brokers
        $suppliers = Supplier::all();
        $brokers = Broker::all();

        return view('Yarn.updatePurchaceYarn', compact('yarnpurchace', 'suppliers', 'brokers'));
    }


    public function updatePurchaceYarnRecord(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bag' => 'required|numeric|min:0',
            'cones' => 'required|numeric|min:0',
            'count' => 'required|numeric|min:0',
            'type' => 'required|string',
            'brand' => 'required|string',
            'supplier' => 'required|string',
            'price_bag' => 'required|numeric|min:0',
            'broker' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'pay_price' => 'nullable|numeric|lte:' . request()->input('total_price'),
        ]);
        
        $panding_price = $validatedData['total_price'] - ($validatedData['pay_price'] ?? 0);
        $payment_status = $panding_price === 0 ? 'payed' : 'pending';

        $yarnpurchase = Yarnpurchase::find($id);
        $pre_panding_price = $yarnpurchase->panding_price;
        $supplier = Supplier::where('name', $yarnpurchase->supplier)->first();
        if ($supplier) {
            $supplier->panding_price = $supplier->panding_price - $pre_panding_price;
            if($supplier->panding_price > 0){
                $supplier->save();
            }else{
                $supplier->panding_price = 0;
            }
            $supplier->save();
        }

        $yarnpurchase = Yarnpurchase::findOrFail($id);

        $existingRecord = YarnInventory::where('cones', $validatedData['cones'])
        ->where('count', $validatedData['count'])
        ->where('type', $validatedData['type'])
        ->first();

        if ($existingRecord) {
            $existingRecord->update([
                'bag' => $existingRecord->bag - $yarnpurchase->bag,
            ]);
        }


        $yarnpurchase->update([
            'bag' => $validatedData['bag'],
            'cones' => $validatedData['cones'],
            'count' => $validatedData['count'],
            'type' => $validatedData['type'],
            'brand' => $validatedData['brand'],
            'supplier' => $validatedData['supplier'],
            'price_bag' => $validatedData['price_bag'],
            'broker' => $validatedData['broker'],
            'total_price' => $validatedData['total_price'],
            'pay_price' => $validatedData['pay_price'],
            'panding_price' => $panding_price,
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

        $existingRecord = YarnInventory::where('cones', $validatedData['cones'])
        ->where('count', $validatedData['count'])
        ->where('type', $validatedData['type'])
        ->first();

        if ($existingRecord) {
            $existingRecord->update([
                'bag' => $existingRecord->bag + $validatedData['bag'],
            ]);
        } else {
            YarnInventory::create($validatedData);
        }
        return redirect()->route('purchace_yarn')->with('Update', true);
    }

    public function yarnpurchasefilter(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'payment_status' => 'nullable|string',
            'supplier' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $query = Yarnpurchase::orderBy('created_at', 'desc');

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
        $yarnpurchases = $query->paginate(20);
        return view('Yarn.purchaceYarn', ['yarnpurchases' => $yarnpurchases, 'suppliers' => $suppliers]);
    }




}
