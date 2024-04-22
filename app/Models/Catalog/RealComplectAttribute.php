<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RealComplectAttribute extends Model
{
    use HasFactory;

    /**
     * All values current real attribute
     */
    public function attribute_values(): HasMany
    {
        return $this->hasMany(RealComplectValue::class);
    }
}
