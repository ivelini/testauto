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
            'name' => $this->vendor->name . ' ' . $this->mark->name . ' ' . $this->complectation->name . ' ' . $this->year,
            'vendor' => VendorResource::make($this->vendor),
            'mark' => MarkResource::make($this->mark),
            'country' => CountryResource::make($this->country),
            'complectation_id' => $this->id,
            'complectation' => ComplectationResource::make($this->whenLoaded('complectation')),
            'color_id' => $this->color_id,
            'color' => ColorResource::make($this->whenLoaded('color')),
            'year' => $this->year,
            'vin' => $this->vin,
            'price' => $this->price,
            'real_complectation' => RealComplectationResource::make($this->real_complectation)
        ];
    }
}
