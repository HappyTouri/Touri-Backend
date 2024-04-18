<?php

namespace Database\Factories;

use App\Models\Accommodation;
use App\Models\Offer;
use App\Models\Tour;
use App\Models\TourGuide;
use App\Models\TourTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourDetail>
 */
class TourDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'offer_id' => Offer::all()->random()->id,
        
            'date' => fake()->date(),
            'number_of_room' => fake()->numberBetween(1, 5),
            'extra_bed' => fake()->numberBetween(0, 1),
            'tour_title_id' => TourTitle::all()->random()->id,
            'tour_id' => Tour::all()->random()->id,
            'accommodation_id' => Accommodation::all()->random()->id,
            'tour_guide_id' => TourGuide::all()->random()->id,
        ];
    }
}

