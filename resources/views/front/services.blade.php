@extends('front.layouts.app')

@section('content')

@include('components.global-slider', ['pageTitle' => __('Services')])

@php
    $isArabic = app()->getLocale() === 'ar';
@endphp

<section class="services-section py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('Our Services') }}</h2>
            <p class="lead">
                {{ __('Enhance your bakery with our professional services.') }}
                {{ __('We offer') }}
                <span class="fw-bold text-danger">{{ $services[0]['name_en'] ?? __('Service 1') }}</span>,
                <span class="fw-bold text-danger">{{ $services[1]['name_en'] ?? __('Service 2') }}</span>
                {{ __('and') }}
                <span class="fw-bold text-danger">{{ $services[2]['name_en'] ?? __('Service 3') }}</span>
                {{ __('to support your flourish.') }}
            </p>
        </div>

        <div class="row gy-5">
            @foreach($services as $service)
                @php
                    $name = $isArabic ? $service->name_ar : $service->name_en;
                    $description = $isArabic ? $service->description_ar : $service->description_en;
                @endphp

                <div class="col-12">
                    <div class="bordered-container p-4 shadow-sm rounded bg-white">
                        <div class="row align-items-center flex-column flex-md-row">

                            <!-- Image -->
                            <div class="col-md-4 mb-3 mb-md-0 text-center">
                                <a href="{{ route('services.show', $service->id) }}">
                                    <img src="{{ asset('/' . $service->image) }}"
                                         alt="{{ $name }}"
                                         class="img-fluid rounded w-100"
                                         style="max-height: 250px; object-fit: cover;">
                                </a>
                            </div>

                            <!-- Text -->
                            <div class="col-md-8">
                                <h3 class="fw-bold mb-3">{!! $name !!}</h3>
                                <p class="mb-4">{!! Str::limit($description, 150) !!}</p>

                                <div class="text-end">
                                    @if($service->pdf && Storage::disk('public')->exists($service->pdf))
                                        <a href="{{ asset('/' . $service->pdf) }}"
                                           target="_blank"
                                           class="btn btn-black text-white button border-0">
                                            <span>{{ $isArabic ? 'تحميل PDF' : 'Download PDF' }}</span>
                                        </a>
                                    @else
                                        <a href="#" class="btn text-white button border-0" style="background-color: #ccc; cursor: not-allowed;">
                                            <span>{{ $isArabic ? 'تحميل PDF' : 'Download PDF' }}</span>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
</section>

@endsection
