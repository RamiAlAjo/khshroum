@extends('front.layouts.app')
@section('content')

@if($topBanner)
<section class="position-relative banner-section">
    <!-- Banner Image -->
    <img src="{{ asset($topBanner->image) }}" alt="Banner" class="w-100 h-100 object-fit-cover">
    <div class="position-absolute top-50 start-0 translate-middle-y px-5 z-2 w-100">
        <div class="container mt-5">
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
    <h2 class="fw-bold mb-3">{{ __('lang.title') }}</h2>

    <p class="mb-5">
        {{ __('lang.description.start') }}
        <span class="fw-bold text-danger">{{ $services[0]['name'] ?? '' }}</span>,
        <span class="fw-bold text-danger">{{ $services[1]['name'] ?? '' }}</span>
        {{ __('lang.description.middle') }}
        <span class="fw-bold text-danger">{{ $services[2]['name'] ?? '' }}</span>
        {{ __('lang.description.end') }}
    </p>


        <div class="row justify-content-center">
            @foreach($services as $key => $service)
                <div class="col-md-4 mb-4 service-box-wrapper">
                    <img src="{{ asset('storage/'.$service['icon']) }}" alt="Service Icon" class="img-fluid rounded-circle">
                    <div class="p-4 mt-4 mb-3 service-box bordered-container"">
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
        <h2 class="fw-bold mb-5">{{ __('lang.highlighted_title') }}</h2>
        <div class="d-flex flex-column justify-content-center">
            @foreach($products as $key => $product)
                <div class="product-wrapper col-md-12 mb-4 bordered-container"">
                    <div class="d-flex justofy content-space-between">
                        <!-- Product Details -->
                        <div class="col-md-8 product-box">
                            <h2 class="fw-bold mb-4">
                                {{ app()->getLocale() === 'ar' ? $product->name_ar : $product->name_en }}
                            </h2>
                            <p>
                                {{ Str::limit($product->description, 150) }}
                            </p>
                            <div class="d-flex justify-content-start">
                            @if($product->pdf && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->pdf))
                                    <a href="{{ asset('storage/' . $product->pdf) }}"
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

<section class="position-relative banner-section" style="height: 400px; overflow: hidden;">
    <!-- Banner Image -->
    <img src="{{ asset($middleBanner->image) }}" alt="Banner"
         class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
         style="z-index: 0; filter: brightness(0.5);">

    <!-- Overlay Content Container -->
    <div class="position-absolute top-0 start-0 w-100 h-100 px-5 py-5 d-flex flex-column justify-between text-white" style="z-index: 2;">

        <!-- Top Left: Description -->
        <div class="text-start mt-4">
            <div class="lead description mt-2 fw-bold">
                {!! app()->getLocale() === 'ar' ? $middleBanner->description_ar : $middleBanner->description_en !!}
            </div>
        </div>

        <!-- Bottom Right: Button -->
        @if($middleBanner->url)
            <div class="mt-auto text-end">
                <a href="{{ $middleBanner->url }}" class="btn button text-danger button bg-white fw-bold border-0">
                    <span>
                    {{ app()->getLocale() === 'ar' ? $middleBanner->button_label_ar : $middleBanner->button_label_en }}
                    </span>
                </a>
            </div>
        @endif

    </div>
</section>


<section class="clients-section">
    <div class="container">
        <h2 class="fw-bold mb-5">{{ __('lang.our_clients') }}</h2>
        <div class="row">
            @forelse ($clients as $client)
                <div class="col-md-4 mb-4 text-center">
                    <a href="{{ $client->url ??'' }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('storage/' . $client->image) }}" alt="Client Image" class="img-fluid shadow-sm square-img bordered-container">
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No clients found.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="position-relative banner-section" style="height: 400px; overflow: hidden;">
    <!-- Banner Image -->
    <img src="{{ asset($bottomBanner->image) }}" alt="Banner"
         class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
         style="z-index: 0; filter: brightness(0.5);">

    <!-- Overlay Content Container -->
    <div class="position-absolute top-0 start-0 w-100 h-100 px-5 py-5 d-flex flex-column justify-between text-white" style="z-index: 2;">

        <!-- Top Left: Description -->
        <div class="text-start mt-4">
            <div class="lead description mt-2">
                {!! app()->getLocale() === 'ar' ? $bottomBanner->description_ar : $bottomBanner->description_en !!}
            </div>
        </div>

        <!-- Bottom Right: Button -->
        @if($bottomBanner->url)
            <div class="mt-auto text-end">
                <a href="{{ $bottomBanner->url }}" class="btn button text-danger button bg-white fw-bold border-0">
                    <span>
                    {{ app()->getLocale() === 'ar' ? $bottomBanner->button_label_ar : $bottomBanner->button_label_en }}
                    </span>
                </a>
            </div>
        @endif

    </div>
</section>

@endif
@endsection
