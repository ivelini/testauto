<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Car complectation
 *
 * @property integer $id
 *
 * @property integer $model_id
 * @property integer $transmission_id
 * @property integer $body_type_id
 * @property integer $engine_id
 *
 * @property string $name
 * @property integer $volume_engine
 * @property integer $power
 * @property integer $speed
 *
 * @property Mark $model
 * @property Transmission $transmission
 * @property Drive $drive
 * @property Engine $engine
 * @property BodyType $bodyType
 *
 */
class Complectation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'mark_id',
        'transmission_id',
        'body_type_id',
        'drive_id',
        'engine_id',
        'name',
        'volume_engine',
        'power',
        'speed',
    ];

    /**
     * Mark for current complectation
     */
    public function mark(): BelongsTo
    {
        return $this->belongsTo(Mark::class);
    }

    /**
     * Transmission for current complectation
     */
    public function transmission(): BelongsTo
    {
        return $this->belongsTo(Transmission::class);
    }

    /**
     * Body type for current complectation
     */
    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }

    /**
     * Drive for current complectation
     */
    public function drive(): BelongsTo
    {
        return $this->belongsTo(Drive::class);
    }

    /**
     * Engine for current complectation
     */
    public function engine(): BelongsTo
    {
        return $this->belongsTo(Engine::class);
    }

    /**
     * All cars for current complectation
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
