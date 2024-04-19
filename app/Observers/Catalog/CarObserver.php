<?php

namespace App\Observers\Catalog;
use App\Models\Catalog\Car;
use App\Models\Catalog\Traits\Cache\CacheTypeEnum;
use Illuminate\Support\Facades\Cache;

class CarObserver
{
    /**
     * Обработать событие «create/update» даже если нет изменений модели Car.
     */
    public function saved(Car $car): void
    {
        $car->load([
            'color',
            'complectation.mark.vendor.country',
            'complectation.transmission',
            'complectation.bodyType',
            'complectation.drive',
            'complectation.engine',
            'realAttributes'
        ])
            ->setCache(CacheTypeEnum::page);
    }

    /**
     * Обработать событие «deleted» модели Car.
     */
    public function deleted(Car $car): void
    {
        $car->deleteCache(CacheTypeEnum::page);
    }
}
