<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyProfileOption extends Model
{
    protected $fillable = [
        'area_unit',
        'floor_no',
        'availability_status',
        'ownership',
        'furnishing',
        'rent_out',
        'furnishing_items',
    ];
}