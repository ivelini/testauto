<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Mark auto
 *
 * @property integer $id
 * @property integer $vendor_id
 *
 * @property string $name
 *
 * @property Vendor $vendor
 */
class Mark extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'vendor_id',
        'name'
    ];

    /**
     * Current vendor for model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    /**
     * All complectations for model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complectations()
    {
        return $this->hasMany(Complectation::class);
    }

    /**
     * All cars for current model auto
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function cars()
    {
        return $this->hasManyThrough(Car::class, Complectation::class);
    }
}
