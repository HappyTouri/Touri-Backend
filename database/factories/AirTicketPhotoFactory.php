<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AirTicketPhoto>
 */
class AirTicketPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'air_ticket_Photo' => fake()->imageUrl(),
            'reservation_id'=>Reservation::all()->random()->id,
        ];
    }
}
