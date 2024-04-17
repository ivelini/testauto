<?php

namespace App\Services\ValidationService\CarAttributes;

use App\Models\Catalog\Complectation;

class AttributeComplectation extends AttributeBuilder
{

    protected function getModelClass(): string
    {
        return Complectation::class;
    }

    protected function emptyMessage(): string
    {
        return 'Комплектация';
    }

    protected function getForeignKey(): string
    {
        return 'complectation_id';
    }
}
