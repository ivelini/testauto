<?php

namespace App\Services\ValidationService;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorObject;
use Illuminate\Support\MessageBag;

/**
 *  Validation service .Abstract class on the basis of which we create the class necessary for verification.
 *
 */
abstract class ValidationService
{
    public bool $isValidated = false;       // validation status
    protected ValidatorObject $validator;   // object validator
    public MessageBag $errors;              // messages

    /**
     * @param array|null $inputData validation array
     */
    public function __construct(protected ?array $inputData)
    {
        $this->errors = new MessageBag();

        if(!empty($this->inputData)) {

            $this->validator = Validator::make($inputData, $this->getRules());

            if($this->validator->stopOnFirstFailure()->fails()) {
                $this->errors = $this->validator->errors();
            } else {
                $this->isValidated = true;
            }

        } else {
            $this->errors = new MessageBag(['Input data not recognized']);
        }
    }

    /**
     * Validation rules
     * @return array
     */
    abstract protected function getRules(): array;

    /**
     * If the check is passed, we return the verified data
     * @return array|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validated(): ?array
    {
        return $this->isValidated ?
            $this->validator->validated() :
            null;
    }
}
