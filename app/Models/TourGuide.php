<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    use HasFactory;
    function city(){
        return $this->belongsTo(City::class);
    }
    function tour_details(){
        return $this->hasMany(TourDetail::class);
    }

}
