<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  Car body type
 *
 * @property integer $id
 *
 * @property string $name
 *
 * @property Collection $complectations
 */
class BodyType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    /**
     * All complectations for body type
     */
    public function complectations(): HasMany
    {
        return $this->hasMany(Complectation::class);
    }
}
