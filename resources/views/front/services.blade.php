@extends('front.layouts.app')
@section('content')
@include('components.global-slider', ['pageTitle' => 'Services'])

@php
    $isArabic = app()->getLocale() === 'ar';
@endphp

<section class="services-section">
    <div class="m-5 p-5 content-wrapper">
        <h2 class="fw-bold mb-3">{{ __('Our Services') }}</h2>
        <p class="mb-5">
            {{ __('Enhance your bakery with our professional services.') }}
            {{ __('We offer') }}
            <span class="fw-bold text-danger">{{ $services[0]['name_en'] ?? '' }}</span>,
            <span class="fw-bold text-danger">{{ $services[1]['name_en'] ?? '' }}</span>
            {{ __('and') }}
            <span class="fw-bold text-danger">{{ $services[2]['name_en'] ?? '' }}</span>
            {{ __('to support your flourish.') }}
        </p>

        <div class="d-flex flex-column justify-content-center">
        @foreach($services as $service)
            @php
                $name = $isArabic ? $service->name_ar : $service->name_en;
                $description = $isArabic ? $service->description_ar : $service->description_en;
            @endphp

            <div class="product-wrapper col-md-12 mb-4 bordered-container"">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3 mb-md-0 image-container">
                        <a href="{{ route('services.show', $service->id) }}">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $name }}" class="img-fluid rounded">
                        </a>

                    </div>

                    <div class="col-md-8 product-box">
                        <h2 class="fw-bold mb-4">{{ $name }}</h2>
                        <p>{{ Str::limit($description, 150) }}</p>
                        <div class="d-flex justify-content-end">
                        @if($service->pdf && \Illuminate\Support\Facades\Storage::disk('public')->exists($service->pdf))
                                <a href="{{ asset('storage/' . $service->pdf) }}"
                                class="btn text-white button btn-black border-0">
                                    <span>{{ $isArabic ? 'تحميل PDF' : 'Download PDF' }}</span>
                                </a>
                        @else
                            <a href="#"
                            class="btn text-white button btn-black border-0" style="background-color:gray!important">
                                <span>{{ $isArabic ? 'تحميل PDF' : 'Download PDF' }}</span>
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>

@endsection
