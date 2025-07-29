@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Clients')])

<div class="m-5 p-5 content-wrapper">
    <h2 class="fw-bold mb-3">
        {{ app()->getLocale() === 'ar' ? 'عملاؤنا المميزون' : 'Our valuable clients' }}
    </h2>
    <p class="mb-5">
        {{ app()->getLocale() === 'ar' ? 'انضم إلى عملائنا الكرام الذين يثقون بنا لتقديم حلول مبتكرة وخدمة استثنائية.' : 'Join our esteemed clients who trust us to deliver innovative solutions and exceptional service.' }}
    </p>

    <div class="row justify-content-center">
        @forelse ($clients as $client)
            <div class="col-6 col-sm-4 col-md-3 mb-4 text-center">
                <a href="{{ $client->url ?? '' }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('storage/' . $client->image) }}" alt="Client Image"
                        class="img-fluid shadow-sm square-img bordered-container">
                </a>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No clients found.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
