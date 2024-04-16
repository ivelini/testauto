<?php

namespace App\DataTransfers;

use Illuminate\Support\Facades\Validator;

class CarArgumentDTO
{
    public function __construct(
        public string $country,
        public string $vendor,
        public string $mark,
        public string $complectation,
        public string $color,
        public string $vin,
        public string $price,
        public string $year,
        public ?array $realComplectation,
    )
    {

    }
}
