<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
//    use HasFactory;
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
}
