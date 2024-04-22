<?php

namespace Tests\Feature\Catalog;

use App\Actions\Catalog\CarAddOrUpdate;
use App\DataTransfers\CarArgumentDTO;
use App\Models\Catalog\Car;
use App\Models\Catalog\Traits\Cache\CacheTypeEnum;
use Database\Seeders\Catalog\BodySeeder;
use Database\Seeders\Catalog\DriveSeeder;
use Database\Seeders\Catalog\EngineSeeder;
use Database\Seeders\Catalog\RealAttributeSeeder;
use Database\Seeders\Catalog\TransmissionSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class EntityCarTest extends TestCase
{

    protected CarArgumentDTO $carArgumentDTO;

    public function setUp(): void
    {
        parent::setUp();

        [
            'country' => $country,
            'vendor' => $vendor,
            'mark' => $mark,
            'complectation' => $complectation,
            'color' => $color,
            'vin' => $vin,
            'price' => $price,
            'year' => $year,
            'real_attributes' => $realAttributes,
            'body_type' => $bodyType,
            'engine' => $engine,
            'drive' => $drive,
            'transmission' => $transmission,
            'volume_engine' => $volumeEngine,
            'power' => $power,
            'speed' => $speed,
        ] = [
            'country' => 'Россия',
            'vendor' => 'Авто ТАЗ',
            'mark' => 'Веста',
            'complectation' => 'Супер +',
            'color' => 'Баклажан',
            'vin' => '565HSJIS497H3',
            'price' => '100500',
            'year' => '2024',
            'body_type' => 'Седан',
            'engine' => 'Бензин',
            'drive' => 'Передний',
            'transmission' => 'Механика',
            'volume_engine' => '1500',
            'power' => '3500',
            'speed' => '210',
            'real_attributes' => [
                [
                    'name' => 'Противоугонная система',
                    'values' => ['А','Б','В','Г']
                ],
                [
                    'name' => 'Комфорт',
                    'values' => ['А','Б','В','Г']
                ],
                [
                    'name' => 'Салон и интерьер',
                    'values' => ['А','Б','В','Г']
                ]
            ]
            ];

        $this->carArgumentDTO = new CarArgumentDTO(
            $country,
            $vendor,
            $mark,
            $complectation,
            $color,
            $vin,
            $price,
            $year,
            $realAttributes,
            $bodyType,
            $engine,
            $drive,
            $transmission,
            $volumeEngine,
            $power,
            $speed,
        );
    }

    public function testCreateCar(): Car
    {
        Artisan::call('migrate:fresh');
        Cache::clear();

        $this->seed([
            TransmissionSeeder::class,
            BodySeeder::class,
            EngineSeeder::class,
            DriveSeeder::class,
            RealAttributeSeeder::class
        ]);

        (new CarAddOrUpdate($this->carArgumentDTO))->run();

        $car = Car::query()
            ->whereHas('complectation', fn($q) => $q->where('name', 'Супер +'))
            ->whereHas('complectation.transmission', fn($q) => $q->where('name', 'Механика'))
            ->whereHas('complectation.bodyType', fn($q) => $q->where('name', 'Седан'))
            ->whereHas('complectation.drive', fn($q) => $q->where('name', 'Передний'))
            ->whereHas('complectation.engine', fn($q) => $q->where('name', 'Бензин'))
            ->whereHas('complectation.mark', fn($q) => $q->where('name', 'Веста'))
            ->whereHas('complectation.mark.vendor', fn($q) => $q->where('name', 'Авто ТАЗ'))
            ->whereHas('complectation.mark.vendor.country', fn($q) => $q->where('name', 'Россия'))
            ->whereHas('realAttributes', function ($qAttribute) {
                $qAttribute->whereHas('attribute_values', function ($qValue) {
                    $qValue->where('value', 'В');
                })->where('name', 'Комфорт');
            })
            ->where('vin', '565HSJIS497H3')
            ->first();

        $this->assertModelExists($car);
        $this->assertTrue($car->id == 1);

        return $car;
    }

    /**
     * @depends testCreateCar
     */
    public function testCacheAfterCreateCar(Car $createdCar)
    {
        /** @var Car $cachedCar */
        $cachedCar = Cache::get((new \ReflectionClass($createdCar))->getShortName() . ':' . CacheTypeEnum::page->name . ':' . $createdCar->id);

        $this->assertTrue($cachedCar->id == $createdCar->id);
        $this->assertTrue(array_key_exists('realAttributes', $cachedCar->getRelations()));

        return $cachedCar;
    }

    /**
     * @dataProvider inputProvider
     */
    public function testUpdateCar($iteration, $country,$vendor,$mark,$complectation,$color,$vin,$price,
                                  $year,$bodyType,$engine, $drive,$transmission,$volumeEngine,$power,
                                  $speed,$realAttributes)
    {

        $this->carArgumentDTO = new CarArgumentDTO(
            $country,
            $vendor,
            $mark,
            $complectation,
            $color,
            $vin,
            $price,
            $year,
            $realAttributes,
            $bodyType,
            $engine,
            $drive,
            $transmission,
            $volumeEngine,
            $power,
            $speed,
        );

        $updatedCar = (new CarAddOrUpdate($this->carArgumentDTO))->run();

        if($iteration == 1 ) {
            $cachedCar = Cache::get((new \ReflectionClass($updatedCar))->getShortName() . ':' . CacheTypeEnum::page->name . ':' . $updatedCar->id);
            $this->assertTrue(count($updatedCar->getChanges()) == 3);
            $this->assertTrue($updatedCar->realAttributes()->count() == 0);
            $this->assertTrue($cachedCar->color->name == 'New Баклажан');
            $this->assertTrue(count($cachedCar->realAttributes) == 0);
        }

        if($iteration == 2) {
            $this->assertTrue($updatedCar == null);
            $this->assertTrue(count(Car::find(1)->realAttributes) == 0);
        }
    }

    /**
     * @return array
     */
    public static function inputProvider()
    {
        $data = [
            [
                'iteration' => 1,
                'country' => 'Россия',
                'vendor' => 'Авто ТАЗ',
                'mark' => 'Веста',
                'complectation' => 'Супер +',
                'color' => 'New Баклажан',  //change
                'vin' => '565HSJIS497H3',
                'price' => '100510',    //change
                'year' => '2023',       //change
                'body_type' => 'Седан',
                'engine' => 'Бензин',
                'drive' => 'Передний',
                'transmission' => 'Механика',
                'volume_engine' => '1600',
                'power' => '3500',
                'speed' => '210',
                'real_attributes' => null //change
            ],
            [
                'iteration' => 2,
                'country' => 'Россия',
                'vendor' => 'Авто ТАЗ',
                'mark' => 'Веста',
                'complectation' => 'Супер +',
                'color' => 'Баклажан',
                'vin' => '565HSJIS497H3',
                'price' => '100500',
                'year' => '2024',
                'body_type' => 'Седан',
                'engine' => 'Бензин',
                'drive' => 'Передний не из справочника', //change
                'transmission' => 'Механика',
                'volume_engine' => '1600',
                'power' => '3500',
                'speed' => '210',
                'real_attributes' =>  [     //change
                    'name' => 'Противоугонная система',
                    'values' => ['Г']
                ],
            ],
        ];

        return $data;
    }
}
