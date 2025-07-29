@extends('front.layouts.app')

@section('content')
@include('components.global-slider', ['pageTitle' => __('Contact Us')])

<!-- Main container for the page content -->
<div class="m-5 p-5 content-wrapper">
    <div class="row mt-0 mb-5 text-center justify-content-center align-items-start g-5 settings">
        <!-- Address -->
        <div class="col-12 col-md-4 mt-0">
            <i class="bi bi-geo-alt-fill text-danger"></i>
            <div class="mt-2">
                <a href="https://www.google.com/maps?q={{ urlencode($settings->address_line1 . ' ' . $settings->address_line2) }}"
                   class="text-dark text-decoration-none d-block fs-5 fw-bold" target="_blank">
                    <strong>{{ $settings->address ?? 'Abu Alanda' }}</strong><br>
                </a>
            </div>
        </div>

        <!-- Phone -->
        <div class="col-12 col-md-4 mt-0">
            <i class="bi bi-telephone-fill text-danger"></i>
            <div class="mt-2">
                @php
                    $phones = json_decode($settings->phone, true);
                @endphp
                @foreach($phones as $phone)
                    <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-dark text-decoration-none d-block fs-5 fw-bold">
                        {{ $phone }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Email -->
        <div class="col-12 col-md-4 mt-0">
            <i class="bi bi-envelope-fill text-danger"></i>
            <div class="mt-2">
                <a href="mailto:{{ $settings->email }}" class="text-dark text-decoration-none d-block fs-5 fw-bold">
                    {{ $settings->email ?? 'AlKhshroum@mail.com' }}
                </a>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="row min-vh-100 align-items-stretch contact">
        <div class="col-lg-6 d-flex">
            <div class="contact-box p-4 w-100 d-flex flex-column justify-content-center">
                <h2 class="fw-bold mb-3">Get In Touch</h2>
                <p class="mb-5 w-75">
                    {{ $isArabic
                        ? 'شكرًا لاختياركم الخشروم! نحن هنا لمساعدتكم. لا تترددوا في التواصل معنا لأي استفسارات أو أسئلة. نحن بانتظار مساعدتكم!'
                        : "Thank you for choosing Al Khshroum! We’re here to help you. Feel free to reach out with any questions or inquiries. We look forward to assisting you!"
                    }}
                </p>

                <div class="form-section">
                    <form method="POST" action="#">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your full name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your email address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your message..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn text-white button btn-black border-0">
                                <span>{{ $isArabic === 'ar' ? 'إرسال' : 'Submit' }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Image -->
        <div class="col-lg-6 p-0">
            <img src="{{ asset('images/contact.webp') }}" alt="Company Logo" class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 0 0.5rem 0.5rem 0;">
        </div>
    </div>
</div>

@endsection
