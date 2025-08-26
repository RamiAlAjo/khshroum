@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Gallery')])

@php
    $isArabic = app()->getLocale() === 'ar';
@endphp

<style>
    .gallery-thumb {
        object-fit: cover;
        aspect-ratio: 1/1;
        border: 3px solid #ddd;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-thumb:hover {
        transform: scale(1.03);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .gallery-title {
        font-size: 1.1rem;
        color: #333;
        transition: color 0.2s ease;
    }

    .gallery-title:hover {
        color: var(--color-primary);
    }

    @media (max-width: 575.98px) {
        .gallery-thumb {
            aspect-ratio: 4/3;
        }

        .gallery-title {
            font-size: 1rem;
        }
    }
</style>

<div class="container my-5">
    <h2 class="fw-bold text-center mb-5">{{ __('Photo Gallery') }}</h2>

    <div class="row g-4 justify-content-center">
        @foreach($albums as $album)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                <a href="{{ route('album.show', $album->id) }}" class="text-decoration-none text-center w-100">
                    <img src="{{ asset('/' . $album->album_cover) }}"
                         alt="{{ $isArabic ? $album->album_title_ar : $album->album_title_en }}"
                         class="gallery-thumb w-100 rounded">
                    <h4 class="mt-3 fw-bold gallery-title">
                        {{ $isArabic ? $album->album_title_ar : $album->album_title_en }}
                    </h4>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
