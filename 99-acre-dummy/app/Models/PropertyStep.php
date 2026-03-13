<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyStep extends Model
{
    //
    protected $fillable = [
        'title',
        'slug',
        'order',
        'active'
    ];
}
