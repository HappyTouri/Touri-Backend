<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourguidePrice extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
