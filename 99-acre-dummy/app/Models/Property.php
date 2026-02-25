<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
     protected $fillable = [
        'purpose_id',
        'category_id',
        'type_id',
        'title',
        'description',
        'property_location_type_id',
    ];

     public function purpose()
    {
        return $this->belongsTo(PropertyPurpose::class, 'purpose_id');
    }
    public function locationType()
    {
        return $this->belongsTo(PropertyLocationType::class);
    }
    public function category()
    {
        return $this->belongsTo(PropertyCategory::class, 'category_id');
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'type_id');
    }
}
