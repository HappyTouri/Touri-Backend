<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelPrice extends Model
{
    use HasFactory;
    function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
    function hotel_season()
    {
        return $this->belongsTo(HotelSeason::class);
    }

    function hotelRoomCategoried()
    {
        return $this->belongsToMany(HotelRoomCategories::class);
    }
}
