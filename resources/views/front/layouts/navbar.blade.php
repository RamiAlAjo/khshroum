<header id="main-header" class="{{ Request::is('/') ? 'fixed-top' : '' }}">

    <div class="px-5 z-2 w-100">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="{{route('home')}}" class="href">
                    <img src="{{ asset($settings->logo) }}" alt="Logo" width="150" height="150">
                </a>
            </div>
            <button class="btn p-0 border-0" id="burgerBtn" aria-label="Open Menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="#FF5959" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke="#FF5959" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>


    <div id="burgerMenu"
         class="position-fixed top-0 end-0 bg-dark text-white p-4"
         style="width: 250px; height: 100vh; transform: translateX(100%); transition: transform 0.3s ease-in-out; z-index: 1050;">
        <button id="closeMenu" class="btn-close btn-close-white ms-auto mb-4" aria-label="Close"></button>

        <nav class="nav flex-column gap-3 fs-5">
            <a class="nav-link text-white" href="{{route('home')}}">Home</a>
            <a class="nav-link text-white" href="/about">About Us</a>
            <a class="nav-link text-white" href="/product">Products</a>
            <a class="nav-link text-white" href="/services">Services</a>
            <a class="nav-link text-white" href="/clients">Clients</a>
            <a class="nav-link text-white" href="/links">Links</a>
            <a class="nav-link text-white" href="/gallery">Gallery</a>
            <a class="nav-link text-white" href="/contact">Contact Us</a>
        </nav>
    </div>
</header>

{{-- Keep your existing JavaScript for header and menu behavior --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const header = document.getElementById('main-header');
        const burgerMenu = document.getElementById('burgerMenu');
        const burgerBtn = document.getElementById('burgerBtn');
        const closeMenu = document.getElementById('closeMenu');

        if (!header) {
            console.error('Header element with ID "main-header" not found.');
            return;
        }

        // --- Burger Menu Control ---
        burgerBtn.addEventListener('click', function () {
            burgerMenu.style.transform = 'translateX(0)'; // Show menu
        });

        closeMenu.addEventListener('click', function () {
            burgerMenu.style.transform = 'translateX(100%)'; // Hide menu
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                burgerMenu.style.transform = 'translateX(100%)'; // Hide menu on Escape
            }
        });

        // --- Header Scroll Behavior ---
        let lastScrollTop = 0; // Stores the last scroll position

        window.addEventListener('scroll', function () {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > lastScrollTop && currentScroll > header.offsetHeight) {
                // Scrolling down AND scrolled past the header's initial position
                header.classList.add('hidden'); // Hide the header

                // --- Hide the burger menu if it's open when scrolling down ---
                if (burgerMenu.style.transform === 'translateX(0px)') {
                    burgerMenu.style.transform = 'translateX(100%)'; // Hide the menu
                }

            } else if (currentScroll < lastScrollTop) {
                // Scrolling up
                header.classList.remove('hidden'); // Show the header
            }
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
        });
    });
</script>
