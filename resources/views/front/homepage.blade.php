<x-front-slider />
@extends('front.layouts.app')
@section('content')

@if($topBanner)
<section class="position-relative banner-section">
    <!-- Banner Image -->
    <img src="{{ asset($topBanner->image) }}" alt="Banner" class="w-100 h-100 object-fit-cover">
    <div class="position-absolute top-50 start-0 translate-middle-y px-5 z-2 w-100">
        <div class="container mt-5">
            <h1 class="display-4 fw-bold mb-3">
                {{ config('app.name') }}
            </h1>

            <div class="lead mb-4 description">
                {!! $locale === 'ar' ? $topBanner->description_ar : $topBanner->description_en !!}
            </div>

            @if($topBanner->url)
                <a href="{{ $topBanner->url }}"
                class="button btn text-white btn-gradient border-0">
                   <span> {{ $locale === 'ar' ? $topBanner->button_label_ar : $topBanner->button_label_en }}</span>
                </a>
            @endif
        </div>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <h2 class="fw-bold mb-3">{{ __('Our Services') }}</h2>
        <p class="mb-5">
            {{ __('Enhance your bakery with our professional services.') }}
            {{ __('We offer') }}
            <span class="fw-bold text-danger">{{ $services[0]['name'] ?? '' }}</span>,
            <span class="fw-bold text-danger">{{ $services[1]['name'] ?? '' }}</span>
            {{ __('and') }}
            <span class="fw-bold text-danger">{{ $services[2]['name'] ?? '' }}</span>
            {{ __('to support your flourish.') }}
        </p>

        <div class="row justify-content-center">
            @foreach($services as $key => $service)
                <div class="col-md-4 mb-4 service-box-wrapper">
                    <img src="{{ asset('storage/'.$service['icon']) }}" alt="Service Icon" class="img-fluid rounded-circle">
                    <div class="p-4 mt-4 mb-3 service-box">
                        <h5 class="{{ $key === 2 ? 'text-danger' : 'text-dark' }}">
                            {{ $service['name'] }}
                        </h5>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ $topBanner->url }}"
            class="btn text-white button btn-black border-0">
                <span>{{ $locale === 'ar' ? 'خدماتنا ': 'Our Services' }}</span>
            </a>
        </div>
    </div>
</section>

<section class="products-section">
    <div class="container">
        <h2 class="fw-bold mb-5">{{ __('Few of Our Highlighted Products') }}</h2>
        <div class="d-flex flex-column justify-content-center">
            @foreach($products as $key => $product)
                <div class="product-wrapper col-md-12 mb-4">
                    <div class="d-flex justofy content-space-between">
                        <!-- Product Details -->
                        <div class="col-md-8 product-box">
                            <h2 class="fw-bold mb-4">
                                {{ $product->name }}
                            </h2>
                            <p>
                                {{ Str::limit($product->description, 150) }}
                            </p>
                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn text-white button btn-black border-0">
                                    <span>{{ $locale === 'ar' ? 'Download PDF' : 'Download PDF' }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 image-container">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Optional Button Link to View More Products -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('product.index') }}" class="btn text-white button btn-black border-0">
                <span>{{ $locale === 'ar' ? 'منتجاتنا' : 'Our Products' }}</span>
            </a>
        </div>
    </div>
</section>

@endif
@endsection
