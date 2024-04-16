<?php

namespace App\Console\Commands;

use App\Actions\Catalog\CarAddOrUpdate;
use App\DataTransfers\CarArgumentDTO;
use App\Services\ValidationService\ValidationCarAttribute;
use Illuminate\Console\Command;


class AddOrUpdateCarCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:add-or-update-car-command {car}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add or update car catalog';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $inputCar =  json_decode($this->argument('car'), ARRAY_FILTER_USE_KEY);

        $validator = new ValidationCarAttribute($inputCar);

        if(! $validator->isValidated) {
            return $this->alert($validator->errors->first());
        }

        [
            'country' => $country,
            'vendor' => $vendor,
            'mark' => $mark,
            'complectation' => $complectation,
            'color' => $color,
            'vin' => $vin,
            'price' => $price,
            'year' => $year,
            'real_complectation' => $realComplectation,

        ] = $validator->validated();

        $action = new CarAddOrUpdate(new CarArgumentDTO(
            $country,
            $vendor,
            $mark,
            $complectation,
            $color,
            $vin,
            $price,
            $year,
            $realComplectation
        ));

        $action->run();

        return $this->alert($action->status);
    }
}
