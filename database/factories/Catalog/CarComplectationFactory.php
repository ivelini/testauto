<?php

namespace Database\Factories\Catalog;

use App\Models\Catalog\CarBodyType;
use App\Models\Catalog\CarDrive;
use App\Models\Catalog\CarEngine;
use App\Models\Catalog\CarTransmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog\CarComplectation>
 */
class CarComplectationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = [
            'Комфорт',
            'Люкс',
            'Недолюкс',
            'Пацанмобиль',
            'Люкс +',
        ];

        return [
            'car_transmission_id' => CarTransmission::query()->inRandomOrder()->first()->id,
            'car_body_type_id' => CarBodyType::query()->inRandomOrder()->first()->id,
            'car_engine_id' => CarEngine::query()->inRandomOrder()->first()->id,
            'car_drive_id' => CarDrive::query()->inRandomOrder()->first()->id,
            'name' => $name[array_rand($name)],
            'volume_engine' => fake()->randomNumber(3, true),
            'power' => fake()->randomNumber(3, true),
            'speed' => fake()->randomNumber(3, true),
        ];
    }
}
