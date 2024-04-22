<?php

namespace App\DataTransfers;

use Illuminate\Support\Facades\Validator;

/**
 * DTO for transver validated data into CraAddOrUpdate class
 */
class CarArgumentDTO
{
    public function __construct(
        public string $country,
        public string $vendor,
        public string $mark,
        public string $complectation,
        public ?string $color,
        public string $vin,
        public ?string $price,
        public ?string $year,
        public ?array $realAttributes,
        public ?string $bodyType,
        public ?string $engine,
        public ?string $drive,
        public ?string $transmission,
        public ?string $volumeEngine,
        public ?string $power,
        public ?string $speed,
    )
    {}
}
