<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{

    //
    protected $fillable = [
        'name',
        'slug'
        ];
        public function locationTypes()
        {
            return $this->hasMany(PropertyLocationType::class, 'category_id');
        }
        }
        