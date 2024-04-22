<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  Car drive
 *
 * @property integer $id
 *
 * @property string $name
 * @property Collection $complectations
 */
class Drive extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    /**
     * All complectations for car drive
     */
    public function complectations(): HasMany
    {
        return $this->hasMany(Complectation::class);
    }
}
