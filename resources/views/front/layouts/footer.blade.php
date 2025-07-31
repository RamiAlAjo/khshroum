<footer class="border-top mt-5" style="border-image: linear-gradient(to right, #e3342f, #000) 1; padding: 2rem 0;">
    <div class="container">
        <div class="row text-center text-md-start align-items-start">
            <div class="col-md-3 mb-4 mb-md-0">

                <!-- Address -->
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-geo-alt-fill fs-3 me-3"></i>
                    <div>
                        <a href="https://www.google.com/maps?q={{ urlencode($settings->address_line1 . ' ' . $settings->address_line2) }}"
                        class="text-dark text-decoration-none" target="_blank">
                            <strong>{{ $settings->address_line1 ?? 'Abu Alanda' }}</strong><br>
                            {{ $settings->address_line2 ?? 'Amman, Jordan' }}
                        </a>
                    </div>
                </div>

                <!-- Phone(s) -->
                @php
                    $phones = json_decode($settings->phone, true);
                @endphp

                @foreach($phones as $phone)
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-telephone-fill fs-3 me-3"></i>
                        <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-dark text-decoration-none">
                            {{ $phone }}
                        </a>
                    </div>
                @endforeach

                <!-- Email -->
                <div class="d-flex align-items-center">
                    <i class="bi bi-envelope-fill fs-3 me-3"></i>
                    <a href="mailto:{{ $settings->email }}" class="text-dark text-decoration-none">
                        {{ $settings->email ?? 'AlKhshroum@mail.com' }}
                    </a>
                </div>
            </div>
            <div class="col-md-6 text-center mb-4 mb-md-0 logo">
                <img src="{{ asset($settings->logo ?? 'path/to/logo.png') }}" alt="Logo" style="max-height: 60px;">
                <h5 class="fw-bold mt-2">{{ $settings->company_name ?? 'Al-Khshroum Engineering Industries' }}</h5>
                <div class="mt-3 d-flex justify-content-center gap-3">
                    @if($settings->facebook)<a href="{{ $settings->facebook }}"><i class="bi bi-facebook fs-4 text-danger"></i></a>@endif
                    @if($settings->youtube)<a href="{{ $settings->youtube }}"><i class="bi bi-youtube fs-4 text-danger"></i></a>@endif
                    @if($settings->whatsapp)<a href="https://wa.me/{{ $settings->whatsapp }}"><i class="bi bi-whatsapp fs-4 text-danger"></i></a>@endif
                </div>
            </div>
            <div class="col-md-3 d-flex flex-column align-items-center">
                <ol class="ps-3">
                  <li><a href="/" class="fw-bold text-dark text-decoration-none">{{ __('Home') }}</a></li>
                    <li><a href="/services" class="fw-bold text-dark text-decoration-none">{{ __('Services') }}</a></li>
                    <li><a href="/product" class="fw-bold text-dark text-decoration-none">{{ __('Products') }}</a></li>
                    <li><a href="/clients" class="fw-bold text-dark text-decoration-none">{{ __('Clients') }}</a></li>
                    <li><a href="/gallery" class="fw-bold text-dark text-decoration-none">{{ __('Gallery') }}</a></li>
                    <li><a href="/links" class="fw-bold text-dark text-decoration-none">{{ __('Links') }}</a></li>
                    <li><a href="/contact" class="fw-bold text-dark text-decoration-none">{{ __('Contact Us') }}</a></li>
                    <li><a href="/about" class="fw-bold text-dark text-decoration-none">{{ __('About Us') }}</a></li>
                    {{-- <li><a href="/en" class="fw-bold text-dark text-decoration-none">Eng</a></li> --}}

                </ol>

            </div>
        </div>
    </div>
</footer>
