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
 * @property Country $country
 */
class Vendor extends Model
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
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
