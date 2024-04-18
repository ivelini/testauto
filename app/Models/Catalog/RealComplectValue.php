<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RealComplectValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'real_complect_attribute_id',
        'car_id',
        'value_text',
        'value_int',
        'value_date',
        'value_boolean',
    ];

    /**
     *
     */
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(RealComplectAttribute::class, 'real_complect_attribute_id');
    }

    /**
     *
     */
    protected function value(): ?Attribute
    {
        foreach ($this->getAttributes() as $key => $value) {
            if(Str::contains($key, 'value_') && !empty($value)) {
                return Attribute::get(fn() => $value);
            }
        }

        return null;
    }
}
