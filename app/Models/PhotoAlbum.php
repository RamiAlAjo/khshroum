<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoAlbum extends Model
{
    protected $table = 'photo_album';

    protected $fillable = [
        'album_title_en',
        'album_title_ar',
        'album_cover',
    ];

    public function photos()
    {
        return $this->hasMany(PhotoGallery::class, 'album_id');
    }
}
