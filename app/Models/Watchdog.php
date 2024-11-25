<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchdog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'currency_id',
        'password',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
