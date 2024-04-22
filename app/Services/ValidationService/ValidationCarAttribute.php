<?php

namespace App\Services\ValidationService;


use App\Rules\Catalog\SingleComplectationRule;
use App\Services\ValidationService\CarAttributes\AttributeComplectation;
use App\Services\ValidationService\CarAttributes\AttributeCountry;
use App\Services\ValidationService\CarAttributes\AttributeMark;
use App\Services\ValidationService\CarAttributes\AttributeVendor;
use Illuminate\Support\Facades\DB;

/**
 * Validation input attributs for Car
 */
class ValidationCarAttribute extends ValidationService
{
    protected function getRules(): array
    {
        // if complectation exists then nullable else required
        $requiredComplectationField = DB::table('complectations')->where('name', $this->inputData['complectation'])->exists() ?
            ['nullable'] :
            ['required'];

        // if vin exists then nullable else required
        $requiredCarField = DB::table('cars')->where('vin', $this->inputData['vin'])->exists() ?
            ['nullable'] :
            ['required'];

        return [
            'complectation' => ['required', 'string', function($key, $value, $fail) {

                $attributeComplectation = new AttributeComplectation($value);
                $attributeMark = new AttributeMark($this->inputData['mark'], $attributeComplectation);
                $attributeVendor = new AttributeVendor($this->inputData['vendor'], $attributeMark);
                $attributeCountry = new AttributeCountry($this->inputData['country'], $attributeVendor);

                //the complectation corresponds to the links complectation -> country
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

                //the mark corresponds to the links mark -> country
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

                //the vendor corresponds to the links vendor -> country
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
            'real_attributes' => 'nullable|array',
            'real_attributes.*' => 'required|array',
            'real_attributes.*.name' => ['required','exists:real_complect_attributes,name'],
            'real_attributes.*.values' => 'required|array',
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
