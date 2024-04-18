<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'mobile'=>fake()->phoneNumber(),
            'driver_photo'=>fake()->imageUrl(),
            'car_model'=>fake()->sentence(3),
            'number_of_seats'=>fake()->randomDigit(),
            'driver_rate'=>fake()->randomDigit(),
            'driver_price'=>fake()->randomDigitNot(0),
            'note'=>fake()->sentence(),
            'City_id'=>City::all()->random()->id,
            'transportation_id'=>Transportation::all()->random()->id,
          
        ];
    }
}
