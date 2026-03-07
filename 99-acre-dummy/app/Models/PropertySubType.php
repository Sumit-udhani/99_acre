<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertySubType extends Model
{
    //
      protected $fillable = [
        'name',
        'slug',
        'type_id'
    ];


       public function type()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
