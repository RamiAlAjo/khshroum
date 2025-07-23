<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    // If your table is not pluralized (default Laravel behavior), explicitly set it
    protected $table = 'about_us';

    // Allow mass assignment for these fields
    protected $fillable = [
        'about_us_title_en',
        'about_us_title_ar',
        'about_us_description_en',
        'about_us_description_ar',
        'image',
    ];
}
