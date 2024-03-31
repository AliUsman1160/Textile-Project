<?php

namespace App\Http\Controllers;

use App\Models\Fabricpurchase;
use App\Models\Fabricsale;
use App\Models\Fabrictosuit;
use App\Models\Purchaser;
use App\Models\Suitpurchase;
use App\Models\Suitsale;
use App\Models\Yarnpurchase;
use App\Models\YarnSale; // Import the YarnSale model
use App\Models\Yarntofabric;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function showInvoice($id)
    {
        $yarnsale = YarnSale::findOrFail($id);
        return view('invoices.yarnsale', compact('yarnsale'));
    }
    public function yarnpurchase_invoice($id){
        $yarnpurchase = Yarnpurchase::findOrFail($id);
        return view('invoices.yarnpurchase', compact('yarnpurchase'));
    }

    public function Salefabricinvoice($id){
        $fabricsale = Fabricsale::findOrFail($id);
        return view('invoices.fabricsaleinvoice', compact('fabricsale'));

    }

    public function fabricpurchaseinvoice($id){
        $fabricpurchase = Fabricpurchase::findOrFail($id);
        return view('invoices.fabricpurchaseinvoice', compact('fabricpurchase'));

    }

    public function salesuitinvice($billid){
        $salesuits = Suitsale::where('billid',$billid)->get();
        $purchaserSale = Suitsale::where('billid', $billid)->first();
        if ($purchaserSale) {
            $purchaserName = $purchaserSale->purchaser;
            $date = $purchaserSale->created_at;
        } 
        $totalBill=0;
        foreach ($salesuits as $salesuit) {
            $totalBill= $totalBill+$salesuit->totalPrice;
        }
        $purchaser = Purchaser::where('name', $purchaserName)->first();
        if($purchaser){
            $totalpendingprice = $purchaser->panding_price;
            if(($totalpendingprice -   $totalBill) > 0){
                 $pending = $totalpendingprice -   $totalBill;
            }else{
                $pending=0;
            }
        }
        return view('invoices.salesuitinvoice', compact('salesuits','purchaserName','date', 'totalBill', 'pending', 'totalpendingprice'));
    }

    public function purchasesuitinvoice($id){
        $suitpurchase = Suitpurchase::findOrFail($id);
        return view('invoices.purchasesuitinvoice', compact('suitpurchase'));
    }

    public function fabricetoYarninvoice($id){
        $contract = Yarntofabric::findOrFail($id);
        return view('invoices.yarntofabric', compact('contract'));

    }

    public function fabrictosuitinvoice($id){
        $contract = Fabrictosuit::findOrFail($id);
        return view('invoices.fabrictosuit', compact('contract'));

    }
}
