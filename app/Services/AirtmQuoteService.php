<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AirtmQuoteService
{
    // Pares a mostrar tal cual (tabla existente)
    private array $pairs = [
        'bob/usd','ars/usd','usd/usd','eur/usd','mxn/usd','clp/usd','pen/usd','brl/usd','cop/usd','pyg/usd'
    ];

    public function fetch(): array
    {
        $data = $this->fetchRawPayload();
        if (!$data) return [];
        $out = [];
        foreach ($this->pairs as $p) {
            if (isset($data[$p]['addValue'], $data[$p]['withdrawValue'])) {
                $out[] = [
                    'pair' => $p,
                    'buy'  => (float)$data[$p]['addValue'],
                    'sell' => (float)$data[$p]['withdrawValue']
                ];
            }
        }
        return $out;
    }

    // NUEVO: conversión de otras monedas -> BOB (Bs por 1 unidad de esa moneda)
    public function fetchToBob(array $symbols = ['usd','ars','eur','mxn','clp','pen','brl','cop','pyg']): array
    {
        $data = $this->fetchRawPayload();
        if (!$data) return [];

        // Se requiere bob/usd para construir el cruce
        if (!isset($data['bob/usd']['addValue'], $data['bob/usd']['withdrawValue'])) {
            return [];
        }
        $bobAdd = (float)$data['bob/usd']['addValue'];         // Bs por 1 USD (compra)
        $bobWit = (float)$data['bob/usd']['withdrawValue'];    // Bs por 1 USD (venta)

        $rows = [];
        foreach ($symbols as $sym) {
            $key = strtolower($sym).'/usd';
            if (!isset($data[$key]['addValue'], $data[$key]['withdrawValue'])) {
                continue;
            }
            $xAdd = (float)$data[$key]['addValue'];       // X por 1 USD
            $xWit = (float)$data[$key]['withdrawValue'];  // X por 1 USD

            // Bs por 1 X = (Bs/USD) / (X/USD)
            if ($xAdd > 0 && $xWit > 0) {
                $buyBs  = $bobAdd / $xAdd;   // Compra: referencia lado addValue
                $sellBs = $bobWit / $xWit;   // Venta: referencia lado withdrawValue

                $rows[] = [
                    'from' => strtoupper($sym),
                    'to'   => 'BOB',
                    'buy'  => $buyBs,
                    'sell' => $sellBs
                ];
            }
        }
        return $rows;
    }

    private function fetchRawPayload(): ?array
    {
        $verify = filter_var(env('BLUE_HTTP_VERIFY', false), FILTER_VALIDATE_BOOLEAN);
        $resp = Http::timeout(12)->withOptions(['verify'=>$verify])->get('https://rates.airtm.io/');
        if (!$resp->ok()) return null;
        $json = $resp->json();
        return isset($json['data']) && is_array($json['data']) ? $json['data'] : $json;
    }
}