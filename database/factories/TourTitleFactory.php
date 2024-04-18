<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TourTitle>
 */
class TourTitleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_EN' =>fake(20)->sentence,
            'title_AR' =>fake(20)->sentence,
            'title_RU' =>fake(20)->sentence,
        ];
    }
}
