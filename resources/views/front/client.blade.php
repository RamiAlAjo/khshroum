@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Clients')])

<div class="m-5 p-5 content-wrapper">
    <h2 class="fw-bold mb-3">
        {{ app()->getLocale() === 'ar' ? 'عملاؤنا المميزون' : 'Our Valuable Clients' }}
    </h2>

    {{-- Description with raw HTML (from Summernote) --}}
    <div class="mb-5">
        {!! app()->getLocale() === 'ar'
            ? ($clientDescriptionAr ?? '')
            : ($clientDescriptionEn ?? '') !!}
    </div>

    {{-- Clients Grid --}}
    <div class="row justify-content-center">
        @forelse ($clients as $client)
            <div class="col-6 col-sm-4 col-md-3 mb-4 text-center">
                <a href="{{ $client->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('/' . $client->image) }}" alt="Client Image"
                         class="img-fluid shadow-sm square-img bordered-container">
                </a>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">{{ __('No clients found.') }}</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
