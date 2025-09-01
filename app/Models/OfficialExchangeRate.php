<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialExchangeRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'currency',
        'buy',
        'sell',
    ];
}
