<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mobile',
        'car_model',
        'number_of_seats',
        'driver_rate',
        'driver_price',
        'note',
        'city_id',
        'transportation_id',
    ];
    function car_photos()
    {
        return $this->hasMany(CarPhoto::class);
    }
    function driver_photos()
    {
        return $this->hasMany(DriverPhoto::class);
    }
    function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    function city()
    {
        return $this->belongsTo(City::class);
    }
    function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }
}
