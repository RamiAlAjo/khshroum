<header id="main-header" class="{{ Request::is('/') ? 'fixed-top' : '' }}">

    <div class="px-5 z-2 w-100">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}" class="href">
                    <img src="{{ asset($settings->logo) }}" alt="Logo" width="150" height="150">
                </a>
            </div>
            <div class="d-flex flex-row">
                @php
                    $locale = app()->getLocale();
                    $isArabic = $locale === 'ar';
                    $nextLocale = $isArabic ? 'en' : 'ar';
                    $flag = $isArabic ? '🇯🇴' : '🇬🇧';
                    $label = $isArabic ? 'AR' : 'EN';
                @endphp

                <a href="{{ route('change.language', ['locale' => $nextLocale]) }}"
                class="btn bordered-container btn-outline-secondary btn-sm d-flex align-items-center"
                style="font-size: 1rem;" aria-label="{{ __('Switch Language') }}">
                    {{ $flag }} {{ $label }}
                </a>

                <button class="btn p-0 border-0" id="burgerBtn" aria-label="Open Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="#FF5959" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="#FF5959" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Burger Menu -->
    <div id="burgerMenu"
         class="position-fixed top-0 end-0 bg-dark text-white p-4 shadow-lg"
         style="transform: translateX(100%); transition: transform 0.3s ease;">
        <button id="closeMenu" class="btn-close btn-close-white ms-auto mb-4" aria-label="Close Menu"></button>

        <nav class="nav flex-column gap-3 fs-5">
            <a class="nav-link text-white" href="{{ route('home') }}">{{ __('Home') }}</a>
            <a class="nav-link text-white" href="/about">{{ __('About Us') }}</a>
            <a class="nav-link text-white" href="/product">{{ __('Products') }}</a>
            <a class="nav-link text-white" href="/services">{{ __('Services') }}</a>
            <a class="nav-link text-white" href="/clients">{{ __('Clients') }}</a>
            <a class="nav-link text-white" href="/links">{{ __('Links') }}</a>
            <a class="nav-link text-white" href="/gallery">{{ __('Gallery') }}</a>
            <a class="nav-link text-white" href="/contact">{{ __('Contact Us') }}</a>
        </nav>
    </div>

</header>

{{-- JavaScript for Header and Menu Behavior --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('main-header');
    const burgerMenu = document.getElementById('burgerMenu');
    const burgerBtn = document.getElementById('burgerBtn');
    const closeMenu = document.getElementById('closeMenu');

    if (!header || !burgerMenu || !burgerBtn || !closeMenu) {
        console.error('Required elements are missing.');
        return;
    }

    // --- Burger Menu Control ---
    burgerBtn.addEventListener('click', function () {
        burgerMenu.style.transform = 'translateX(0)'; // Show menu
    });

    closeMenu.addEventListener('click', function () {
        burgerMenu.style.transform = 'translateX(100%)'; // Hide menu
    });

    // Close the burger menu if clicked outside the menu
    document.addEventListener('click', function (event) {
        if (!burgerMenu.contains(event.target) && !burgerBtn.contains(event.target)) {
            burgerMenu.style.transform = 'translateX(100%)'; // Hide menu
        }
    });

    // --- Header Scroll Behavior ---
    let lastScrollTop = 0; // Stores the last scroll position

    window.addEventListener('scroll', function () {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScrollTop && currentScroll > header.offsetHeight) {
            // Scrolling down AND scrolled past the header's initial position
            header.classList.add('hidden'); // Hide the header

            // Hide the burger menu if it's open when scrolling down
            if (burgerMenu.style.transform === 'translateX(0px)') {
                burgerMenu.style.transform = 'translateX(100%)'; // Hide the menu
            }
        } else if (currentScroll < lastScrollTop) {
            // Scrolling up
            header.classList.remove('hidden'); // Show the header
        }
        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
    });

    // --- Resize Handling ---
    window.addEventListener('resize', function () {
        if (window.innerWidth > 767) {
            burgerMenu.style.transform = 'translateX(100%)'; // Ensure menu is hidden on larger screens
        }
    });
});

</script>
