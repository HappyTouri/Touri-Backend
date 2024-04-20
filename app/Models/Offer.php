<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'operator_id',
        'country_id',
        'website_share',
        'tour_title',
        'tour_header_id',
        'transportation_id',
        'from',
        'till',
        'number_of_days',
        'transportation_price',
        'tour_guide_price',
        'hotels_price',
        'profit_price',
        'tour_price',
        'note',
        'reserved',
        'number_of_people',
        'driver_id',
        'tourguide_id',
        'customer_id',








    ];
    function tour_details()
    {
        return $this->hasMany(TourDetail::class);
    }


    function passports()
    {
        return $this->hasMany(PassportPhoto::class);
    }

    function airtickets()
    {
        return $this->hasMany(AirTicketPhoto::class);
    }
    function country()
    {
        return $this->belongsTo(Country::class);
    }
    function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }

    function tour_header()
    {
        return $this->belongsTo(TourHeader::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
