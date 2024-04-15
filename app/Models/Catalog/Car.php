<?php

namespace App\Models\Catalog;

use App\Models\Catalog\Traits\Cache\CacheTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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
 * @property Collection $real_complectation
 *
 *
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
     *
     */
    public function complectation(): BelongsTo
    {
        return $this->belongsTo(Complectation::class, 'complectation_id');
    }

    /**
     *
     */
    public function realValueComplectation(): HasMany
    {
        return $this->hasMany(RealComplectValue::class);
    }

    /**
     *
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
     *
     */
    protected function vendor(): Attribute
    {
        return Attribute::get(fn() => $this->complectation->mark->vendor);
    }

    /**
     *
     */
    protected function country(): Attribute
    {
        return Attribute::get(fn() => $this->complectation->mark->vendor->country);
    }

    /**
     *
     * @return Attribute
     */
    protected function realComplectation(): Attribute
    {
        $groupedRealComplectation = $this->realValueComplectation()
            ->with('attribute')
            ->get()
            ->groupBy(fn($valueComplectation) => $valueComplectation->attribute->name);

        return Attribute::get(fn() => $groupedRealComplectation);
    }
}
