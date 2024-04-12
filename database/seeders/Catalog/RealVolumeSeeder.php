<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\Car;
use App\Models\Catalog\RealComplectAttribute;
use App\Models\Catalog\RealComplectValue;
use Illuminate\Database\Seeder;

class RealVolumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $attributes = RealComplectAttribute::all();

        Car::query()
            ->get()
            ->map(function ($car) use ($attributes) {
                $attributes->map(function ($attribute) use ($car){
                    for($i = 1; $i <= rand(0, 5); $i++) {
                        RealComplectValue::factory()
                            ->create([
                                'real_complect_attribute_id' => $attribute->id,
                                'car_id' => $car->id
                            ]);
                    }
                });
            });
    }
}
