<?php

namespace App\Jobs;

use App\Mail\PriceChangeNotification;
use App\Models\User;
use App\Models\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
class SendPriceChangeNotification implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels,Dispatchable;


    protected $user;
    protected $currency;
    protected $oldPrice;
    protected $newPrice;

    public function __construct(User $user, Currency $currency, $oldPrice, $newPrice)
    {
        $this->user = $user;
        $this->currency = $currency;
        $this->oldPrice = $oldPrice;
        $this->newPrice = $newPrice;
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new PriceChangeNotification(
            $this->user,
            $this->currency,
            $this->oldPrice,
            $this->newPrice
        ));
    }
}
