<?php

namespace Database\Factories;

use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelSeason>
 */
class HotelSeasonFactory extends Factory
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
            'extrabed_price'=>fake()->numberBetween(100, 1000),
            'accommodation_id'=> Accommodation::all()->random()->id,
          
        ];
    }
}
