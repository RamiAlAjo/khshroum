<x-front-slider />
@extends('front.layouts.app')
@section('content')

@if($topBanner)
<section class="position-relative" style="height: 100vh; overflow: hidden;">
    <!-- Banner Image -->
    <img src="{{ asset($topBanner->image) }}" alt="Banner" class="w-100 h-100 object-fit-cover">

    <!-- Banner Text + Button -->
    <div class="position-absolute top-50 start-0 translate-middle-y px-5 z-2 w-100">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">
                {{ config('app.name') }}
            </h1>

            <p class="lead mb-4">
                {!! $locale === 'ar' ? $topBanner->description_ar : $topBanner->description_en !!}
            </p>

            @if($topBanner->url)
                <a href="{{ $topBanner->url }}"
                class="btn btn-md  fw-semibold text-white px-5 btn-gradient ">
                    {{ $locale === 'ar' ? $topBanner->button_label_ar : $topBanner->button_label_en }}
                </a>
            @endif

        </div>
    </div>

</section>
@endif

@endsection
