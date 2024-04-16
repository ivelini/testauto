<?php

namespace App\Services\ValidationService;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorObject;
use Illuminate\Support\MessageBag;

/**
 *  Validation service
 */
abstract class ValidationService
{
    public bool $isValidated = false;
    protected ValidatorObject $validator;
    public MessageBag $errors;

    public function __construct(protected ?array $inputData)
    {
        $this->errors = new MessageBag();

        if(!empty($this->inputData)) {

            $this->validator = Validator::make($inputData, $this->getRules());

            if($this->validator->fails()) {
                $this->errors = $this->validator->errors();
            } else {
                $this->isValidated = true;
            }

        } else {
            $this->errors = new MessageBag(['Input data not recognized']);
        }
    }

    abstract protected function getRules(): array;

    public function validated(): ?array
    {
        return $this->isValidated ?
            $this->validator->validated() :
            null;
    }
}
