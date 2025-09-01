<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlueExchangeRate extends Model
{
    protected $fillable = [
        'date',
        'source',
        'rate',
        'type',
    ];
}
