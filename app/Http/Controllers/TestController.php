<?php

namespace App\Http\Controllers;

use App\Http\Resources\Catalog\CarResource;
use App\Models\Catalog\Car;
use App\Models\Catalog\Traits\Cache\CacheTypeEnum;


class TestController extends Controller
{
    public function test()
    {
        dd(json_encode([
            'country' => 'Россия',
            'vendor' => 'Авто ТАЗ',
            'mark' => 'Веста',
            'complectation' => 'Супер +',
            'color' => 'Баклажан',
            'vin' => '565497H3',
            'price' => '100500',
            'year' => '2024',
            'body_type' => 'Седан',
            'engine' => 'Бензин',
            'drive' => 'Передний',
            'transmission' => 'Механика',
            'volume_engine' => '1500',
            'power' => '3500',
            'speed' => '210',
            'real_attributes' => [
                [
                    'name' => 'Противоугонная система',
                    'values' => ['А','Б','В','Г']
                ],
                [
                    'name' => 'Комфорт',
                    'values' => ['А','Б','В','Г']
                ],
                [
                    'name' => 'Салон и интерьер',
                    'values' => ['А','Б','В','Г']
                ]
            ]
        ], JSON_UNESCAPED_UNICODE));
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);

        return CarResource::make(
            (new Car)->getCache(CacheTypeEnum::page, $id) ??
            $car->load(
                    'color',
                    'complectation.mark.vendor.country',
                    'complectation.transmission',
                    'complectation.bodyType',
                    'complectation.drive',
                    'complectation.engine',
                    'realAttributes'
                )->setCache(CacheTypeEnum::page)
        );
    }
}
