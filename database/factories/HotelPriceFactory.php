<?php

namespace Database\Factories;

use App\Models\HotelSeason;
use App\Models\RoomCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelPrice>
 */
class HotelPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_category_id' => RoomCategory::all()->random()->id,
            'hotel_season_id' => HotelSeason::all()->random()->id,
        ];
    }
}
