<?php

namespace App\Mail;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Mail\Mailable;

class PriceChangeNotification extends Mailable
{
    public $user;
    public $currency;
    public $oldPrice;
    public $newPrice;

    public function __construct(User $user, Currency $currency, $oldPrice, $newPrice)
    {
        $this->user = $user;
        $this->currency = $currency;
        $this->oldPrice = $oldPrice;
        $this->newPrice = $newPrice;
    }

    public function build()
    {
        return $this->view('emails.price_change_template')
            ->subject("Price change in {$this->currency->name}")
            ->with([
                'user' => $this->user,
                'currency' => $this->currency,
                'oldPrice' => $this->oldPrice,
                'newPrice' => $this->newPrice,
            ]);
    }
}
