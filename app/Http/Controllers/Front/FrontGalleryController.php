<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PhotoAlbum;
use App\Models\PhotoGallery;
use App\Models\Video;

class FrontGalleryController extends Controller
{
    public function index()
    {
        return view('front.gallery');
    }

    public function getAlbums()
    {
        $albums = PhotoAlbum::all();
        $isArabic = app()->getLocale() === 'ar';
        return view('front.albums', compact('albums', 'isArabic'));
    }

    public function show($id)
    {
        $album = PhotoAlbum::with('photos')->findOrFail($id);
        $isArabic = app()->getLocale() === 'ar';
        if($isArabic) {
            $title = $album->album_title_en;
        }
        else {
            $title = $album->album_title_ar;
        }

        return view('front.albums-show', compact('title', 'album', 'isArabic'));
    }

    public function getVideos()
    {
        $videos = Video::latest()->get();
        $isArabic = app()->getLocale() === 'ar';

        return view('front.videos', compact('videos', 'isArabic'));
    }

}
