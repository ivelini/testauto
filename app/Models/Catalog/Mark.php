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
     * Current vendor for mark auto
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * All complectations current model
     */
    public function complectations(): HasMany
    {
        return $this->hasMany(Complectation::class);
    }

    /**
     * All cars current mark auto
     */
    public function cars(): HasManyThrough
    {
        return $this->hasManyThrough(Car::class, Complectation::class);
    }
}
