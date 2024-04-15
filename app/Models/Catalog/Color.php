<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Color
 *
 * @property int $id
 * @property string $name
 */
class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
