<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Illuminate\Http\Request;
use App\Models\Supplier; 
use App\Models\Purchaser; 

class StakeholderController extends Controller
{
    public function stackholderpage(){
        return view("addstakeholders");
    }

    public function supplierstore(Request $request)
    {
        $request->validate([
            'supplier' => 'required|string|max:255',
        ]);

        $existingSupplier = Supplier::where('name', $request->input('supplier'))->first();

        if ($existingSupplier) {
            return redirect()->route('addstakeholders')->with('error', 'Supplier already exists!')->withInput();
        }

        Supplier::create([
            'name' => $request->input('supplier'),
        ]);

        return redirect()->route('addstakeholders')->with('success', 'Record added successfully!');
    }

    public function purchaserstore(Request $request){
        $request->validate([
            'purchaser' => 'required|string|max:255',
        ]);

        $existingPurchaser = purchaser::where('name', $request->input('purchaser'))->first();

        if ($existingPurchaser) {
            return redirect()->route('addstakeholders')->with('error', 'purchaser already exists!')->withInput();
        }

        Purchaser::create([
            'name' => $request->input('purchaser'),
        ]);

        return redirect()->route('addstakeholders')->with('success', 'Record added successfully!');
    }

    public function Brokerstore(Request $request){
        $request->validate([
            'broker' => 'required|string|max:255',
        ]);

        $existingbroker = Broker::where('name', $request->input('broker'))->first();

        if ($existingbroker) {
            return redirect()->route('addstakeholders')->with('error', 'broker already exists!')->withInput();
        }

        Broker::create([
            'name' => $request->input('broker'),
        ]);

        return redirect()->route('addstakeholders')->with('success', 'Record added successfully!');
    }
}
