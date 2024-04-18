<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPhoto extends Model
{
    protected $fillable = [
        'photo',
        'tour_id',

    ];
    use HasFactory;
    function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
