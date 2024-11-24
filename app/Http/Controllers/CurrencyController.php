<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Services\GeckoService;

class CurrencyController extends Controller
{
    protected $coinGeckoService;

    public function __construct(GeckoService $coinGeckoService)
    {
        $this->coinGeckoService = $coinGeckoService;
    }


    public function importAndUpdateCurrencies(){
        $message = $this->coinGeckoService->importCurrencyList();
        return response()->json(['message' => $message]);
    }
}
