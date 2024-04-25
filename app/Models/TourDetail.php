<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'date',
        'tour_id',
        'tourguide',
        'accommodation_id',
        'number_of_room',
        'accommodation_price',

    ];
    function r_room_categories()
    {
        return $this->hasMany(RRoomCategory::class);
    }
    function hotel_reservations()
    {
        return $this->hasMany(HotelReservation::class);
    }
    function tour()
    {
        return $this->belongsTo(Tour::class);
    }
    function tour_title()
    {
        return $this->belongsTo(TourTitle::class);
    }
    function offer()
    {
        return $this->belongsTo(Offer::class);
    }
    function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
    function tour_guide()
    {
        return $this->belongsTo(TourGuide::class);
    }

    function Confirmation()
    {
        return $this->hasMany(ConfirmationPhoto::class);
    }

    function invoice()
    {
        return $this->hasMany(InvoicePhoto::class);
    }
    function payment()
    {
        return $this->hasMany(PaymentPhoto::class);
    }
}
