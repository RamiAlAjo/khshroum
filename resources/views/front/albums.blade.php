@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Gallery')])

<div class="m-5 p-5 content-wrapper">
    <h2 class="fw-bold mb-5">Photo Gallery</h2>
    <div class="row justify-content-center">
        @foreach($albums as $album)
            <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
                <a href="{{ route('album.show', $album->id) }}" class="text-decoration-none text-center">
                    <img src="{{ asset('storage/' . $album->album_cover) }}" alt="Photo Album"
                        class="gallery-thumb bordered-container rounded-0 w-100" style="height: auto;">
                    <h4 class="mt-3 fw-bold text-dark">
                        {{ $isArabic ? $album->album_title_ar : $album->album_title_en }}
                    </h4>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
