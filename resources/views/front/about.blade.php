@extends('front.layouts.app')
@section('content')
@include('components.global-slider', ['pageTitle' => 'About Us'])

@foreach ($sections as $index => $section)
    @php
        $title = $isArabic ? $section->title_ar : $section->title_en;
        $description = $isArabic ? $section->description_ar : $section->description_en;
    @endphp

    @if ($index === 0)
        {{-- First section: Title + Desc left, Image right --}}
        <div class="row mb-5 align-items-center">
            <div class="col-md-7">
                <h2>{{ $title }}</h2>
                <p>{{ $description }}</p>
            </div>
            <div class="col-md-5 text-center">
                <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $title }}" class="img-fluid rounded">
            </div>
        </div>
    @else
        {{-- Other sections: Title, then description below --}}
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2>{{ $title }}</h2>
                <p class="mt-3">{{ $description }}</p>
            </div>
        </div>
    @endif
@endforeach


@endsection
