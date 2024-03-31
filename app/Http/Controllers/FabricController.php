<?php

namespace App\Http\Controllers;

use App\Models\FabricInventory;
use App\Models\Fabricpurchase;
use App\Models\Quality;
use Illuminate\Http\Request;
use App\Models\Fabricsale;
use App\Models\Purchaser;
use App\Models\Supplier;
use Carbon\Carbon;




class FabricController extends Controller
{
    public function Sale_Fabric()
    {
        $purchasers = Purchaser::all();
        $fabricsales = Fabricsale::orderBy('created_at', 'desc')->paginate(10);
        return view('fabric/salefabric', ['fabricsales' => $fabricsales, 'purchasers'=> $purchasers]);
    }

    public function Add_slae_fabric()
    {
        $purchasers = Purchaser::all();
        $qualities = FabricInventory::all();

        return view("fabric.addSalefabric", compact('purchasers', 'qualities'));
    }


    public function AddFarbricSaleRecord(Request $request)
    {
        $validatedData = $request->validate([
            'quality'  => 'required|string',
            'meter' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'price_per_meter' => 'required|numeric|min:0',
            'purchaser' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'received_price' => 'required|numeric|lte:' . request()->input('total_price'),
        ]);

        $panding_price = $validatedData['total_price'] - ($validatedData['received_price'] ?? 0);
        $paymentStatus = $panding_price === 0 ? 'received' : 'pending';
        $user = auth()->user();
        $userName = $user->name;
        $existingRecord = FabricInventory::where('quality', $validatedData['quality'])->first();
        if ($existingRecord && ( $existingRecord->meter > $validatedData['meter'])) {
            $existingRecord->update([
                'meter' => $existingRecord->meter - $validatedData['meter'],
            ]);
        }else{
            return redirect()->route('slae_fabric')->with('invontry_error', true);
        } 
        $fabricSale = new FabricSale([
            'quality' => $validatedData['quality'],
            'meter' => $validatedData['meter'],
            'weight' => $validatedData['weight'],
            'price_per_meter' => $validatedData['price_per_meter'],
            'purchaser' => $validatedData['purchaser'],
            'total_price' => $validatedData['total_price'],
            'received_price' => $validatedData['received_price'],
            'panding_price' => $panding_price,
            'paymentStatus' => $paymentStatus,
            'addby' => $userName,
        ]);
        $fabricSale->save();

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

      
        

        return redirect()->route('slae_fabric')->with('add', true);
    }

    public function DeleteFabricSale($id)
    {
        $fabricsale = Fabricsale::find($id);
        $existingRecord = FabricInventory::where('quality', $fabricsale->quality)->first();

        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter + $fabricsale->meter,
            ]);
        }

        $pre_panding_price = $fabricsale->panding_price;
        $purchaser = Purchaser::where('name', $fabricsale->purchaser)->first();
        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price - $pre_panding_price;
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }
        if (!$fabricsale) {
            return redirect()->route('slae_fabric')->with('error', 'Fabric record not found.');
        }
        $fabricsale->delete();
        return redirect()->route('slae_fabric')->with('delete', true);
    }

    public function EditFabricSalePage(Request $request)
    {
        $fabricsale = Fabricsale::findOrFail($request->id);
        $purchasers = Purchaser::all();
        $qualities = Quality::all();
        return view('fabric.UpdateSaleFabric', compact('fabricsale', 'purchasers', 'qualities'));
    }
    public function Updatesalefabricrecord(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'quality' => 'required|string',
            'meter' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'price_per_meter' => 'required|numeric|min:0',
            'purchaser' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'received_price' => 'nullable|numeric|lte:' . request()->input('total_price'),
        ]);
        $panding_price = $validatedData['total_price'] - ($validatedData['received_price'] ?? 0);
        $paymentStatus = $panding_price === 0 ? 'received' : 'pending';

        $fabricsale = Fabricsale::find($id);
        $pre_panding_price = $fabricsale->panding_price;
        $purchaser = Purchaser::where('name', $fabricsale->purchaser)->first();
        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price - $pre_panding_price;
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }

        $existingRecord = FabricInventory::where('quality', $fabricsale->quality)->first();

        if ($existingRecord && ( $validatedData['meter'] >  $existingRecord->meter + $fabricsale->meter)) {
            return redirect()->route('slae_fabric')->with('invontry_error', true);
        }
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter + $fabricsale->meter,
            ]);
        }
        $fabricsale->update([
            'quality' => $validatedData['quality'],
            'meter' => $validatedData['meter'],
            'weight' => $validatedData['weight'],
            'price_per_meter' => $validatedData['price_per_meter'],
            'purchaser' => $validatedData['purchaser'],
            'total_price' => $validatedData['total_price'],
            'received_price' => $validatedData['received_price'],
            'panding_price' => $panding_price,
            'paymentStatus' => $paymentStatus,
        ]);

        $purchaser = Purchaser::where('name', $validatedData['purchaser'])->first();

        if ($purchaser) {
            $purchaser->panding_price = $purchaser->panding_price + $panding_price;
            if($purchaser->panding_price>=0){
                if($purchaser->panding_price > 0){
                    $purchaser->save();
                }else{
                    $purchaser->panding_price = 0;
                }
                $purchaser->save();
            }
        }

        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter - $validatedData['meter'],
            ]);
        }

        return redirect()->route('slae_fabric')->with('Update', true);

    }

    public function fabricsalefilter(Request $request){
        $request->validate([
            'payment_status' => 'nullable|string',
            'purchaser' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $query = Fabricsale::orderBy('created_at', 'desc');

        if ($request->filled('payment_status')) {
            $query->where('paymentStatus', '=', $request->input('payment_status'));
        }

        if ($request->filled('purchaser')) {
            $query->where('purchaser', '=', $request->input('purchaser'));
        }

        if ($request->filled('date') && $request->input('date') !== "null") {
            $formattedDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            $query->whereDate('updated_at', '=', $formattedDate);
        }

        $fabricsales = $query->paginate(20);
        $purchasers = Purchaser::all();
        return view('fabric/salefabric', ['fabricsales' => $fabricsales, 'purchasers'=> $purchasers]);

    }


    public function Purchase_Fabric()
    {
        $suppliers = Supplier::all(); 
        $fabricpurchases = Fabricpurchase::orderBy('created_at', 'desc')->paginate(10);
        return view('fabric/purchasefabric', ['fabricpurchases' => $fabricpurchases, 'suppliers'=> $suppliers]);

    }

    public function Add_purchase_fabric()
    {
        $suppliers = Supplier::all();
        $qualities = Quality::all();
        return view("fabric/addpurchasefabric", compact('suppliers','qualities'));
    }

    public function AddFarbricPurchaseRecord(Request $request){
        $validatedData = $request->validate([
            'quality' => 'required|string',
            'meter'  => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'price_per_meter' => 'required|numeric|min:0',
            'supplier' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'pay_price' => 'required|numeric|lte:' . request()->input('total_price'),
        ]);
        
        $panding_price = $validatedData['total_price'] - ($validatedData['pay_price'] ?? 0);
        $payment_status = $panding_price === 0 ? 'payed' : 'pending';

        $user = auth()->user();
        $userName = $user->name;
        $fabricpurchase = new Fabricpurchase([
            'quality' =>  $validatedData['quality'],
            'meter' =>  $validatedData['meter'],
            'weight' => $validatedData['weight'],
            'price_per_meter' => $validatedData['price_per_meter'],
            'supplier' => $validatedData['supplier'],
            'total_price' => $validatedData['total_price'],
            'pay_price' => $validatedData['pay_price'],
            'panding_price' => $panding_price,
            'paymentStatus' => $payment_status,
            'addby'=> $userName,
        ]);
        $fabricpurchase->save();

        $existingRecord = FabricInventory::where('quality', $validatedData['quality'])->first();
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter + $validatedData['meter'],
            ]);
        } else {
            FabricInventory::create($validatedData);
        }

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
   
        return redirect()->route('purchase_fabric')->with('add', true);
    }

    public function DeleteFabricPurchase($id){
        $fabricpurachse = Fabricpurchase::find($id);
        $existingRecord = FabricInventory::where('quality', $fabricpurachse->quality)->first();
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter - $fabricpurachse->meter,
            ]);
        } 

        $pre_panding_price = $fabricpurachse->panding_price;
        $supplier = Supplier::where('name', $fabricpurachse->supplier)->first();
        if ($supplier) {
            $supplier->panding_price = $supplier->panding_price - $pre_panding_price;
            if($supplier->panding_price > 0){
                $supplier->save();
            }else{
                $supplier->panding_price = 0;
            }
            $supplier->save();
        }
        
        if (!$fabricpurachse) {
            return redirect()->route('purchase_fabric')->with('error', 'Fabric record not found.');
        }

        $fabricpurachse->delete();

        return redirect()->route('purchase_fabric')->with('delete', true);
    }

    public function EditFabricPurchasePage(Request $request)
    {
        $fabricpurchase = Fabricpurchase::findOrFail($request->id);
        $suppliers = Supplier::all();
        $qualities = Quality::all();
        return view('fabric.UpdatepurchaseFabric', compact('fabricpurchase', 'suppliers','qualities'));
    }
    
    public function Updatefabricpurchase(Request $request)
    {
        
        $validatedData = $request->validate([
            'quality' => 'required|string',
            'meter'  => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'price_per_meter' => 'required|numeric|min:0',
            'supplier' => 'required|string',
            'total_price' => 'required|numeric|min:0',
            'pay_price' => 'nullable|numeric|lte:' . request()->input('total_price'),
        ]);
        $panding_price = $validatedData['total_price'] - ($validatedData['pay_price'] ?? 0);
        $payment_status = $panding_price === 0 ? 'payed' : 'pending';
        $fabricpurchase = Fabricpurchase::find($request->id);

        $pre_panding_price = $fabricpurchase->panding_price;
        $supplier = Supplier::where('name', $fabricpurchase->supplier)->first();
        if ($supplier) {
            $supplier->panding_price = $supplier->panding_price - $pre_panding_price;
            if($supplier->panding_price >= 0) {
                if($supplier->panding_price > 0){
                    $supplier->save();
                }else{
                    $supplier->panding_price = 0;
                }
                $supplier->save();
            }
        }

        $existingRecord = FabricInventory::where('quality', $validatedData['quality'])->first();
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter - $fabricpurchase->meter,
            ]);
        } 
    
        $fabricpurchase->update([
            'quality' =>  $validatedData['quality'],
            'meter' =>  $validatedData['meter'],
            'weight' => $validatedData['weight'],
            'price_per_meter' => $validatedData['price_per_meter'],
            'supplier' => $validatedData['supplier'],
            'total_price' => $validatedData['total_price'],
            'pay_price' => $validatedData['pay_price'],
            'panding_price' => $panding_price,
            'paymentStatus' => $payment_status,
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
        $existingRecord = FabricInventory::where('quality', $validatedData['quality'])->first();
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter + $validatedData['meter'],
            ]);
        } else {
            FabricInventory::create($validatedData);
        }
    
        return redirect()->route('purchase_fabric')->with('Update', true);
    }
    
    public function fabricpurchasefilter(Request $request){
        $request->validate([
            'payment_status' => 'nullable|string',
            'supplier' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $query = Fabricpurchase::orderBy('created_at', 'desc');

        if ($request->filled('payment_status')) {
            $query->where('paymentStatus', '=', $request->input('payment_status'));
        }

        if ($request->filled('supplier')) {
            $query->where('supplier', '=', $request->input('supplier'));
        }

        if ($request->filled('date') && $request->input('date') !== "null") {
            $formattedDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            $query->whereDate('updated_at', '=', $formattedDate);
        }

        $suppliers = Supplier::all();
        $fabricpurchases = $query->paginate(20);
        return view('fabric/purchasefabric', ['fabricpurchases' => $fabricpurchases, 'suppliers'=> $suppliers]);
    }

}


