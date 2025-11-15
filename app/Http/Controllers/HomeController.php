<?php

namespace App\Http\Controllers;

use App\Models\BlueExchangeRate;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function welcome()
    {
        $tz   = 'America/La_Paz';
        $now  = Carbon::now($tz);
        $today = $now->toDateString();

        // Últimos registros globales
        $latest_buy  = BlueExchangeRate::where('type','buy')->orderByDesc('created_at')->first();
        $latest_sell = BlueExchangeRate::where('type','sell')->orderByDesc('created_at')->first();
        $last_update = $latest_buy? $latest_buy->created_at : ($latest_sell? $latest_sell->created_at : null);

        // INTRADÍA (Hoy): todas las cotizaciones de hoy
        [$dayLabels, $dayBuyRates, $daySellRates] = $this->buildIntradaySeries($today, $tz);

        // Semana (últimos 7 días): último valor por día
        $fromWeek = $now->copy()->subDays(6)->startOfDay();
        [$weekLabels, $weekBuyRates, $weekSellRates] = $this->buildDailySeries(
            $fromWeek, $now->copy()->startOfDay(), $tz
        );

        // Mes (últimos 30 días): último valor por día
        $fromMonth = $now->copy()->subDays(29)->startOfDay();
        [$monthLabels, $monthBuyRates, $monthSellRates] = $this->buildDailySeries(
            $fromMonth, $now->copy()->startOfDay(), $tz
        );

        // Año (últimos 12 meses): último valor por mes
        [$yearLabels, $yearBuyRates, $yearSellRates] = $this->buildMonthlySeries($now, 12);

        // Para el bloque “Comparativa” (valores de hoy)
        $bs_buy  = BlueExchangeRate::where('date',$today)->where('type','buy')->orderByDesc('created_at')->first();
        $bs_sell = BlueExchangeRate::where('date',$today)->where('type','sell')->orderByDesc('created_at')->first();

        $official_buy = null;
        $official_sell = null;

        return view('welcome', compact(
            'latest_buy','latest_sell','last_update',
            'bs_buy','bs_sell','official_buy','official_sell',
            'dayLabels','dayBuyRates','daySellRates',
            'weekLabels','weekBuyRates','weekSellRates',
            'monthLabels','monthBuyRates','monthSellRates',
            'yearLabels','yearBuyRates','yearSellRates'
        ));
    }

    // Serie intradía: todos los puntos de hoy. Alinea por segundo (H:i:s).
    private function buildIntradaySeries(string $date, string $tz): array
    {
        $rows = BlueExchangeRate::where('date', $date)
            ->orderBy('created_at')
            ->get();

        if ($rows->isEmpty()) return [[], [], []];

        $groups = $rows->groupBy(function ($r) use ($tz) {
            return $r->created_at->timezone($tz)->format('H:i:s');
        });

        $labels = [];
        $buy = [];
        $sell = [];

        foreach ($groups as $label => $g) {
            $labels[] = $label;
            $b = $g->where('type','buy')->sortBy('created_at')->last();
            $s = $g->where('type','sell')->sortBy('created_at')->last();
            $buy[]  = $b ? (float)$b->rate : null;
            $sell[] = $s ? (float)$s->rate : null;
        }

        return [$labels, $buy, $sell];
    }

    // Serie diaria: último valor por día en rango
    private function buildDailySeries(Carbon $from, Carbon $to, string $tz): array
    {
        $fromDate = $from->copy()->startOfDay()->toDateString();
        $toDate   = $to->copy()->startOfDay()->toDateString();

        $rows = BlueExchangeRate::whereBetween('date', [$fromDate, $toDate])
            ->orderBy('date')->orderBy('created_at')
            ->get()
            ->groupBy('date');

        $cursor = Carbon::parse($fromDate, $tz);
        $end    = Carbon::parse($toDate, $tz);

        $labels = [];
        $buy = [];
        $sell = [];

        while ($cursor->lte($end)) {
            $d = $cursor->toDateString();
            $labels[] = $cursor->format('d/m');

            $dayGroup = $rows->get($d, collect());
            $lastBuy  = $dayGroup->where('type','buy')->sortBy('created_at')->last();
            $lastSell = $dayGroup->where('type','sell')->sortBy('created_at')->last();

            $buy[]  = $lastBuy? (float)$lastBuy->rate : null;
            $sell[] = $lastSell? (float)$lastSell->rate : null;

            $cursor->addDay();
        }

        return [$labels, $buy, $sell];
    }

    // Serie mensual: último valor por mes (últimos N meses)
    private function buildMonthlySeries(Carbon $now, int $months = 12): array
    {
        $start = $now->copy()->startOfMonth()->subMonths($months - 1);
        $end   = $now->copy()->endOfMonth();
        $startDate = $start->toDateString();
        $endDate   = $end->toDateString();

        $rows = BlueExchangeRate::whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')->orderBy('created_at')
            ->get()
            ->groupBy(fn($r) => substr($r->date, 0, 7)); // YYYY-MM

        $labels = [];
        $buy = [];
        $sell = [];

        $cursor = $start->copy();
        for ($i = 0; $i < $months; $i++) {
            $ym = $cursor->format('Y-m');
            $labels[] = $cursor->format('m/Y');

            $monthGroup = $rows->get($ym, collect());
            $lastBuy  = $monthGroup->where('type','buy')->sortBy('created_at')->last();
            $lastSell = $monthGroup->where('type','sell')->sortBy('created_at')->last();

            $buy[]  = $lastBuy? (float)$lastBuy->rate : null;
            $sell[] = $lastSell? (float)$lastSell->rate : null;

            $cursor->addMonth()->startOfMonth();
        }

        return [$labels, $buy, $sell];
    }
}