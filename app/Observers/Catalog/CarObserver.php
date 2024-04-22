<?php

namespace App\Observers\Catalog;
use App\Models\Catalog\Car;
use App\Models\Catalog\Traits\Cache\CacheTypeEnum;
use Illuminate\Support\Facades\Cache;

class CarObserver
{
    /**
     * Handle the "create/update" event even if there are no changes to the Car model.
     */
    public function saved(Car $car): void
    {
        // for product card
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
     * Handle the “deleted” event of the Car model.
     */
    public function deleted(Car $car): void
    {
        //delete cache for product card
        $car->deleteCache(CacheTypeEnum::page);
    }
}
