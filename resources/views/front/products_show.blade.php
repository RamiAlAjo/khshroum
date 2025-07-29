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
        <div class="col-12 col-md-7 text-start mb-4 mb-md-0">
            <h2 class="fw-bold mb-3">{{ $name ?? __('Product Name') }}</h2>
            <p class="mb-4 mb-md-5">{{ $description ?? __('No description available.') }}</p>
            <div class="d-flex justify-content-start">
                @if($product->pdf && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->pdf))
                    <a href="{{ asset('storage/' . $product->pdf) }}"
                    class="btn text-white button btn-black border-0 px-4 py-2">
                        <span>{{ $isArabic ? 'تحميل PDF' : 'Download PDF' }}</span>
                    </a>
                @else
                    <a href="#"
                    class="btn text-white button btn-black border-0 px-4 py-2 btn-disabled" style="background-color:gray!important">
                        <span>{{ $isArabic ? 'تحميل PDF' : 'Download PDF' }}</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Right Column: Product Image -->
        <div class="col-12 col-md-5 text-center">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $name }}"
                 class="img-fluid rounded shadow-sm mb-4 mb-md-0">
        </div>
    </div>
</div>

<style>
    /* Additional styles for better responsiveness */
@media (max-width: 767px) {
    /* On smaller screens, reduce the padding of the button */
    .btn {
        padding: 10px 20px;
        font-size: 14px;
    }

    /* Adjust text size for small screens */
    h2 {
        font-size: 1.6rem;
    }

    p {
        font-size: 1rem;
    }
}

@media (min-width: 768px) {
    /* On medium and larger screens, ensure proper text sizes */
    h2 {
        font-size: 2rem;
    }

    p {
        font-size: 1.125rem;
    }
}

.btn-disabled {
    background-color: #e0e0e0 !important;
    pointer-events: none;
    opacity: 0.6;
}

</style>
@endsection
