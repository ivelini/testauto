<?php

namespace App\Actions\Catalog;

use App\DataTransfers\CarArgumentDTO;
use App\Models\Catalog\BodyType;
use App\Models\Catalog\Car;
use App\Models\Catalog\Color;
use App\Models\Catalog\Complectation;
use App\Models\Catalog\Country;
use App\Models\Catalog\Drive;
use App\Models\Catalog\Engine;
use App\Models\Catalog\Mark;
use App\Models\Catalog\RealComplectAttribute;
use App\Models\Catalog\RealComplectValue;
use App\Models\Catalog\Transmission;
use App\Models\Catalog\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                    $this->getOnlyNotEmptyFields([
                        'mark_id' => $mark->id,
                        'transmission_id' => Transmission::whereName($this->carArgumentDTO->transmission)->first()->id,
                        'body_type_id' => BodyType::whereName($this->carArgumentDTO->bodyType)->first()->id,
                        'drive_id' => Drive::whereName($this->carArgumentDTO->drive)->first()->id,
                        'engine_id' => Engine::whereName($this->carArgumentDTO->engine)->first()->id,
                        'volume_engine' => $this->carArgumentDTO->volumeEngine,
                        'power' => $this->carArgumentDTO->power,
                        'speed' => $this->carArgumentDTO->speed,
                    ])
                );

                $color = Color::firstOrCreate(
                    ['name' => $this->carArgumentDTO->color]
                );

                /** @var Car $car */
                $car = Car::updateOrCreate(
                    ['vin' => $this->carArgumentDTO->vin],
                    $this->getOnlyNotEmptyFields([
                        'complectation_id' => $complectation->id,
                        'color_id' => $color->id,
                        'price' => $this->carArgumentDTO->price,
                        'year' => $this->carArgumentDTO->year
                    ])
                );

                RealComplectValue::query()->where('car_id', $car->id)->delete();

                if(! empty($this->carArgumentDTO->realAttributes)) {

                    $insertValues = [];
                    foreach($this->carArgumentDTO->realAttributes as $attribute) {

                        $attributeId = RealComplectAttribute::query()->where('name', $attribute['name'])->first()->id;

                        foreach($attribute['values'] as $value) {
                            $insertValues[] = [
                                'real_complect_attribute_id' => $attributeId,
                                'car_id' => $car->id,
                                'value' => $value
                            ];
                        }
                    }

                    RealComplectValue::insert($insertValues);
                }

            $car->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->status = 'Data saving error. Try later.';

            Log::error('DB', [$e->getMessage(), $e->getTrace()]);
        }

        if(isset($car) && $car->wasRecentlyCreated) {
            $this->status = 'Сar added to the catalog';
        } elseif (isset($car) && ! $car->wasRecentlyCreated) {
            $this->status = 'The car has been changed in the catalog';
        }
    }

    private function getOnlyNotEmptyFields(array $attributes)
    {
        return array_filter($attributes, fn($value) => !empty($value));
    }
}
