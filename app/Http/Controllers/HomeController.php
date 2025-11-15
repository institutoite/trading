<?php

namespace App\Http\Controllers;

use App\Models\BlueExchangeRate;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function welcome()
    {
        $latest_buy  = BlueExchangeRate::where('type','buy')->latest()->first();
        $latest_sell = BlueExchangeRate::where('type','sell')->latest()->first();
        $last_update = $latest_buy? $latest_buy->created_at : ($latest_sell? $latest_sell->created_at : null);

        $today   = Carbon::now('America/La_Paz')->toDateString();
        $bs_buy  = BlueExchangeRate::where('date',$today)->where('type','buy')->latest()->first();
        $bs_sell = BlueExchangeRate::where('date',$today)->where('type','sell')->latest()->first();

        // Arrays para gráfica diaria (si los usas)
        $points = BlueExchangeRate::where('date',$today)->orderBy('created_at')->get();
        $dayLabels    = $points->pluck('created_at')->map->format('H:i');
        $dayBuyRates  = $points->where('type','buy')->pluck('rate')->values();
        $daySellRates = $points->where('type','sell')->pluck('rate')->values();

        $weekLabels=$weekBuyRates=$weekSellRates=$monthLabels=$monthBuyRates=$monthSellRates=[];

        return view('welcome', compact(
            'latest_buy','latest_sell','last_update',
            'bs_buy','bs_sell',
            'dayLabels','dayBuyRates','daySellRates',
            'weekLabels','weekBuyRates','weekSellRates',
            'monthLabels','monthBuyRates','monthSellRates'
        ));
    }
}