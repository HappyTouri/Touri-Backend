<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_EN',
        'title_AR',
        'title_RU',
        'day',
    ];
}
