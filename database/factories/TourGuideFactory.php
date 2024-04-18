<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourGuide>
 */
class TourGuideFactory extends Factory
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
            'email'=>fake()->safeEmail(),
            'photo'=>fake()->imageUrl(),
            'price_per_day'=>fake()->randomDigitNot(0),
            'date_of_birth'=>fake()->date(),
            'note'=>fake()->sentence(),
            'city_id'=>City::all()->random()->id,
        ];
    }
}
