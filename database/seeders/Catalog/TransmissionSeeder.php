<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\Transmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class TransmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Transmission::query()->count() == 0) {
            Transmission::insert([
                ['name' => 'Механика'],
                ['name' => 'Автомат'],
                ['name' => 'Робот'],
                ['name' => 'Вариатор'],
            ]);
        }

    }
}
