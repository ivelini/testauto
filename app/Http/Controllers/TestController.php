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
            'vendor' => 'ООО Компания Телеком',
            'mark' => 'Модель № 470',
            'complectation' => 'Пацанмобиль',
            'color' => 'Хаки',
            'vin' => '58455ADU654H3',
            'price' => '100500',
            'year' => '2024',
            'real_complectation' => [
                'Противоугонная система' => ['А','Б','В','Г'],
                'Комфорт' => ['А','Б','В','Г'],
                'Салон и интерьер' => ['А','Б','В','Г']
            ]
        ], JSON_UNESCAPED_UNICODE));
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
