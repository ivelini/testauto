<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRealComplectVolume extends Model
{
    use HasFactory;

    protected $fillable = [
        'volue_text',
        'volue_int',
        'volue_date',
        'volue_boolean',
    ];
}
