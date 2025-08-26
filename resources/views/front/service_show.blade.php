@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Services')])

<div class="m-5 p-5 content-wrapper">
    <div class="row align-items-center gx-0">
        <h2 class="fw-bold mb-5">
            {{ app()->getLocale() === 'ar' ? $service->name_ar : $service->name_en }}
        </h2>
        <div class="col-12 px-0">
            <div class="ratio ratio-21x9 bordered-container">
                <img src="{{ asset('/' . $service->image) }}"
                     alt="{{ app()->getLocale() === 'ar' ? $service->name_ar : $service->name_en }}"
                     class="w-100 h-100 object-fit-cover rounded-0">
            </div>
        </div>
      <p class="mt-5">
  {!! app()->getLocale() === 'ar' ? $service->description_ar : ($service->description_en ?? __('No description available.')) !!}
</p>

    </div>
</div>

@endsection
