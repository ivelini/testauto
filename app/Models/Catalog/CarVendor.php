<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *  Vendor
 *
 * @property integer $id
 * @property integer $country_id
 *
 * @property string $name
 *
 * @property CarCountry $country
 */
class CarVendor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'car_country_id',
        'name'
    ];

    /**
     * Country for vendor
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(CarCountry::class, 'car_country_id');
    }

    public function models()
    {
        return $this->hasMany(CarModel::class);
    }
}
