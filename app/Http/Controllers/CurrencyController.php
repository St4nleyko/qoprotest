<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Services\GeckoService;
use Illuminate\Support\Str;

class CurrencyController extends Controller
{
    protected $coinGeckoService;

    public function __construct(GeckoService $coinGeckoService)
    {
        $this->coinGeckoService = $coinGeckoService;
    }

    public function index(){
        $currencies = Currency::select('id', 'name', 'coin_id', 'image_url')
            ->orderBy('name', 'asc')
            ->paginate(5);
        return view('currency.index', compact('currencies'));

    }
    public function view($currency){

        if (Str::isUuid($currency)) {
            $currency = Currency::where('id', $currency)->firstOrFail();
        } else {
            $currency = Currency::where('coin_id', $currency)->firstOrFail();
        }
        return view('currency.view', compact('currency'));

    }
    private function importAndUpdateCurrencies(){
        $message = $this->coinGeckoService->importCurrencyList();
        return response()->json(['message' => $message]);
    }
}
