<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'description_en',
        'description_ar',
        'button_label_en',
        'button_label_ar',
        'url',
        'image',
        'status',
        'position',
    ];
}
