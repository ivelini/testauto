<?php

namespace App\Services\ValidationService\CarAttributes;


use App\Models\Catalog\Vendor;


class AttributeVendor extends AttributeBuilder
{

    protected function getModelClass(): string
    {
        return Vendor::class;
    }

    protected function emptyMessage(): string
    {
        return 'Производитель авто';
    }

    protected function getForeignKey(): string
    {
        return 'vendor_id';
    }
}
