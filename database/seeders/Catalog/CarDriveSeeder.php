<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\CarDrive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarDriveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(CarDrive::query()->count() == 0) {
            CarDrive::insert([
                ['name' => 'Передний'],
                ['name' => 'Задний'],
                ['name' => 'Полный'],
                ['name' => 'Подключаемый'],
            ]);
        }
    }
}
