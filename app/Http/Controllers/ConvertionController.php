<?php

namespace App\Http\Controllers;

use App\Models\FabricInventory;
use App\Models\Fabrictosuit;
use App\Models\Variety;
use App\Models\YarnInventory;
use App\Models\Yarntofabric;
use Illuminate\Http\Request;
use App\Models\Quality;
use Illuminate\Support\Facades\Validator;
use App\Models\Purchaser;
use App\Models\Broker;
use App\Models\Supplier;

class ConvertionController extends Controller
{
    public function yarntofabric(){
        $contracts = Yarntofabric::orderBy('created_at', 'desc')->get();
        return view("convertion/yarntofabric", compact('contracts'));
    }
    public function AddYarnToFabricContract(){
        
        $qualities = Quality::all();
        $brokers = Broker::all();
        $yarn = YarnInventory::all();

        // dd($yarn);

        return view("convertion/yarntofabricContract", [
            'qualities' => $qualities,
            'brokers' => $brokers,
            'yarn' => $yarn,
        ]);
    }

    public function addnewqaulity(){
        return view("convertion/addquality");
    }

    public function storequality(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'read' => 'required|numeric',
            'pick' => 'required|numeric',
            'warpcount' => 'required|numeric',
            'weftcount' => 'required|numeric',
            'width' => 'required|numeric',
            'quality' => 'required|string',
            'nameofyarn' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quality = Quality::create([
            'read' => $request->input('read'),
            'pick' => $request->input('pick'),
            'warpcount' => $request->input('warpcount'),
            'weftcount' => $request->input('weftcount'),
            'width' => $request->input('width'),
            'nameofyarn' => $request->input('nameofyarn'),
            'quality' => $request->input('quality'), 
        ]);
        return redirect()->route('dashboard'); 
    }

    public function saveyarntofabric(Request $request){
        $validatedData = $request->validate([
            'deliverDate' => 'required|date',
            'contractee' => 'required|string',
            'broker' => 'required|string',
            'quality' => ['required', 'string', function ($attribute, $value, $fail) {
                $elements = explode(',', $value);

                if (count($elements) < 4) {
                    $fail($attribute . ' Select Quality.');
                }
            }],
            'ordermeter' => 'required|numeric|min:1',
            'ratepermeter' => 'required|numeric|min:1',
            'warpyarncount' => 'required|numeric|min:1',
            'weftyarncount' => 'required|numeric|min:1',
            'warprate' => 'required|numeric|min:1',
            'weftrate' => 'required|numeric|min:1',
            'warpthread' => 'required|string',
            'weftthread' => 'required|string',
            'convpick' => 'required|numeric|min:1',
            'convmeter' => 'required|numeric|min:1',
            'gst' => 'required|numeric|min:0',
            'warpweight' => 'required|numeric|min:0',
            'weftweight' => 'required|numeric|min:0',
            'requiredwarpbag' => 'required|numeric|min:0',
            'requiredweftbag' => 'required|numeric|min:0',
            'totalrequiredbags' => 'required|numeric|min:0',
            'payment' => 'required|numeric|min:0',
            'paymentincludeGST' => 'required|numeric|min:0',
            'sendbag' => 'numeric|min:0',
            'duebag' => 'numeric|min:0',
            'deliverinst' => 'nullable|string',
            'paymentinst' => 'nullable|string',
            'qualityinst' => 'nullable|string',
            'otherinst' => 'nullable|string',
            'brandDropdown' => 'required|string',
            'conesDropdown' => 'required|string',
            'countDropdown' => 'required|string',
            'typeDropdown' => 'required|string',

        ]);

        $yarninventory = YarnInventory::where('brand', $validatedData['brandDropdown'])
        ->where('cones', $validatedData['conesDropdown'])
        ->where('count', $validatedData['countDropdown'])
        ->where('type', $validatedData['typeDropdown'])
        ->first();
    
        if ($yarninventory && $yarninventory->bag > $validatedData['totalrequiredbags']) {
            if( $validatedData['totalrequiredbags']>0){
                $bagsToSubtract = floor($validatedData['totalrequiredbags']);
                $yarninventory->update([
                    'bag' => $yarninventory->bag - $bagsToSubtract
                ]);   
            }
        } else {
            return redirect()->back()->withInput();
        }
    


        $qualityArray = explode(',', $validatedData['quality']);
        $qulaityid = end($qualityArray);

        $quality = Quality::where('id', $qulaityid)->first();
        $qualityname = $quality->quality;

        $user = auth()->user();
        $userName = $user->name;
        $yarntofabric = new Yarntofabric();

        $yarntofabric->delivery_date = $validatedData['deliverDate'];
        $yarntofabric->contractee = $validatedData['contractee'];
        $yarntofabric->broker = $validatedData['broker'];
        $yarntofabric->quality = $qualityname;
        $yarntofabric->order_meter = $validatedData['ordermeter'];
        $yarntofabric->rate_per_meter = $validatedData['ratepermeter'];
        $yarntofabric->warp_yarn_count = $validatedData['warpyarncount'];
        $yarntofabric->weft_yarn_count = $validatedData['weftyarncount'];
        $yarntofabric->warp_rate = $validatedData['warprate'];
        $yarntofabric->weft_rate = $validatedData['weftrate'];
        $yarntofabric->warpthread = $validatedData['warpthread'];
        $yarntofabric->weftthread = $validatedData['weftthread'];
        $yarntofabric->conv_pick = $validatedData['convpick'];
        $yarntofabric->conv_meter = $validatedData['convmeter'];
        $yarntofabric->gst = $validatedData['gst'];
        $yarntofabric->warp_weight_per_meter = $validatedData['warpweight'];
        $yarntofabric->weft_weight_per_meter = $validatedData['weftweight'];
        $yarntofabric->required_warp_bags = $validatedData['requiredwarpbag'];
        $yarntofabric->required_weft_bags = $validatedData['requiredweftbag'];
        $yarntofabric->total_required_bags = $validatedData['totalrequiredbags'];
        $yarntofabric->payment = $validatedData['payment'];
        $yarntofabric->payment_include_gst = $validatedData['paymentincludeGST'];
        $yarntofabric->send_bags = $validatedData['sendbag'];
        $yarntofabric->due_bags = $validatedData['duebag'];
        $yarntofabric->delivery_instruction = $validatedData['deliverinst'];
        $yarntofabric->payment_instruction = $validatedData['paymentinst'];
        $yarntofabric->quality_instruction = $validatedData['qualityinst'];
        $yarntofabric->other_instruction = $validatedData['otherinst'];
        $yarntofabric->addby = $userName;
        $yarntofabric->yarnbrand = $validatedData['brandDropdown'];
        $yarntofabric->yarncones = $validatedData['conesDropdown'];
        $yarntofabric->yarncount = $validatedData['countDropdown'];
        $yarntofabric->yarntype = $validatedData['typeDropdown'];
        $yarntofabric->save();

     


        $existingRecord = FabricInventory::where('quality', $qualityname)->first();
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter + $validatedData['ordermeter'],
            ]);
        } else {
            FabricInventory::create([
                'quality' => $qualityname,
                'meter' => $validatedData['ordermeter']
            ]);
        }




        return redirect('yarntofabric')->with('success', 'Yarn to fabric record saved successfully');
    }

    public function DeleteYarntoFabric($id){
        $yarntofabric = Yarntofabric::find($id);

        $yarninventory = YarnInventory::where('brand', $yarntofabric->yarnbrand)
        ->where('cones', $yarntofabric->yarncones)
        ->where('count', $yarntofabric->yarncount)
        ->where('type', $yarntofabric->yarntype)
        ->first();

        if($yarninventory){
            $bagtoadd = floor($yarntofabric->total_required_bags);
            $yarninventory->update([
                'bag' => $yarninventory->bag + $bagtoadd
            ]);  
        }
        
        $existingRecord = FabricInventory::where('quality', $yarntofabric->quality)->first();
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter - $yarntofabric->order_meter,
            ]);
        } 
        if (!$yarntofabric) {
            return redirect()->route('yarntofabric')->with('error', 'Yarnsale record not found.');
        }
        $yarntofabric->delete();
        return redirect()->route('yarntofabric')->with('delete', true);
    }

    public function fabrictosuit(){
        $records = Fabrictosuit::orderBy('created_at', 'desc')->get();
        return view('convertion/fabrictosuit', compact('records'));
    }


    public function Addfabrictosuit(){
        $Qualities = FabricInventory::all();
        $varities = Variety::all();
        return view('convertion/addfabrictosuit', compact('Qualities', 'varities'));

    }

    public function savefabrictosuit(Request $request){
        $validatedData = $request->validate([
            'quality' => 'required|string',
            'sendtodyeing' => 'required|integer',
            'cost' => 'required|numeric',
            'reject' => 'required|integer',
            'pass' => 'required|integer',
            'varity' => 'required|string',
        ]);
        $user = auth()->user();
        $userName = $user->name;


        $existingRecord = FabricInventory::where('quality', $validatedData['quality'])->first();
        if ($existingRecord && ( $existingRecord->meter > $validatedData['sendtodyeing'])) {
            $existingRecord->update([
                'meter' => $existingRecord->meter - $validatedData['sendtodyeing'],
            ]);
        }else{
            return redirect()->route('fabrictosuit')->with('invontry_error', true);
        } 

        $fabrictoSuits = new Fabrictosuit();
        $fabrictoSuits->quality = $validatedData['quality'];
        $fabrictoSuits->sendtodyeing = $validatedData['sendtodyeing'];
        $fabrictoSuits->cost = $validatedData['cost'];
        $fabrictoSuits->reject = $validatedData['reject'];
        $fabrictoSuits->pass = $validatedData['pass'];
        $fabrictoSuits->varity = $validatedData['varity'];
        $fabrictoSuits->addby = $userName;
        $fabrictoSuits->save();

        $varietyrecord = Variety::where('name', $validatedData['varity'])->first();
        if($varietyrecord){
            $varietyrecord->meter =  $varietyrecord->meter + $validatedData['pass'];
            $varietyrecord->save();
        }

      

        return redirect('fabrictosuit')->with('success', 'Yarn to fabric record saved successfully');
    }

    public function editfarictosuit($id){
        $fabrictosuit = Fabrictosuit::findOrFail($id);
        $Qualities = FabricInventory::all();
        $varities = Variety::all();
        return view('convertion/updatefabrictosuit', compact('Qualities', 'varities','fabrictosuit'));
    }

    public function updatefabrictosuit($id, Request $request){
        $validatedData = $request->validate([
            'quality' => 'required|string',
            'sendtodyeing' => 'required|integer',
            'cost' => 'required|numeric',
            'reject' => 'required|integer',
            'pass' => 'required|integer',
            'varity' => 'required|string',
        ]);
        $user = auth()->user();
        $userName = $user->name;
        
        $fabrictosuit = Fabrictosuit::find($id);
        $existingRecord = FabricInventory::where('quality', $fabrictosuit->quality)->first();

        if ($existingRecord && ( $validatedData['sendtodyeing'] >  $existingRecord->meter + $fabrictosuit->sendtodyeing)) {
            return redirect()->route('fabrictosuit')->with('invontry_error', true);
        }
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter + $fabrictosuit->sendtodyeing,
            ]);
        }
        $varietyrecord = Variety::where('name', $fabrictosuit->varity)->first();
        if($varietyrecord){
            $varietyrecord->meter =  $varietyrecord->meter - $fabrictosuit->pass;
            $varietyrecord->save();
        }
        $fabrictosuit->update([
            'quality' => $validatedData['quality'],
            'sendtodyeing' => $validatedData['sendtodyeing'],
            'cost' => $validatedData['cost'],
            'reject' => $validatedData['reject'],
            'pass' => $validatedData['pass'],
            'varity' => $validatedData['varity'],
            'addby' => $userName,
        ]); 
        $varietyrecord = Variety::where('name', $validatedData['varity'])->first();
        if($varietyrecord){
            $varietyrecord->meter =  $varietyrecord->meter + $validatedData['pass'];
            $varietyrecord->save();
        }
        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter - $validatedData['sendtodyeing'],
            ]);
        }
        
        return redirect('fabrictosuit')->with('Update', 'Yarn to fabric record Update successfully');
        
    }

    public function deletefabrictosuit($id){
        $Fabrictosuit = Fabrictosuit::find($id);
        $existingRecord = FabricInventory::where('quality', $Fabrictosuit->quality)->first();

        if ($existingRecord) {
            $existingRecord->update([
                'meter' => $existingRecord->meter + $Fabrictosuit->sendtodyeing,
            ]);
        }
        $varietyrecord = Variety::where('name', $Fabrictosuit->varity)->first();
        if($varietyrecord){
            $varietyrecord->meter =  $varietyrecord->meter - $Fabrictosuit->pass;
            $varietyrecord->save();
        }

        if (!$Fabrictosuit) {
            return redirect()->route('fabrictosuit')->with('error', 'Fabrictosuit record not found.');
        }
        $Fabrictosuit->delete();
        return redirect('fabrictosuit')->with('delete', 'Yarn to fabric record Update successfully');

    }


}
