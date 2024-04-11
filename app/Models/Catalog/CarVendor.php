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
 * @property CarContry $country
 */
class CarVendor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'country_id',
        'name'
    ];

    /**
     * Country for vendor
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contry()
    {
        return $this->belongsTo(CarContry::class);
    }
}
