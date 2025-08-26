@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Links')])

<div class="m-5 p-5 content-wrapper">
    <h2 class="fw-bold mb-3">
        {{ app()->getLocale() === 'ar' ? 'روابط' : 'Links' }}
    </h2>
    <p class="mb-5">
        {{ app()->getLocale() === 'ar' ? 'اكتشف المزيد عن قدراتنا.' : 'Discover more about our capabilities.' }}
    </p>

    <div class="row">
        @forelse ($links as $link)
            <div class="col-md-4 mb-4 text-center">
                <a href="{{ $link->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                    <img
                        src="{{ asset('/' . $link->image) }}"
                        alt="{{ $link->name ?? 'Link Image' }}"
                        class="img-fluid shadow-sm square-img bordered-container"
                        style="width: 100%; height: auto; object-fit: contain; max-width: 250px;">
                </a>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">{{ __('No links found.') }}</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
