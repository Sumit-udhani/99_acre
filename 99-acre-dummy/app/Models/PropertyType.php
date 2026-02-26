<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    //

    protected $fillable = [
        'name',
        'slug',
        'purpose_id',
        'category_id'
    ];
    public function category()
{
    return $this->belongsTo(PropertyCategory::class);
}

public function purpose()
{
    return $this->belongsTo(PropertyPurpose::class);
}
public function locationTypes()
{
    return $this->hasMany(PropertyLocationType::class);
}
}
