<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelSeason extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'till',
        'extrabed_price',
        'accommodation_id',
    ];
    function hotel_prices()
    {
        return $this->hasMany(HotelPrice::class);
    }
    function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    function hotelRoomCategories()
    {
        return $this->hasMany(HotelRoomCategories::class, '', 'id');
    }


}
