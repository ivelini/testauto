<?php

namespace Database\Factories\Catalog;

use App\Models\Catalog\CarColor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_color_id' => CarColor::query()->inRandomOrder()->first()->id,
            'year' => fake()->year,
            'vin' => fake()->postcode(),
            'price' => fake()->randomNumber(5),
        ];
    }
}
