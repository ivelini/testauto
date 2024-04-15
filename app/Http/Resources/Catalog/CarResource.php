<?php

namespace App\Http\Resources\Catalog;

use App\Models\Catalog\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Car
 */
class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'complectation' => ComplectationResource::make($this->whenLoaded('complectation')),
            'mark' => MarkResource::make($this->mark),
            'vendor' => VendorResource::make($this->vendor),
            'country' => CountryResource::make($this->country),
            'color' => ListResource::make($this->whenLoaded('color')),
            'name' => $this->vendor->name . ' ' . $this->mark->name . ' ' . $this->complectation->name . ' ' . $this->year,
            'year' => $this->year,
            'vin' => $this->vin,
            'price' => $this->price,
            'real_complectation' => RealComplectationResource::make($this->real_complectation)
        ];
    }
}
