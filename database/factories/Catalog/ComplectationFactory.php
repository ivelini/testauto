<?php

namespace Database\Factories\Catalog;

use App\Models\Catalog\BodyType;
use App\Models\Catalog\Drive;
use App\Models\Catalog\Engine;
use App\Models\Catalog\Transmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog\Complectation>
 */
class ComplectationFactory extends Factory
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
            'transmission_id' => Transmission::query()->inRandomOrder()->first()->id,
            'body_type_id' => BodyType::query()->inRandomOrder()->first()->id,
            'engine_id' => Engine::query()->inRandomOrder()->first()->id,
            'drive_id' => Drive::query()->inRandomOrder()->first()->id,
            'name' => $name[array_rand($name)],
            'volume_engine' => fake()->randomNumber(3, true),
            'power' => fake()->randomNumber(3, true),
            'speed' => fake()->randomNumber(3, true),
        ];
    }
}
