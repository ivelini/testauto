<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\Engine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Engine::query()->count() == 0) {
            Engine::insert([
                ['name' => 'Дизель'],
                ['name' => 'Бензин'],
                ['name' => 'Электрический'],
                ['name' => 'Гибрид'],
            ]);
        }
    }
}
