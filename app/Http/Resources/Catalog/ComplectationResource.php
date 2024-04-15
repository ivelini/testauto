<?php

namespace App\Http\Resources\Catalog;

use App\Models\Catalog\Car;
use App\Models\Catalog\Complectation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Complectation
 */
class ComplectationResource extends JsonResource
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
            'name' => $this->name,
            'volume_engine' => $this->volume_engine,
            'power' => $this->power,
            'sped' => $this->speed,
            'transmission' => ListResource::make($this->whenLoaded('transmission')),
            'body_type' => ListResource::make($this->whenLoaded('bodyType')),
            'drive' => ListResource::make($this->whenLoaded('drive')),
            'engine' => ListResource::make($this->whenLoaded('engine')),
        ];
    }
}
