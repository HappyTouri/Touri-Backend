<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationType extends Model
{
    use HasFactory;
    protected $fillable = [
        'accommodation_type',
    ];

    function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }


}
