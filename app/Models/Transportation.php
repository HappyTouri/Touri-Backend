<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    protected $fillable = [
        'type',
    ];
    use HasFactory;
    function transportation_prices()
    {
        return $this->hasMany(TransportationPrice::class);
    }
    function drivers()
    {
        return $this->hasMany(Driver::class);
    }
}
