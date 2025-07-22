@extends('front.layouts.app')
@section('content')
@include('components.global-slider', ['pageTitle' => 'Products'])

<!-- Main container for the page content -->
<section class="products-section">
    <div class="m-5">
        <div class="row">
            <!-- Left Column (4 cols) -->
            <div class="col-md-4">
                <h2 class="product-title text-left mb-5">Our Products</h2>
                <div class="product-filter-list">
                    <div class="scrollable-product-list">
                        <ul class="product-list">
                            <li class="mb-3">
                                <a class="active" href="{{ route('product.index') }}">All</a>
                            </li>
                            @foreach ($products as $product)
                                <li class="mb-3">
                                    <a href="{{ route('product.show', $product->id) }}">{{ $product->name_en }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                </div>
            </div>
            <!-- Right Column (8 cols, with 2-column product layout) -->
            <div class="col-md-8">
                <div class="row g-5">
                    @forelse ($products as $product)
                        <div class="col-6 text-center product-item">
                            <a href="{{ route('product.show', $product->id) }}" >
                                <div class="card product-card">
                                <img class="square-img" src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.png') }}" alt="{{ $product->name_en }}">
                                <div class="container">
                                    <h4><b>  {{ $product->name_en }}</b></h4>
                                </div>
                                    <a href="{{ route('product.show', $product->id) }}" class="arrow-link">
                                    <i class="fas fa-arrow-right fa-lg"></i>
                                    </a>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No products available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
