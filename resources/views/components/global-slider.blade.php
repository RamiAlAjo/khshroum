@if($sliders->isNotEmpty())
    <section class="position-relative banner-section" style="height: 400px; overflow: hidden;">
        <!-- Banner Image -->
        <img src="{{ asset($sliders->first()->image) }}" alt="Banner"
             class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
             style="z-index: 0; filter: brightness(0.5);">

        <!-- Overlay Content Container -->
        <div class="position-absolute top-0 start-0 w-100 h-100 px-5 py-5 d-flex flex-column justify-between text-white" style="z-index: 2;">

            <!-- Top Left: Page Title -->
            <div class="position-absolute top-0 start-0 w-100 h-100 px-5 py-5 d-flex justify-content-center align-items-center text-white" style="z-index: 2;">
                <h1 class="fw-bold display-4">
                    {{ $pageTitle ?? __('Page Title') }}
                </h1>
            </div>
        </div>
    </section>
@endif
