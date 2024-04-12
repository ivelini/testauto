<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\CarBodyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(CarBodyType::query()->count() == 0) {
            CarBodyType::insert([
                ['name' => 'Внедерожник'],
                ['name' => 'Седан'],
                ['name' => 'Лифтбэк'],
                ['name' => 'Универсал'],
                ['name' => 'Минивен'],
                ['name' => 'Хэчбэк'],
                ['name' => 'Пикап'],
            ]);
        }
    }
}
