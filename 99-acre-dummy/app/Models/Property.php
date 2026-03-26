<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
     protected $fillable = [
      'user_id',
    'purpose_id',
    'category_id',
    'type_id',
    'sub_type_id',
    'location_type_id',
    'city',
    'locality',
    'sub_locality',
    'address',
    'latitude',
    'longitude'
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
    public function subtype()
{
    return $this->belongsTo(PropertySubType::class, 'sub_type_id');
}
public function commercial()
{
    return $this->hasOne(PropertyCommercial::class);
}
}
