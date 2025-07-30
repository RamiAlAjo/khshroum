@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Products')])

@php
    $isArabic = app()->getLocale() === 'ar'; // Check if current locale is Arabic
@endphp

<!-- Main container for the page content -->
<section class="products-section py-5">
    <div class="container">
        <div class="row">
            <!-- Left Column (4 cols) -->
            <div class="col-md-4">
                <h2 class="product-title text-left mb-5">{{ __('Our Products') }}</h2>
                <div class="product-filter-list">
                    <div class="scrollable-product-list">
                        <ul class="product-list">
                            <!-- "All" Filter Link -->
                            <li class="mb-3">
                                <a class="{{ request()->routeIs('product.index') ? 'active' : '' }}" href="{{ route('product.index') }}">{{ __('All') }}</a>
                            </li>

                            <!-- Product Filter Links -->
                          @foreach ($categories as $category)
                                <li class="mb-3">
                                    <a class="{{ request('category_id') == $category->id ? 'active' : '' }}" href="{{ route('product.index', ['category_id' => $category->id]) }}">
                                        {{ $isArabic ? $category->name_ar : $category->name_en }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Column (8 cols) -->
            <div class="col-md-8">
                <div class="row g-5">
                    @forelse ($products as $product)
                        <div class="col-md-6 col-lg-4 text-center product-item">
                            <a href="{{ route('product.show', $product->id) }}">
                                <div class="card product-card shadow-sm">
                                    <img class="square-img rounded" src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.png') }}" alt="{{ $isArabic ? $product->name_ar : $product->name_en }}" />
                                    <div class="container mt-3">
                                        <h5 class="product-name">{{ $isArabic ? $product->name_ar : $product->name_en }}</h5>
                                        <p class="product-description">{{ Str::limit($product->description, 100) }}</p>
                                    </div>
                                    <a href="{{ route('product.show', $product->id) }}" class="arrow-link">
                                        <i class="fas fa-arrow-right fa-lg"></i>
                                    </a>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>{{ __('No products available at the moment.') }}</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination or Load More Button -->
                <div class="d-flex justify-content-center mt-4">
                    <a href="#" class="btn btn-outline-primary load-more-btn">{{ __('Load More') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
