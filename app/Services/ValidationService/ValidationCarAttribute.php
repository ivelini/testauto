<?php

namespace App\Services\ValidationService;

class ValidationCarAttribute extends ValidationService
{
    protected function getRules(): array
    {
        return [
            'country' => 'required|string',
            'vendor' => 'required|string',
            'mark' => 'required|string',
            'complectation' => 'required|string',
            'color' => 'required|string',
            'vin' => 'required|string',
            'price' => 'required|string',
            'year' => 'required|string',
            'real_complectation' => 'nullable|array',
            'real_complectation.*' => 'required|array',
        ];
    }
}
