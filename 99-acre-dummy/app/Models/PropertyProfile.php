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
        'property_age',
        'property_date',
        'rent_out',
        'agreement_type',
        'broker_contact',
        'furnishing',
        'furnishing_items',
        'available_gender',
        'suitable_for',
        'parking',
        'room_type',
        'boundary_wall',
        'open_sides',
        'is_construction',
        'property_possesion',
        'quality_ratings',
        'no_of_washroom'
    ];
    public function property(){
        return $this->belongsTo(Property::class);
    }
}
