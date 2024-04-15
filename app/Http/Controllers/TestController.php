<?php

namespace App\Http\Controllers;

use App\Http\Resources\Catalog\CarResource;
use App\Models\Catalog\Car;
use App\Models\Catalog\Traits\Cache\CacheTypeEnum;
use function MongoDB\BSON\toJSON;

class TestController extends Controller
{
    public function test()
    {
        return [
            'vendor' => [
                'name' => 'ООО Компания Телеком'
            ],
            'complectation' => [
                'name' => 'Пацанмобиль'
            ]
        ];
    }

    public function show($id)
    {
        return CarResource::make(
            (new Car)->getCache(CacheTypeEnum::page, $id) ??
            Car::findOrFail($id)->load(
                'color',
                'complectation.mark',
                'complectation.transmission',
                'complectation.bodyType',
                'complectation.drive',
                'complectation.engine'
            )->setCache(CacheTypeEnum::page)
        );
    }
}
