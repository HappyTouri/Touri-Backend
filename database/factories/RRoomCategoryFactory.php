<?php

namespace Database\Factories;

use App\Models\RoomCategory;
use App\Models\TourDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RRoomCategory>
 */
class RRoomCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_category_id' =>RoomCategory::all()->random()->id,
            'tour_detail_id' =>TourDetail::all()->random()->id,
            'extra_bed' => fake()->numberBetween(10, 500),
        ];
    }
}
