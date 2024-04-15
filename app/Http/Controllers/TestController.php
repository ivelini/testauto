<?php

namespace App\Http\Controllers;

use App\Http\Resources\Catalog\CarResource;
use App\Models\Catalog\Car;

class TestController extends Controller
{
    public function test()
    {
        $car = Car::query()
            ->inRandomOrder()
            ->with(['color', 'complectation'])
            ->first();

        dd(
            $car,
        );
    }

    public function show(Car $car)
    {
        return CarResource::make($car->load(
            'color',
            'complectation.mark',
            'complectation.transmission',
            'complectation.bodyType',
            'complectation.drive',
            'complectation.engine'
        ));
    }
}
