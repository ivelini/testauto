<?php

namespace App\Models\Catalog;


use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 *  Pivot table values from real attribute
 */
class RealComplectValue extends Pivot
{
    protected $table = 'real_complect_values';
    protected $fillable = [
        'real_complect_attribute_id',
        'car_id',
        'value',
    ];
}
