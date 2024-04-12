<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\Car;
use App\Models\Catalog\CarRealComplectAttribute;
use App\Models\Catalog\CarRealComplectVolume;
use Illuminate\Database\Seeder;

class CarRealVolumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $attributes = CarRealComplectAttribute::all();

        Car::query()
            ->get()
            ->map(function ($car) use ($attributes) {
                $attributes->map(function ($attribute) use ($car){
                    for($i = 1; $i <= rand(0, 5); $i++) {
                        CarRealComplectVolume::factory()
                            ->create([
                                'car_real_complect_attribute_id' => $attribute->id,
                                'car_id' => $car->id
                            ]);
                    }
                });
            });
    }
}
