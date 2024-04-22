<?php

namespace App\Services\ValidationService\CarAttributes;


use App\Models\Catalog\Country;
use App\Models\Catalog\Vendor;

/**
 * Country attribute
 */
class AttributeCountry extends AttributeBuilder
{

    protected function getModelClass(): string
    {
        return Country::class;
    }

    protected function emptyMessage(): string
    {
        return 'Страна производителя';
    }

    protected function getForeignKey(): string
    {
        return 'country_id';
    }
}
