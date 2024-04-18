<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'accommodation_id',
        'number_of_rooms',
        'number_of_peoples',
    ];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
