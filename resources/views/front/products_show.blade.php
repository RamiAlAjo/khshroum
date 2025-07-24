@extends('front.layouts.app')
@section('content')
@include('components.global-slider', ['pageTitle' => 'Products'])

<div class="m-5 p-5 content-wrapper">
    <div class="row align-items-center">
        <div class="col-md-7 text-start">
            <h2 class="fw-bold mb-3">{{ $product->name_en }}</h2>
            <p class="mb-5">
                {{ $product->description_en ?? 'No description available.' }}
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
        <div class="col-md-5 text-center">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_en }}" class="img-fluid rounded">
        </div>
    </div>
</div>


@endsection
