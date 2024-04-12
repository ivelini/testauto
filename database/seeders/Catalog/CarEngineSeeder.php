<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\CarEngine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarEngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(CarEngine::query()->count() == 0) {
            CarEngine::insert([
                ['name' => 'Дизель'],
                ['name' => 'Бензин'],
                ['name' => 'Электрический'],
                ['name' => 'Гибрид'],
            ]);
        }
    }
}
