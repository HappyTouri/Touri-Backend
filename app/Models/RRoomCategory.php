<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RRoomCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_detail_id',
        'room_category_id',
        'extra_bed',
        'room_price',
        'extrabed_price',
    ];
    function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }
    function tour_detail()
    {
        return $this->belongsTo(TourDetail::class);
    }
}
