<?php

namespace App\Actions\Catalog;

use App\DataTransfers\CarArgumentDTO;
use App\Models\Catalog\Car;
use App\Models\Catalog\Color;
use App\Models\Catalog\Complectation;
use App\Models\Catalog\Country;
use App\Models\Catalog\Mark;
use App\Models\Catalog\Vendor;
use Illuminate\Support\Facades\DB;

class CarAddOrUpdate
{
    public string $status = '';

    public function __construct(
        private CarArgumentDTO $carArgumentDTO
    )
    {}

    public function run()
    {
        try {
            DB::beginTransaction();

                $country = Country::firstOrCreate(
                    ['name' => $this->carArgumentDTO->country]
                );

                $vendor = Vendor::firstOrCreate(
                    ['name' => $this->carArgumentDTO->vendor],
                    ['country_id' => $country->id]
                );

                $mark = Mark::firstOrCreate(
                    ['name' => $this->carArgumentDTO->mark],
                    ['vendor_id' => $vendor->id]
                );

                $complectation = Complectation::firstOrCreate(
                    ['name' => $this->carArgumentDTO->complectation],
                    ['mark_id' => $mark->id]
                );

                $color = Color::firstOrCreate(
                    ['name' => $this->carArgumentDTO->color]
                );

                $car = Car::updateOrCreate(
                    ['vin' => $this->carArgumentDTO->vin],
                    [
                        'complectation_id' => $complectation->id,
                        'color_id' => $color->id,
                        'price' => $this->carArgumentDTO->price,
                        'year' => $this->carArgumentDTO->year
                    ]
                );

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->status = 'Data saving error. Try later.';
        }

        if(isset($car) && $car->wasRecentlyCreated) {
            $this->status = 'Сar added to the catalog';
        } elseif (isset($car) && ! $car->wasRecentlyCreated) {
            $this->status = 'The car has been changed in the catalog';
        }
    }
}
