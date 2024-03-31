<?php

namespace App\Http\Controllers;

use App\Models\Fabricpurchase;
use App\Models\Fabricsale;
use App\Models\Purchaser;
use App\Models\PurchaserTransaction;
use App\Models\Suitpurchase;
use App\Models\Suitsale;
use App\Models\Supplier;
use App\Models\SupplierTransaction;
use App\Models\Yarnpurchase;
use App\Models\Yarnsale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function Supplieraccounts(){
        $suppliers = Supplier::paginate(20);
        $suppliersfilters = Supplier::all();
        return view("account.supplier", compact('suppliers','suppliersfilters'));              
    }

    public function supplieraccountfilter(Request $request){
        $query = Supplier::orderBy('created_at', 'desc');
        if ($request->filled('supplier')) {
            $query->where('name', '=', $request->input('supplier'));
        }
        if ($request->filled('payment_status') && $request->input('payment_status')=='clear') {
            $query->where('panding_price', '=', 0);
        }
        if ($request->filled('payment_status') && $request->input('payment_status')=='Pending') {
            $query->where('panding_price', '>', 0);
        }
        $suppliers = $query->paginate(20);
        $suppliersfilters = Supplier::all();
        return view("account.supplier", compact('suppliers','suppliersfilters'));              
    }

    public function addsupplieramount(){
        $suppliers = Supplier::all();
        return view("account.addsupplieramount", compact("suppliers"));
    }

    public function savesupplieramout(Request $request){
        $validatedData = $request->validate([
            'supplier' => 'required|string',
            'debt' => 'required|numeric',
            'pay' => 'required|numeric',
            'pending' => 'required|numeric',
            'note' => 'nullable|string',
        ]);
        $user = auth()->user();
        $userName = $user->name;
        $validatedData['addby']=  $userName ;

        $supplier = Supplier::where('name',$validatedData['supplier'] )->first();
        if ($supplier) {
            $newpandingvalue = $supplier->panding_price - $validatedData['pay'];
            if($newpandingvalue == $validatedData['pending']){
                $supplier->panding_price = $newpandingvalue;
                if($supplier->panding_price > 0){
                    $supplier->save();
                }else{
                    $supplier->panding_price = 0;
                }
                $supplier->save();
            }
           
        }

        SupplierTransaction::create($validatedData);
        return redirect()->route('supplieraccounts')->with('success', 'Transaction saved successfully');
    }

    public function showsupplierdetail($name){
        $transactions = SupplierTransaction::where('supplier', $name)->get();
        return view('account.supplierdetail', compact('transactions', 'name'));
    }

    public function deletesupplierdetail($id){
        $transactions = SupplierTransaction::find($id);
        $supplier = Supplier::where('name', $transactions->supplier)->first();
        if($supplier){
            $supplier->panding_price = $supplier->panding_price +  $transactions->pay;
            if($supplier->panding_price > 0){
                $supplier->save();
            }else{
                $supplier->panding_price = 0;
            }
            $supplier->save();
        }
        $transactions->delete();

        return redirect()->back()->with('delete', true);
    }

    public function supplierreport($name)
    {
        $currentMonth = Carbon::now()->format('F');

        $yarnpurchases = Yarnpurchase::where('supplier', $name)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();

        $fabricpurchases = Fabricpurchase::where('supplier', $name)
        ->whereMonth('created_at', Carbon::now()->month)
        ->get();

        $purchasesuits = Suitpurchase::where('supplier', $name)
        ->whereMonth('created_at', Carbon::now()->month)
        ->get();


        return view('account.supplierreport', compact('currentMonth', 'yarnpurchases', 'fabricpurchases','purchasesuits','name' ));

    }

    public function supplierlastreport($name){
       
        $currentMonth = Carbon::now()->subMonth()->format('F');
    
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        
       
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
    
        $yarnpurchases = Yarnpurchase::where('supplier', $name)
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->get();
    
        $fabricpurchases = Fabricpurchase::where('supplier', $name)
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->get();
    
        $purchasesuits = Suitpurchase::where('supplier', $name)
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->get();
    
        return view('account.supplierreport', compact('currentMonth', 'yarnpurchases', 'fabricpurchases', 'purchasesuits', 'name'));
    }


    public function Purchaseraccounts(){
        $purchasersfilters = Purchaser::all();
        $purchasers = Purchaser::paginate(20);
        return view("account.purchaser", compact('purchasers','purchasersfilters'));  
    }

    public function purchaseraccountfilter(Request $request){
        $query = Purchaser::orderBy('created_at', 'desc');
        if ($request->filled('purchaser')) {
            $query->where('name', '=', $request->input('purchaser'));
        }
        if ($request->filled('payment_status') && $request->input('payment_status')=='clear') {
            $query->where('panding_price', '=', 0);
        }
        if ($request->filled('payment_status') && $request->input('payment_status')=='Pending') {
            $query->where('panding_price', '>', 0);
        }
        $purchasers = $query->paginate(20);
        $purchasersfilters = Purchaser::all();
        return view("account.purchaser", compact('purchasers','purchasersfilters'));  
    }

    public function addpurchaseramount(){
        $purchasers = Purchaser::all();
        return view("account.addpurchaseramount", compact("purchasers"));
    }

    public function savepurchaseramout(Request $request){
        $validatedData = $request->validate([
            'purchaser' => 'required|string',
            'debt' => 'required|numeric',
            'credit' => 'required|numeric',
            'pending' => 'required|numeric',
            'note' => 'nullable|string',
        ]);
        $user = auth()->user();
        $userName = $user->name;
        $validatedData['addby']=  $userName ;

        $purchaser = Purchaser::where('name',$validatedData['purchaser'] )->first();
        if ($purchaser) {
            $newpandingvalue = $purchaser->panding_price - $validatedData['credit'];
            if($newpandingvalue == $validatedData['pending']){
                $purchaser->panding_price = $newpandingvalue;
                if($purchaser->panding_price > 0){
                    $purchaser->save();
                }else{
                    $purchaser->panding_price = 0;
                }
                $purchaser->save();
            }
           
        }

        PurchaserTransaction::create($validatedData);
        return redirect()->route('purchaseraccounts')->with('success', 'Transaction saved successfully');
    }

    public function showPurchaserDetail($name){
        $transactions = PurchaserTransaction::where('purchaser', $name)->get();
        return view('account.purchaserdetail', compact('transactions', 'name'));
    }
    public function purchaerreport($name)
    {
        $currentMonth = Carbon::now()->format('F');

        $yarnsales = Yarnsale::where('purchaser', $name)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();

        $fabricsales = Fabricsale::where('purchaser', $name)
        ->whereMonth('created_at', Carbon::now()->month)
        ->get();

        $salesuits = Suitsale::where('purchaser', $name)
        ->whereMonth('created_at', Carbon::now()->month)
        ->get();

        // dd($currentMonth, $currentMonth, $fabricsale,  $SuitSale);

        return view('account.purchaserreport', compact('currentMonth', 'yarnsales', 'fabricsales','salesuits','name' ));

    }

    public function purchaerlastreport($name){
       
        $currentMonth = Carbon::now()->subMonth()->format('F');
    
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        
       
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
    
        $yarnsales = Yarnsale::where('purchaser', $name)
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->get();
    
        $fabricsales = Fabricsale::where('purchaser', $name)
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->get();
    
        $salesuits = Suitsale::where('purchaser', $name)
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->get();
    
        return view('account.purchaserreport', compact('currentMonth', 'yarnsales', 'fabricsales', 'salesuits', 'name'));
    }
    


    
    public function deletepurchaserdetail($id){
        $transactions = PurchaserTransaction::find($id);
        // dd($transactions);
        $purchaser = Purchaser::where('name', $transactions->purchaser)->first();
        if($purchaser){
            $purchaser->panding_price = $purchaser->panding_price +  $transactions->credit;
            if($purchaser->panding_price > 0){
                $purchaser->save();
            }else{
                $purchaser->panding_price = 0;
            }
            $purchaser->save();
        }
        $transactions->delete();

        return redirect()->back()->with('delete', true);
    }
}
