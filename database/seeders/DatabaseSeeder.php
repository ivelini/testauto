<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Catalog\Car;
use App\Models\Catalog\Color;
use App\Models\Catalog\Complectation;
use App\Models\Catalog\Country;
use App\Models\Catalog\Mark;
use App\Models\Catalog\Vendor;
use Database\Seeders\Catalog\BodySeeder;
use Database\Seeders\Catalog\DriveSeeder;
use Database\Seeders\Catalog\EngineSeeder;
use Database\Seeders\Catalog\RealAttributeSeeder;
use Database\Seeders\Catalog\RealVolumeSeeder;
use Database\Seeders\Catalog\TransmissionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TransmissionSeeder::class,
            BodySeeder::class,
            EngineSeeder::class,
            DriveSeeder::class,
            RealAttributeSeeder::class
        ]);

        Color::factory()->count(20)->create();

        Country::factory()
            ->has(
                Vendor::factory()
                    ->count(3)
                    ->has(
                        Mark::factory()
                            ->count(3)
                            ->has(
                                Complectation::factory()
                                    ->count(3)
                                    ->has(Car::factory(), 'cars'),
                                'complectations'
                            ),
                        'marks'
                    )
                , 'vendors'
            )
            ->create();
    }
}
