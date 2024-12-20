<?php

namespace App\Services;

use App\Jobs\SendPriceChangeNotification;
use App\Models\Watchdog;
use Exception;
use Illuminate\Support\Facades\Http;
use App\Models\Currency;
class GeckoService
{
    /**
     * Fetch and import currencies from the CoinGecko API.
     *
     * @return string
     */
    public function importCurrencyList(): string
    {
        $url = env('COINGECKO_API_URL'). '/coins/markets';

        // API endpoint and parameters
        $params = [
            'vs_currency' => 'eur',
            'order' => 'market_cap_desc',
            'per_page' => 10,
            'page' => 1,
            'sparkline' => false,
            'key' => env('COINGECKO_API_KEY'),
        ];

        try {
            // API call
            $response = Http::get($url, $params);
            if ($response->successful()) {
                $currencies = $response->json();

                // Store or update currencies
                foreach ($currencies as $currencyData) {
                    $localDbCurrency = Currency::where('coin_id',$currencyData['id'])->first();
                    $oldPrice = $localDbCurrency ? $localDbCurrency->current_price : null;
                    $newPrice = $currencyData['current_price'];

                    Currency::updateOrCreate(
                        ['coin_id' => $currencyData['id']],
                        [
//                            'id' => (string) Str::uuid(),
                            'name' => $currencyData['name'],
                            'symbol' => $currencyData['symbol'],
                            'current_price' => $currencyData['current_price'],
                            'price_change_percentage_24h' => $currencyData['price_change_percentage_24h'],
                            'image_url' => $currencyData['image'],
                            'market_cap' => $currencyData['market_cap'],
                        ]
                    );
                    if ($localDbCurrency && $oldPrice !== $newPrice) {
                        $watchdogs = Watchdog::where('currency_id', $localDbCurrency->id)->get();
                        foreach ($watchdogs as $watchdog) {
                            SendPriceChangeNotification::dispatch($watchdog->user, $localDbCurrency, $oldPrice, $newPrice);
                        }
                    }

                }
                return "Currencies imported/updated successfully.";
            }
            else {
                return "Failed to fetch currencies: " . $response->body();
            }
        } catch (Exception $e) {
            return "An error occurred: " . $e->getMessage();
        }
    }
}
