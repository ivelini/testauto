<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected $fillable = [
        'complectation_id',
        'color_id',
        'year',
        'vin',
        'price'
    ];

    public function complectation()
    {
        return $this->belongsTo(Complectation::class, 'complectation_id');
    }

    public function realVolueComplectation()
    {
        return $this->hasMany(RealComplectValue::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    /**
     * @return Attribute
     */
    protected function mark(): Attribute
    {
        return Attribute::get(fn() => $this->complectation->mark);
    }

    /**
     * @return Attribute
     */
    protected function vendor(): Attribute
    {
        return Attribute::get(fn() => $this->complectation->mark->vendor);
    }

    /**
     * @return Attribute
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
        $groupedRealComplectation = $this->realVolueComplectation()
            ->with('attribute')
            ->get()
            ->groupBy(fn($volumeComplectation) => $volumeComplectation->attribute->name);

        return Attribute::get(fn() => $groupedRealComplectation);
    }
}
