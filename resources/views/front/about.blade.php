@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('About Us')])

<section class="about-section">
    <div class="m-5 p-5 content-wrapper">

        {{-- Loop through the sections --}}
        @foreach ($sections as $index => $section)
            @php
                $title = $isArabic ? $section->about_us_title_ar : $section->about_us_title_en;
                $description = $isArabic ? $section->about_us_description_ar : $section->about_us_description_en;
            @endphp

            {{-- Display the first section with image on the right --}}
            @if ($index === 0)
                <div class="row mb-5 align-items-center aboutUs">
                    <div class="col-md-8">
                        <h2 class="fw-bold mb-3">{{ $title }}</h2>
                        <p class="mb-5">{{ $description }}</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $title }}" class="img-fluid rounded">
                    </div>
                </div>
            @else
                {{-- Display the other sections --}}
                <div class="row mb-5 aboutUs">
                    <div class="col-12 {{ $isArabic ? 'text-right' : 'text-left' }}">
                        <h2 class="fw-bold mb-3">{{ $title }}</h2>
                        <p class="mb-5">{{ $description }}</p>
                    </div>
                </div>
            @endif
        @endforeach

        {{-- Team Members Section --}}
        @if($teamMembers->count())
            <div class="row mb-5">
                <div class="col-12 {{ $isArabic ? 'text-right' : 'text-left' }}">
                    <h2 class="fw-bold mb-3">{{ __('Our Team') }}</h2>
                    <p class="mb-5">
                        {{ $isArabic
                            ? 'في شركة الخشروم للصناعات الهندسية، فريقنا هو أساس نجاحنا. يتمتع كل فرد بمهارات فريدة والتزام بالتميز.'
                            : 'At Al-Khshroum Engineering Industries, our team is the backbone of our success. Each member brings a unique set of skills and a commitment to excellence.'
                        }}
                    </p>
                </div>

                <div class="row team-members">
                    @foreach($teamMembers as $member)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 p-5 shadow-sm text-center bordered-container">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $isArabic ? $member->name_ar : $member->name_en }}</h5>
                                    <p>{{ $isArabic ? $member->position_ar : $member->position_en }}</p>
                                    <p>{{ $isArabic ? $member->bio_ar : $member->bio_en }}</p>
                                    <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $isArabic ? $member->name_ar : $member->name_en }}" class="img-fluid mt-3">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
