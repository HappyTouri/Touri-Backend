<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    protected $fillable = [
        'country',
        'country_icon'
    ];
    use HasFactory;



    function cities()
    {
        return $this->hasMany(City::class, );
    }
    function transportation_prices()
    {
        return $this->hasMany(TransportationPrice::class);
    }
    function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    function tourguide_prices()
    {
        return $this->hasMany(TourguidePrice::class);
    }




}

