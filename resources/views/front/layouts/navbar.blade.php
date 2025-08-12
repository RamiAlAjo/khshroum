<header id="main-header" class="{{ Request::is('/') ? 'fixed-top' : '' }}">

    <div class="px-4 py-2 z-2 w-100 bg-white shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            {{-- Logo --}}
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset($settings->logo) }}" alt="Logo" width="120" height="120">
                </a>
            </div>

            {{-- Language Switch + Burger Button --}}
            <div class="d-flex flex-row align-items-center gap-3">
                @php
                    $locale = app()->getLocale();
                    $isArabic = $locale === 'ar';
                    $nextLocale = $isArabic ? 'en' : 'ar';
                    $flagSrc = $isArabic
                        ? 'https://flagcdn.com/w40/jo.png'
                        : 'https://flagcdn.com/w40/gb.png';
                    $label = $isArabic ? 'AR' : 'EN';
                @endphp

                {{-- Language Switcher --}}
                <a href="{{ route('change.language', ['locale' => $nextLocale]) }}"
                   class="btn lang-switcher d-flex align-items-center gap-2"
                   aria-label="{{ __('Switch Language') }}">
                    <img src="{{ $flagSrc }}" alt="{{ $label }} Flag" class="flag-icon" loading="lazy">
                    <span class="lang-label d-none d-sm-inline">{{ $label }}</span>
                </a>

                {{-- Burger Menu Button --}}
                <button class="btn p-0 border-0" id="burgerBtn" aria-label="Open Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#FF5959" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="#FF5959" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Burger Menu --}}
    <div id="burgerMenu"
         class="position-fixed top-0 end-0 bg-dark text-white p-4 shadow-lg"
         style="transform: translateX(100%); transition: transform 0.3s ease; width: 250px; height: 100vh; z-index: 1050;">
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

    if (!header || !burgerMenu || !burgerBtn || !closeMenu) return;

    burgerBtn.addEventListener('click', () => {
        burgerMenu.style.transform = 'translateX(0)';
        document.body.style.overflow = 'hidden'; // Disable scroll
    });

    closeMenu.addEventListener('click', () => {
        burgerMenu.style.transform = 'translateX(100%)';
        document.body.style.overflow = '';
    });

    document.addEventListener('click', function (e) {
        if (!burgerMenu.contains(e.target) && !burgerBtn.contains(e.target)) {
            burgerMenu.style.transform = 'translateX(100%)';
            document.body.style.overflow = '';
        }
    });

    // Hide header on scroll down
    let lastScrollTop = 0;
    window.addEventListener('scroll', function () {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        if (currentScroll > lastScrollTop && currentScroll > header.offsetHeight) {
            header.classList.add('hidden');
            burgerMenu.style.transform = 'translateX(100%)';
            document.body.style.overflow = '';
        } else if (currentScroll < lastScrollTop) {
            header.classList.remove('hidden');
        }
        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });

    // Resize handler
    window.addEventListener('resize', function () {
        if (window.innerWidth > 767) {
            burgerMenu.style.transform = 'translateX(100%)';
            document.body.style.overflow = '';
        }
    });
});
</script>

<style>
    .lang-switcher {
    font-size: 1rem;
    padding: 0.375rem 0.75rem;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    background-color: transparent;
    color: #333;
    white-space: nowrap;
}

.lang-switcher:hover {
    background-color: #f8f9fa;
    border-color: #bbb;
}

.flag-icon {
    width: 24px;
    height: 16px;
    object-fit: contain;
}

@media (max-width: 576px) {
    .lang-switcher {
        font-size: 0.85rem;
        padding: 0.25rem 0.5rem;
    }

    .flag-icon {
        width: 20px;
        height: 13px;
    }
}

#main-header.hidden {
    top: -120px;
    transition: top 0.3s ease;
    position: fixed;
    width: 100%;
    z-index: 999;
}

</style>
