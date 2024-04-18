<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransportationPrice>
 */
class TransportationPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        
            'country_id' => Country::all()->random()->id,
            'transportation_id' => Transportation::all()->random()->id,
            'price' => fake()->numberBetween(100, 1000),
           
        ];
    }
}
