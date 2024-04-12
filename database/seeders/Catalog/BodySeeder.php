<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\BodyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(BodyType::query()->count() == 0) {
            BodyType::insert([
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
