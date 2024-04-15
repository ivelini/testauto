<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  Страна производителя
 *
 * @property integer $id
 * @property string $name
 *
 * @property Collection $vendors
 *
 */
class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    /**
     * All vendors for country
     */
    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }
}
