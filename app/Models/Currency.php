<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Currency extends Model
{

    protected $keyType = 'string'; // UUID type is a string
    public $incrementing = false;

        protected $fillable = [
        'id',
        'name',
        'coin_id',
        'current_price',
        'price_change_percentage_24h',
        'image_url',
        'market_cap',
        'symbol',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($currency) {
            if (empty($currency->id)) {
                $currency->id = (string) Str::uuid(); // Generate UUID only when creating
            }
        });
    }
}
