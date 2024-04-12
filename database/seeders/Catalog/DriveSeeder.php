<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\Drive;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Drive::query()->count() == 0) {
            Drive::insert([
                ['name' => 'Передний'],
                ['name' => 'Задний'],
                ['name' => 'Полный'],
                ['name' => 'Подключаемый'],
            ]);
        }
    }
}
