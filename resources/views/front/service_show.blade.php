@extends('front.layouts.app')
@section('content')
@include('components.global-slider', ['pageTitle' => 'Services'])

<div class="m-5 p-5 content-wrapper">
    <div class="row align-items-center gx-0">
        <h2 class="fw-bold mb-5">{{ $service->name_en }}</h2>
        <div class="col-12 px-0">
            <div class="ratio ratio-21x9 bordered-container">
                <img src="{{ asset('storage/' . $service->image) }}"
                     alt="{{ $service->name_en }}"
                     class="w-100 h-100 object-fit-cover rounded-0">
            </div>
        </div>
        <p class="mt-5">
            {{ $service->description_en ?? 'No description available.' }}
        </p>
    </div>
</div>





@endsection
