<?php

namespace App\Http\Resources\Catalog;

use App\Models\Catalog\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Car
 */
class RealComplectationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->map(
            fn($valuesCollection) => $valuesCollection->map(
                fn ($valueModel) => $valueModel->value
            )
        )->toArray();
    }
}
