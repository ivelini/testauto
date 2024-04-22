<?php

namespace App\Models\Catalog;

use App\Casts\Catalog\CarrealAttributes;
use App\Models\Catalog\Traits\Cache\CacheTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *  Car
 *
 * @property int $id
 * @property int $complectation_id
 * @property int $color_id
 *
 * @property int $year
 * @property int $vin
 * @property int $price
 *
 * @property Complectation $complectation
 * @property Color $color
 * @property Mark $mark
 * @property Vendor $vendor
 * @property Country $country
 * @property Collection $real_attributes
 *
 * @property ?BelongsToMany $realAttributes;
 */
class Car extends Model
{
    use HasFactory;
    use CacheTrait;

    protected $fillable = [
        'complectation_id',
        'color_id',
        'year',
        'vin',
        'price'
    ];

    /**
     * Complectation current car
     */
    public function complectation(): BelongsTo
    {
        return $this->belongsTo(Complectation::class, 'complectation_id');
    }

    /**
     * All real attributes current car
     */
    public function realAttributes(): BelongsToMany
    {
        return $this->belongsToMany(RealComplectAttribute::class, 'real_complect_values')
            ->as('attribute_value')
            ->using(RealComplectValue::class)
            ->withPivot(['value']);
    }

    /**
     * Color vendor current car
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     *
     */
    protected function mark(): Attribute
    {
        return Attribute::get(fn() => $this->complectation->mark);
    }

    /**
     * Attribute vendor current car
     */
    protected function vendor(): Attribute
    {
        return Attribute::get(fn() => $this->complectation->mark->vendor);
    }

    /**
     *Attribute country current car
     */
    protected function country(): Attribute
    {
        return Attribute::get(fn() => $this->complectation->mark->vendor->country);
    }
}
