<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *  Car
 *
 *
 */
class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_complectation_id',
        'car_color_id',
        'year',
        'vin',
        'price'
    ];

    public function complectation()
    {
        return $this->belongsTo(CarComplectation::class, 'car_complectation_id');
    }

    public function color()
    {
        return $this->belongsTo(CarColor::class, 'car_color_id');
    }

    public function getModelAttribute()
    {
        return $this->complectation->model;
    }

    public function getVendorAttribute()
    {
        return $this->complectation->model->vendor;
    }
}
