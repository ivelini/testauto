<?php

namespace App\Http\Controllers\Api\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Catalog\CarResource;
use App\Models\Catalog\Car;
use App\Models\Catalog\Traits\Cache\CacheTypeEnum;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function show($id)
    {

        return CarResource::make(
            (new Car)->getCache(CacheTypeEnum::page, $id) ??
            Car::findOrFail($id)
                ->append('real_attributes')
                ->load(
                    'color',
                    'complectation.mark.vendor.country',
                    'complectation.transmission',
                    'complectation.bodyType',
                    'complectation.drive',
                    'complectation.engine'
                )->setCache(CacheTypeEnum::page)
        );
    }
}
