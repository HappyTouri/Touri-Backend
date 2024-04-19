<?php

namespace Database\Factories;

use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApartmentDetail>
 */
class ApartmentDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number_of_rooms'=>fake()->randomDigit(),
            'number_of_peoples'=>fake()->randomDigit(),
            'accommodation_id'=> Accommodation::all()->random()->id
        ];
    }
}
