<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $fillable = [
    'title',
    'subtitle',
    'description',
    'image_path',
    'button_text',
    'button_url',
    'is_active'
];
}
