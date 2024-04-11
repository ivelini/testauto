<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Car complectation
 *
 * @property integer $id
 *
 * @property integer $car_model_id
 * @property integer $car_transmission_id
 * @property integer $car_body_type_id
 * @property integer $car_engine_id
 *
 * @property string $name
 * @property integer $volume_engine
 * @property integer $power
 * @property integer $speed
 *
 * @property CarModel $model
 * @property CarTransmission $transmission
 * @property CarDrive $drive
 * @property CarEngine $engine
 * @property CarBodyType $bodyType
 *
 */
class CarComplectation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'car_model_id',
        'car_transmission_id',
        'car_body_type_id',
        'car_drive_id',
        'car_engine_id',
        'name',
        'volume_engine',
        'power',
        'speed',
    ];

    /**
     * Model for current complectation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }

    /**
     * Transmission for current complectation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transmission()
    {
        return $this->belongsTo(CarTransmission::class);
    }

    /**
     * Body type for current complectation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bodyType()
    {
        return $this->belongsTo(CarBodyType::class);
    }

    /**
     * Drive for current complectation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drive()
    {
        return $this->belongsTo(CarDrive::class);
    }

    /**
     * Engine for current complectation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function engine()
    {
        return $this->belongsTo(CarEngine::class);
    }

    /**
     * All cars for current complectation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
