<?php

namespace App\Http\Controllers;

use App\Models\FabricInventory;
use App\Models\Variety;
use App\Models\YarnInventory;
use Illuminate\Http\Request;

class InvontryController extends Controller
{
    public function suitinvontry(){
        $varieties = Variety::orderBy('created_at', 'desc')->paginate(10);
        return view("suit.suitinvontry",compact("varieties"));
    }

    public function yarn_invontry(){
        $records = YarnInventory::orderBy('created_at', 'desc')->paginate(10);
        return view('yarn.yarninvontry', compact('records'));
    }

    public function fabric_invontry(){
        $records = FabricInventory::orderBy('created_at', 'desc')->paginate(10);
        return view('fabric.fabricinvontry', compact('records'));
    }
}
