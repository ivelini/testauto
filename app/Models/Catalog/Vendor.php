<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     *
     */
    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }
}
