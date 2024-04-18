<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportPhoto extends Model
{
    use HasFactory;
    protected $fillable = [
        'offer_id',
        'photo',
    ];
    // function reservation(){
    //     return $this->belongsTo(Reservation::class);
    // }
}
