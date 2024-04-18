<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverPhoto extends Model
{
    use HasFactory;
    function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    protected $fillable = [
        'photo',
        'driver_id'
    ];
}
