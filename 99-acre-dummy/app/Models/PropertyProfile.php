<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyProfile extends Model
{
    //
     protected $fillable = [
        'property_id',
        'bedrooms',
        'bathrooms',
        'balconies',
        'carpet_area',
        'area_unit',
        'builtup_area',
        'super_builtup_area',
        'total_floors',
        'floor_no',
        'availability_status',
        'ownership',
    ];
    public function property(){
        return $this->belongsTo(Property::class);
    }
}
