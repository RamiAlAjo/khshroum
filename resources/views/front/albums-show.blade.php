@extends('front.layouts.app')
@section('content')
@include('components.global-slider', ['pageTitle' => 'Gallery'])

<div class="m-5 p-5 content-wrapper">
    <h2 class="fw-bold mb-5">{{$title}}</h2>
    <div class="justify-content-center">
        <div class="container py-5">
            <!-- Main Swiper -->
            <div class="swiper main-slider mb-4" style="height: 450px;">
                <div class="swiper-wrapper">
                    @foreach($album->photos as $photo)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $photo->album_images) }}"
                                class="img-fluid w-100 h-100"
                                style="object-fit: cover; border-radius: 8px;">
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination mt-3"></div> <!-- Indicator Dots -->
            </div>
            <!-- Thumbnail Swiper -->
            <div class="swiper thumb-slider">
                <div class="swiper-wrapper">
                    @foreach($album->photos as $photo)
                        <div class="swiper-slide" style="width: 50px; height: 150px;">
                            <img src="{{ asset('storage/' . $photo->album_images) }}"
                                class="w-50 h-50 rounded"
                                style="object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var thumbSlider = new Swiper('.thumb-slider', {
        spaceBetween: 10,
        slidesPerView: 5,
        freeMode: true,
        watchSlidesProgress: true,
    });

    var mainSlider = new Swiper('.main-slider', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        thumbs: {
            swiper: thumbSlider,
        },
    });
</script>
@endsection

