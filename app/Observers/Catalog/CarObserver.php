<?php

namespace App\Observers\Catalog;
use App\Models\Catalog\Car;
use App\Models\Catalog\Traits\Cache\CacheTypeEnum;
use Illuminate\Support\Facades\Cache;

class CarObserver
{
    /**
     * Обработать событие «created» модели Car.
     */
    public function created(Car $car): void
    {
        $car->load([
            'color',
            'complectation.mark.vendor.country',
            'complectation.transmission',
            'complectation.bodyType',
            'complectation.drive',
            'complectation.engine'
        ])
            ->setCache(CacheTypeEnum::page);
    }

    /**
     * Обработать событие «updated» модели Car.
     */
    public function updated(Car $car): void
    {
        $car->load([
                'color',
                'complectation.mark.vendor.country',
                'complectation.transmission',
                'complectation.bodyType',
                'complectation.drive',
                'complectation.engine'
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
