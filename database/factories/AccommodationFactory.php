<?php

namespace Database\Factories;

use App\Models\AccommodationType;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accommodation>
 */
class AccommodationFactory extends Factory
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
            'rate'=>fake()->randomDigitNot(0),
            'mobile'=>fake()->phoneNumber(),
            'address'=>fake()->address(),
            'email'=>fake()->safeEmail(),
            'price_list_PDF'=>fake()->randomDigitNot(0),
            'share'=>fake()->boolean(),
            'note'=>fake()->sentence(),
            'cover_photo'=>fake()->imageUrl(),
            'video_link'=>fake()->url(),
            'city_id'=>City::all()->random()->id,
            'accommodation_type_id'=>AccommodationType::all()->random()->id,
        ];
    }
}
