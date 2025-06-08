<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MarketDataController extends Controller
{
    public function getPrices()
    {
        $response = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd');
        return response()->json($response->json());
    }
}
