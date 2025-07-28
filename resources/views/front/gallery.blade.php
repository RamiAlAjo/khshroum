@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Gallery')])

@php
    // Check if the current locale is Arabic
    $isArabic = app()->getLocale() === 'ar';
@endphp

<div class="m-5 p-5 content-wrapper">
    <h2 class="fw-bold mb-5">{{ $isArabic ? 'شاهد رحلتنا الصناعية' : 'View Our Industrial Journey' }}</h2>

    <div class="d-flex justify-content-around gap-4 flex-wrap">
        <!-- Photo Gallery Image -->
        <a href="{{ route('albums') }}" class="text-decoration-none">
            <img src="{{ asset('images/photo-gallery.jpg') }}" alt="{{ $isArabic ? 'معرض الصور' : 'Photo Gallery' }}"
                 class="gallery-thumb bordered-container rounded-0">
            <h3 class="mt-3 fw-bold text-dark text-center">{{ $isArabic ? 'معرض الصور' : 'Photo Gallery' }}</h3>
        </a>

        <!-- Video Gallery Image -->
        <a href="{{ route('videos') }}" class="text-decoration-none">
            <img src="{{ asset('images/video-gallery.jpg') }}" alt="{{ $isArabic ? 'معرض الفيديو' : 'Video Gallery' }}"
                 class="gallery-thumb bordered-container rounded-0">
            <h3 class="mt-3 fw-bold text-dark text-center">{{ $isArabic ? 'معرض الفيديو' : 'Video Gallery' }}</h3>
        </a>
    </div>
</div>
@endsection
