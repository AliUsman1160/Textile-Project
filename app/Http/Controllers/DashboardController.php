<?php
namespace App\Http\Controllers;

use App\Models\Fabricpurchase;
use App\Models\Fabricsale;
use App\Models\Suitpurchase;
use App\Models\Suitsale;
use App\Models\Yarnpurchase;
use App\Models\Yarnsale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December',
        ];

        $data = [
            'labels' => $months,
            'salesData' => $this->getMonthlySalesData(),
            'purchaseData' => $this->getMonthlyPurchaseData(),
            'profitData' => $this->getMonthlyProfitData(),
        ];

        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $totalsale = 0;
        $Yarnsale = Yarnsale::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('total_price');
        $fabricsale = Fabricsale::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
        ->sum('total_price');
        $suitsale = Suitsale::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
        ->sum('totalPrice');
        
        $totalsale = $Yarnsale +  $fabricsale  + $suitsale;

        $totalpurchase = 0;
        $yarnpurchase = Yarnpurchase::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('total_price');
        $fabricpurchase = Fabricpurchase::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
        ->sum('total_price');
        $suitpurchase = Suitpurchase::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
        ->sum('price');

        $totalpurchase =   $yarnpurchase + $fabricpurchase + $suitpurchase ;

        $totalprofit =   $totalsale  -  $totalpurchase ;
        
        return view('dashboard', compact('data', 'totalsale','totalpurchase', 'totalprofit'));
    }

    private function getMonthlySalesData()
    {
        $salesData = [];

        foreach (range(1, 12) as $month) {
            $salesData[] = Yarnsale::whereMonth('created_at', $month)->sum('total_price')
                + Fabricsale::whereMonth('created_at', $month)->sum('total_price')
                + Suitsale::whereMonth('created_at', $month)->sum('totalPrice');
        }

        return $salesData;
    }

    private function getMonthlyPurchaseData()
    {
        $purchaseData = [];

        foreach (range(1, 12) as $month) {
            $purchaseData[] = Yarnpurchase::whereMonth('created_at', $month)->sum('total_price')
                + Fabricpurchase::whereMonth('created_at', $month)->sum('total_price')
                + Suitpurchase::whereMonth('created_at', $month)->sum('price');
        }

        return $purchaseData;
    }

    private function getMonthlyProfitData()
    {
        $profitData = [];
    
        $salesData = $this->getMonthlySalesData();
        $purchaseData = $this->getMonthlyPurchaseData();
    
        foreach (range(0, 11) as $index) {
            $profit = $salesData[$index] - $purchaseData[$index];
            $profitData[] = max(0, $profit);
        }
    
        return $profitData;
    }
    
}