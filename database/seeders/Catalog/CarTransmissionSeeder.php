<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\CarTransmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CarTransmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(CarTransmission::query()->count() == 0) {
            CarTransmission::insert([
                ['name' => 'Механика'],
                ['name' => 'Автомат'],
                ['name' => 'Робот'],
                ['name' => 'Вариатор'],
            ]);
        }

    }
}
