<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    protected $table = 'photos_gallery';
    public $timestamps = true;

    protected $fillable = [
        'album_id',
        'album_images',
    ];

// Remove this line:
protected $casts = ['album_images' => 'array'];


    public function album()
    {
        return $this->belongsTo(PhotoAlbum::class, 'album_id');
    }
}
