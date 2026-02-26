<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyLocationType extends Model
{
    //
    protected $fillable = ['category_id', 'name','slug'];


public function propertyType()
{
    return $this->belongsTo(PropertyType::class);
}
}
