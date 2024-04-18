<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accommodation;
use App\Models\AccommodationPhoto;
use App\Models\AccommodationType;
use App\Models\AirTicketPhoto;
use App\Models\ApartmentDetail;
use App\Models\ApartmentSeasonPrice;
use App\Models\CarPhoto;
use App\Models\City;
use App\Models\ConfirmationPhoto;
use App\Models\Country;
use App\Models\Driver;
use App\Models\HotelPrice;
use App\Models\HotelReservation;
use App\Models\HotelSeason;
use App\Models\InvoicePhoto;
use App\Models\Offer;
use App\Models\PassportPhoto;
use App\Models\PaymentPhoto;
use App\Models\Reservation;
use App\Models\RoomCategory;
use App\Models\RRoomCategory;
use App\Models\Rule;
use App\Models\Tour;
use App\Models\TourDetail;
use App\Models\TourGuide;
use App\Models\TourPhoto;
use App\Models\TourStatus;
use App\Models\TourTitle;
use App\Models\Transportation;
use App\Models\TransportationPrice;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Country::factory(5)->create();

        
        $transportation_types = [
            'regular', 'van', 'microbus', 'bus',
        ];

        foreach ($transportation_types as $type) {
            Transportation::factory()->create([
                'type' => $type,
            ]);
        }
         $accommodation_types= [
            'hotel', 'apartment'
        ];

        foreach ($accommodation_types as $type) {
            AccommodationType::factory()->create([
                'accommodation_type' => $type,
            ]);
        }
        $room_categories = [
            'single', 'double', 'dulex', 'triple'
        ];

        foreach ($room_categories as $type) {
            RoomCategory::factory()->create([
                'room_category' => $type,
            ]);
        }
        
        ApartmentDetail::factory(20)->create();

        $tour_statuses= [
            'reserved', 'on-going', 'canceled'
        ];

        foreach ($tour_statuses as $type) {
            TourStatus::factory()->create([
                'status' => $type,
            ]);
        }
        TourTitle::factory(20)->create();

        $rules=['admin', 'customer', 'travelagancy','customerservice','touroperator'];
        foreach ($rules as $rule) {
            Rule::factory()->create([
                'rule' => $rule,
            ]);
        }
        City::factory(20)->create();
        Tour::factory(20)->create();
        TourPhoto::factory(20)->create();
        Driver::factory(20)->create();
        CarPhoto::factory(20)->create();
        TourGuide::factory(20)->create();
        Accommodation::factory(20)->create();
        HotelSeason::factory(5)->create();
        AccommodationPhoto::factory(10)->create();
        ApartmentSeasonPrice::factory(5)->create();
        User::factory(20)->create();
        Offer::factory(20)->create();
        Reservation::factory(20)->create();
        PassportPhoto::factory(10)->create();
        TourDetail::factory(10)->create();
        HotelReservation::factory(10)->create();
        InvoicePhoto::factory(10)->create();
        AirTicketPhoto::factory(10)->create();
        
        ConfirmationPhoto::factory(10)->create();
        PaymentPhoto::factory(10)->create();
        
        TransportationPrice::factory(10)->create();
       
        RRoomCategory::factory(10)->create();
        HotelPrice::factory(10)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
