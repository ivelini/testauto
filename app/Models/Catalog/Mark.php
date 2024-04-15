<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    /**
     * All complectations for model
     */
    public function complectations(): HasMany
    {
        return $this->hasMany(Complectation::class);
    }

    /**
     * All cars for current model auto
     */
    public function cars(): HasManyThrough
    {
        return $this->hasManyThrough(Car::class, Complectation::class);
    }
}
