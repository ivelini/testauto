<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealComplectAttribute extends Model
{
    use HasFactory;

    public function attribute_values()
    {
        return $this->hasMany(RealComplectValue::class);
    }
}
