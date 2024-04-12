<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RealComplectValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'volue_text',
        'volue_int',
        'volue_date',
        'volue_boolean',
    ];

    public function attribute()
    {
        return $this->belongsTo(RealComplectAttribute::class, 'real_complect_attribute_id');
    }

    /**
     * @return ?Attribute
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
