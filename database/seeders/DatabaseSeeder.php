<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Catalog\Car;
use App\Models\Catalog\CarBodyType;
use App\Models\Catalog\CarColor;
use App\Models\Catalog\CarComplectation;
use App\Models\Catalog\CarCountry;
use App\Models\Catalog\CarModel;
use App\Models\Catalog\CarVendor;
use Database\Seeders\Catalog\CarBodySeeder;
use Database\Seeders\Catalog\CarDriveSeeder;
use Database\Seeders\Catalog\CarEngineSeeder;
use Database\Seeders\Catalog\CarRealAttributeSeeder;
use Database\Seeders\Catalog\CarRealVolumeSeeder;
use Database\Seeders\Catalog\CarTransmissionSeeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CarTransmissionSeeder::class,
            CarBodySeeder::class,
            CarEngineSeeder::class,
            CarDriveSeeder::class,
            CarRealAttributeSeeder::class
        ]);

        CarColor::factory()->count(20)->create();

        CarCountry::factory()
            ->has(
                CarVendor::factory()
                    ->count(3)
                    ->has(
                        CarModel::factory()
                            ->count(3)
                            ->has(
                                CarComplectation::factory()
                                    ->count(3)
                                    ->has(Car::factory(), 'cars'),
                                'complectations'
                            ),
                        'models'
                    )
                , 'vendors'
            )
            ->create();

        $this->call([CarRealVolumeSeeder::class]);
    }
}
