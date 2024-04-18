<?php

namespace Database\Factories;

use App\Models\ConfirmationPhoto;
use App\Models\InvoicePhoto;
use App\Models\PaymentPhoto;
use App\Models\TourDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelReservation>
 */
class HotelReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from' => fake()->date(),
            'till' => fake()->date(),
            'email_send' => fake()->numberBetween(0, 10),
            'available' => fake()->numberBetween(0, 10),
            'confirmed' => fake()->numberBetween(0, 10),
            'paid' => fake()->numberBetween(0, 10),
            'email_canceled' => fake()->numberBetween(0, 10),
            
           
            'tour_detail_id' => TourDetail::all()->random()->id,
        ];
    }
}
