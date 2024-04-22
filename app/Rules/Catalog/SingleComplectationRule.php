<?php

namespace App\Rules\Catalog;

use App\Models\Catalog\Complectation;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

/**
 * Compliance of parameters with a given configuration
 */
class SingleComplectationRule implements DataAwareRule, ValidationRule
{
    protected $data = [];
    public function __construct(protected string $table)
    {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $complectation = Complectation::query()
            ->with(['bodyType', 'engine', 'drive', 'transmission'])
            ->whereName($this->data['complectation'])
            ->first();

        if($attribute == 'body_type') {
            $attribute = 'bodyType';
        }

        if(! empty($complectation) && ! empty($value) && $complectation->$attribute->name != $value) {
            $fail('Параметр :attribute не соответствует найденной комплектации');
        }

        if (empty($complectation) && empty($value)) {
            $fail('Параметр :attribute не задан');
        }

        if (!empty($value) && ! DB::table($this->table)->where('name', $value)->exists()) {
            $fail('Параметр :attribute не соответствует табличному значению');
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
