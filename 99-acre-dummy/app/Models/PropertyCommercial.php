<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCommercial extends Model
{
    //
    protected $fillable = [
    'property_id',
    'min_seats',
    'max_seats',
    'cabins',
    'meeting_rooms',
    'washrooms',
    'conference_room',
    'reception_area',
    'pantry_type',
    'lifts',
    'parking',
];
}
