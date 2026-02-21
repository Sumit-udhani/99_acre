<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteLogo extends Model
{
    //
      protected $fillable = [
        'title',
        'image_path',
        'url' ,
        'is_active',
    ];
}
