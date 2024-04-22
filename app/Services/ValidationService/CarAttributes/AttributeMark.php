<?php

namespace App\Services\ValidationService\CarAttributes;

use App\Models\Catalog\Mark;

/**
 * Mark attribute
 */
class AttributeMark extends AttributeBuilder
{

    protected function getModelClass(): string
    {
        return Mark::class;
    }

    protected function emptyMessage(): string
    {
        return 'Марка авто';
    }

    protected function getForeignKey(): string
    {
        return 'mark_id';
    }
}
