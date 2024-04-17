<?php

namespace App\Services\ValidationService\CarAttributes;


use App\Rules\Catalog\SingleComplectationRule;
use App\Services\ValidationService\ValidationService;
use Illuminate\Support\Facades\DB;

class ValidationCarAttribute extends ValidationService
{
    protected function getRules(): array
    {
        $requiredComplectationField = DB::table('complectations')->where('name', $this->inputData['complectation'])->exists() ?
            ['nullable'] :
            ['required'];

        $requiredCarField = DB::table('cars')->where('vin', $this->inputData['vin'])->exists() ?
            ['nullable'] :
            ['required'];

        return [
            'complectation' => ['required', 'string', function($key, $value, $fail) {

                $attributeComplectation = new AttributeComplectation($value);
                $attributeMark = new AttributeMark($this->inputData['mark'], $attributeComplectation);
                $attributeVendor = new AttributeVendor($this->inputData['vendor'], $attributeMark);
                $attributeCountry = new AttributeCountry($this->inputData['country'], $attributeVendor);

                if ($attributeComplectation->exists() && ! $attributeCountry->exists()) {

                    $failedParameter = $attributeMark->exists() ?
                        $attributeVendor->exists() ?
                            $attributeCountry->exists() ?
                                null :
                                $attributeCountry->message() :
                            $attributeVendor->message() :
                        $attributeMark->message();

                    $fail('Комплектация не соответствует заданному параметру: ' . $failedParameter);
                }
            }],
            'mark' => ['required', 'string', function($key, $value, $fail) {
                $attributeMark = new AttributeMark($value);
                $attributeVendor = new AttributeVendor($this->inputData['vendor'], $attributeMark);
                $attributeCountry = new AttributeCountry($this->inputData['country'], $attributeVendor);

                if ($attributeMark->exists() && ! $attributeCountry->exists()) {

                    $failedParameter = $attributeVendor->exists() ?
                            $attributeCountry->exists() ?
                                null :
                                $attributeCountry->message() :
                            $attributeVendor->message();

                    $fail('Найденная марка авто не соответствует заданному параметру: ' . $failedParameter);
                }

            }],
            'vendor' => ['required', 'string', function($key, $value, $fail) {
                $attributeVendor = new AttributeVendor($value);
                $attributeCountry = new AttributeCountry($this->inputData['country'], $attributeVendor);

                if ($attributeVendor->exists() && ! $attributeCountry->exists()) {

                    $failedParameter = $attributeCountry->exists() ?
                            null :
                            $attributeCountry->message();

                    $fail('Производитель авто не соответствует заданному параметру: ' . $failedParameter);
                }
            }],
            'country' => 'required|string',
            'color' => array_merge($requiredCarField, ['string']),
            'vin' => 'required|string',
            'price' => array_merge($requiredCarField, ['integer']),
            'year' => array_merge($requiredCarField, ['integer']),
            'real_complectation' => 'nullable|array',
            'real_complectation.*' => 'required|array',
            'real_complectation.*.type' => ['required','exists:real_complect_attributes,name'],
            'real_complectation.*.values' => 'required|array',
            'body_type' => new SingleComplectationRule('body_types'),
            'engine' => new SingleComplectationRule('engines'),
            'drive' => new SingleComplectationRule('drives'),
            'transmission' => new SingleComplectationRule('transmissions'),
            'volume_engine' => array_merge($requiredComplectationField, ['integer']),
            'power' => array_merge($requiredComplectationField, ['integer']),
            'speed' => array_merge($requiredComplectationField, ['integer']),
        ];
    }

    public function validated(): ?array
    {
        $validatedArray =  parent::validated();
        $keyRules = array_keys($this->getRules());

        foreach($keyRules as $valueKyeRule) {
            if(! isset($validatedArray[$valueKyeRule])) {
                $validatedArray[$valueKyeRule] = null;
            }
        }

        return $validatedArray;
    }
}
