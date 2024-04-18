<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'tour_title_EN',
        'tour_title_AR',
        'tour_title_RU',
        'tour_title_local',
        'tour_description_EN',
        'tour_description_AR',
        'tour_description_RU',
        'tour_description_local',
        'video_link',
        'city_id',
    ];
    use HasFactory;
    function tour_photos()
    {
        return $this->hasMany(TourPhoto::class);
    }
    function tour_details()
    {
        return $this->hasMany(TourDetail::class);
    }
    function city()
    {
        return $this->belongsTo(City::class);
    }
}
