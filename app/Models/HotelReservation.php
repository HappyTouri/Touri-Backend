<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelReservation extends Model
{
    use HasFactory;
    function tour_detail(){
        return $this->belongsTo(TourDetail::class);
    }
    function confirmation_photos(){
        return $this->hasMany(ConfirmationPhoto::class);
    }
    function payment_photos(){
        return $this->hasMany(PaymentPhoto::class);
    }
    function invoice_photos(){
        return $this->hasMany(InvoicePhoto::class);
    }
}
