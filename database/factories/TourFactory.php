<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tour_title_EN'=>fake()->sentence(),
            'tour_title_AR'=>fake()->sentence(),
            'tour_title_RU'=>fake()->sentence(),
            'tour_title_local'=>fake()->sentence(),
            'tour_description_EN'=>fake()->sentence(),
            'tour_description_AR'=>fake()->sentence(),
            'tour_description_RU'=>fake()->sentence(),
            'tour_description_local'=>fake()->sentence(),
            'video_link'=>fake()->url(),
            'city_id'=>City::all()->random()->id
        ];
    }
}
