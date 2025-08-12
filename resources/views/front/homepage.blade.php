@extends('front.layouts.app')

@section('content')

@if($topBanner)
<section class="position-relative banner-section">
    <img src="{{ asset($topBanner->image) }}" alt="Banner" class="w-100 h-100 object-fit-cover">
    <div class="position-absolute top-50 start-0 translate-middle-y px-5 z-2 w-100">
        <div class="container">
            <div class="lead mb-4 description">
                {!! app()->getLocale() === 'ar' ? $topBanner->description_ar : $topBanner->description_en !!}
            </div>

            @if($topBanner->url)
                <a href="{{ $topBanner->url }}" class="button btn text-white btn-gradient border-0">
                    <span>{{ app()->getLocale() === 'ar' ? $topBanner->button_label_ar : $topBanner->button_label_en }}</span>
                </a>
            @endif
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section py-5">
    <div class="container">
        <!-- Section Title -->
        <h2 class="fw-bold mb-4 text-center">{{ __('title') }}</h2>

        <!-- Section Description -->
        <p class="mb-5 text-center">
            {{ __('description.start') }}
            <span class="fw-bold text-danger">{{ $services[0]['name'] ?? '' }}</span>,
            <span class="fw-bold text-danger">{{ $services[1]['name'] ?? '' }}</span>
            {{ __('description.middle') }}
            <span class="fw-bold text-danger">{{ $services[2]['name'] ?? '' }}</span>
            {{ __('description.end') }}
        </p>

        <!-- Services Grid -->
        <div class="row g-4 justify-content-center">
            @foreach($services as $key => $service)
                <div class="col-12 col-sm-6 col-md-4 text-center">
                    <!-- Service Icon -->
                    <div class="d-flex justify-content-center">
                        <img
                            src="{{ asset('storage/'.$service['icon']) }}"
                            alt="Service Icon"
                            class="img-fluid rounded-circle"
                            style="width: 80px; height: 80px; object-fit: cover;"
                        >
                    </div>

                    <!-- Service Box -->
                    <div class="p-4 mt-3 bordered-container h-100 d-flex flex-column justify-content-center">
                        <h5 class="fw-semibold {{ $key === 2 ? 'text-danger' : 'text-dark' }}">
                            {{ $service['name'] }}
                        </h5>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CTA Button -->
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ $topBanner->url }}" class="btn btn-black text-white px-4 py-2">
                {{ __('our_services') }}
            </a>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="products-section py-5">
    <div class="container">
        <h2 class="fw-bold mb-5 text-center">{{ __('highlighted_title') }}</h2>

        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="product-wrapper h-100 bordered-container shadow-sm">
                        <div class="d-flex flex-column h-100">
                            <!-- Product Info -->
                            <div class="product-box p-3">
                                <h3 class="fw-bold mb-3 text-truncate">
                                    {{ app()->getLocale() === 'ar' ? $product->name_ar : $product->name_en }}
                                </h3>
                                <p class="text-muted text-truncate mb-3">
                                    {!! Str::limit($product->description, 120) !!}
                                </p>
                                <div class="d-flex justify-content-start">
                                    @if($product->pdf && Storage::disk('public')->exists($product->pdf))
                                        <a href="{{ asset('storage/' . $product->pdf) }}" class="btn btn-sm btn-black text-white">
                                            {{ __('download_pdf') }}
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-black text-white" disabled>
                                            {{ __('download_pdf') }}
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <!-- Product Image -->
                            <div class="image-container text-center">
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Products Button -->
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('product.index') }}" class="btn btn-lg btn-black text-white">
                {{ __('our_products') }}
            </a>
        </div>
    </div>
</section>

<!-- Middle Banner -->
<section class="position-relative banner-section" style="height: 400px; overflow: hidden;">
    <img src="{{ asset($middleBanner->image) }}"
         alt="Banner"
         class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
         style="z-index: 0; filter: brightness(0.5);" />

    <div class="position-absolute top-0 start-0 w-100 h-100 px-3 px-md-5 py-4 py-md-5 d-flex flex-column justify-content-between text-white"
         style="z-index: 2;">
        <div class="text-start mt-3 mt-md-4">
            <div class="lead fw-bold">
                {!! app()->getLocale() === 'ar' ? $middleBanner->description_ar : $middleBanner->description_en !!}
            </div>
        </div>

        @if($middleBanner->url)
            <div class="mt-auto text-end">
                <a href="{{ $middleBanner->url }}" class="btn btn-light text-danger fw-bold border-0">
                    <span>{{ app()->getLocale() === 'ar' ? $middleBanner->button_label_ar : $middleBanner->button_label_en }}</span>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Clients Section -->
<section class="clients-section py-5">
    <div class="container">
        <h2 class="fw-bold mb-5 text-center">{{ __('our_clients') }}</h2>
        <div class="row g-4 justify-content-center">
            @forelse ($clients as $client)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                    <a href="{{ $client->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('storage/' . $client->image) }}"
                             alt="Client Logo"
                             class="img-fluid shadow-sm square-img bordered-container" />
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">{{ __('no_clients') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Bottom Banner -->
<section class="position-relative banner-section" style="height: 400px; overflow: hidden;">
    <img src="{{ asset($bottomBanner->image) }}"
         alt="Banner"
         class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
         style="z-index: 0; filter: brightness(0.5);" />

    <div class="position-absolute top-0 start-0 w-100 h-100 px-3 px-md-5 py-4 py-md-5 d-flex flex-column justify-content-between text-white"
         style="z-index: 2;">
        <div class="text-start mt-3 mt-md-4">
            <div class="lead">
                {!! app()->getLocale() === 'ar' ? $bottomBanner->description_ar : $bottomBanner->description_en !!}
            </div>
        </div>

        @if($bottomBanner->url)
            <div class="mt-auto text-end">
                <a href="{{ $bottomBanner->url }}" class="btn btn-light text-danger fw-bold border-0">
                    <span>{{ app()->getLocale() === 'ar' ? $bottomBanner->button_label_ar : $bottomBanner->button_label_en }}</span>
                </a>
            </div>
        @endif
    </div>
</section>

@endif

@endsection
