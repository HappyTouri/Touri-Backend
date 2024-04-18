<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\TourGuide;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'note' => fake()->sentence,
            'driver_id' => Driver::all()->random()->id,
            'tour_guide_id' => TourGuide::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'admin_seen_at' => now(),
            'operator_seen_at' => now(),
        ];
    }
}
