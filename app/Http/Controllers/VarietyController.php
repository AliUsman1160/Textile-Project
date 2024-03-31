<?php

namespace App\Http\Controllers;

use App\Models\Variety;
use Illuminate\Http\Request;

class VarietyController extends Controller
{
    public function Addvariety(){
        return view("varity.addvarity");
    }
    public function savevarity(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:varieties',
            'price' => 'required|numeric',
            'meter' => 'required|integer',
        ]);
    
        $variety = new Variety();

        $variety->name = $request->input('name');
        $variety->price = $request->input('price');
        $variety->meter = $request->input('meter');
    
        $variety->save();
    
        return redirect()->route('suitinvontry');
    }

    public function Deletevarirty($id){
        $variety = Variety::find($id);

        if (!$variety) {
    
            return redirect()->route('suitinvontry')->with('error', 'record not found.');
        }

        $variety->delete();
        return redirect()->route('suitinvontry')->with('delete','Deleted variety');
    }

    public function editsuitinvontry($id){
        $variety = Variety::find($id);
        return view('varity.updatevariety', compact('variety'));

    }

    public function updatevarity(Request $request, $id){
        $validatedData = $request->validate([
            'name'  => 'required|string',
            'price' => 'required|numeric',
            'meter' => 'required|integer',
        ]);

        $Variety = Variety::findOrFail($id);

        $Variety->update([
            'name'  => $validatedData['name'],
            'price' => $validatedData['price'],
            'meter' =>$validatedData['meter'],
        ]);
        return redirect()->route('suitinvontry')->with('update','Deleted variety');

    }
}
