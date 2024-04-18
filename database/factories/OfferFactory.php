<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\TourStatus;
use App\Models\Transportation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'country_id' => Country::all()->random()->id,
            'tour_status_id' => TourStatus::all()->random()->id,
            'tour_title' => fake()->sentence,
            'tour_name' => fake()->sentence,
            'number_of_days' => fake()->numberBetween(1, 10),
            'from' => fake()->date,
            'till' => fake()->date,
            'transportation_id' => Transportation::all()->random()->id,
            'number_of_people' => fake()->numberBetween(1, 10),
            'transportation_price' => fake()->numberBetween(100, 1000),
            'tour_guide_price' => fake()->numberBetween(100, 1000),
            'hotels_price' => fake()->numberBetween(100, 1000),
            'profit_price' => fake()->numberBetween(100, 1000),
            'tour_price' => fake()->numberBetween(100, 1000),
            
        ];
    }
} 

