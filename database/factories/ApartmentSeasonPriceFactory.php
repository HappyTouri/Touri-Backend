<?php

namespace Database\Factories;

use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApartmentSeasonPrice>
 */
class ApartmentSeasonPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from' =>fake()->date(),
            'till' =>fake()->date(),
         'season_price' =>fake()->numberBetween(1000, 10000),
         'accommodation_id' => Accommodation::all()->random()->id,
        
        ];
    }
}
