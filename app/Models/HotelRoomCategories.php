<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoomCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        "accommodation_id",
        "room_category_id",
    ];


    function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    function hotelPrices()
    {
        return $this->hasMany(HotelPrice::class);
    }




}
