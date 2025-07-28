@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Products')])

@php
    // Check if the current locale is Arabic
    $isArabic = app()->getLocale() === 'ar';

    // Set the product name and description based on the locale
    $name = $isArabic ? $product->name_ar : $product->name_en;
    $description = $isArabic ? $product->description_ar : $product->description_en;
@endphp

<div class="m-5 p-5 content-wrapper">
    <div class="row align-items-center">
        <!-- Left Column: Product Information -->
        <div class="col-md-7 text-start">
            <h2 class="fw-bold mb-3">{{ $name ?? __('Product Name') }}</h2>
            <p class="mb-5">
                {{ $description ?? __('No description available.') }}
            </p>
            <div class="d-flex justify-content-start">
                @if($product->pdf && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->pdf))
                    <a href="{{ asset('storage/' . $product->pdf) }}"
                    class="btn text-white button btn-black border-0">
                        <span>{{ $isArabic ? 'تحميل PDF' : 'Download PDF' }}</span>
                    </a>
                @else
                    <a href="#"
                    class="btn text-white button btn-black border-0 btn-disabled">
                        <span>{{ $isArabic ? 'تحميل PDF' : 'Download PDF' }}</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Right Column: Product Image -->
        <div class="col-md-5 text-center">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $name }}"
                 class="img-fluid rounded">
        </div>
    </div>
</div>

@endsection
