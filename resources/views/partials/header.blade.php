<header class="site-header" id="siteHeader">

    {{-- Slim tricolor utility bar --}}
    {{-- <div class="top-bar">
        <div class="container top-bar-inner">
            <div class="top-bar-left">
                <span class="tagline">
                    Truth <i class="dot"></i> Impartial <i class="dot"></i> Trustworthy
                </span>
            </div>
            <div class="top-bar-right">
                <div class="social-mini">
                    <a href="#" aria-label="Facebook">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M13.5 21v-8h2.7l.4-3.2h-3.1V7.7c0-.9.3-1.6 1.7-1.6h1.6V3.2C16.5 3.1 15.4 3 14.2 3c-2.6 0-4.4 1.6-4.4 4.5v2.3H7v3.2h2.8v8h3.7z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Twitter">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M22 5.9c-.7.3-1.5.6-2.3.7.8-.5 1.4-1.3 1.7-2.3-.8.5-1.7.8-2.6 1a4.1 4.1 0 0 0-7 3.7A11.6 11.6 0 0 1 3.4 4.6a4.1 4.1 0 0 0 1.3 5.5c-.6 0-1.3-.2-1.8-.5v.1c0 2 1.4 3.6 3.3 4a4.2 4.2 0 0 1-1.9.1 4.1 4.1 0 0 0 3.9 2.9A8.3 8.3 0 0 1 2 18.4a11.6 11.6 0 0 0 6.3 1.9c7.5 0 11.7-6.4 11.7-11.9v-.5c.8-.6 1.5-1.3 2-2z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12 2c-2.7 0-3 0-4.1.06-1.1.05-1.8.22-2.5.47a5 5 0 0 0-1.8 1.2 5 5 0 0 0-1.2 1.8c-.25.7-.42 1.4-.47 2.5C2 9.14 2 9.44 2 12.14s0 3 .06 4.1c.05 1.1.22 1.8.47 2.5.26.7.6 1.3 1.2 1.8.5.5 1.1.9 1.8 1.2.7.25 1.4.42 2.5.47 1.1.06 1.4.06 4.1.06s3 0 4.1-.06c1.1-.05 1.8-.22 2.5-.47a5 5 0 0 0 1.8-1.2 5 5 0 0 0 1.2-1.8c.25-.7.42-1.4.47-2.5.06-1.1.06-1.4.06-4.1s0-3-.06-4.1c-.05-1.1-.22-1.8-.47-2.5a5 5 0 0 0-1.2-1.8 5 5 0 0 0-1.8-1.2c-.7-.25-1.4-.42-2.5-.47C15 2 14.7 2 12 2zm0 5.4a4.6 4.6 0 1 1 0 9.2 4.6 4.6 0 0 1 0-9.2zm0 1.8a2.8 2.8 0 1 0 0 5.6 2.8 2.8 0 0 0 0-5.6zm5.9-2a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="YouTube">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M22 12s0-3.2-.4-4.7a2.8 2.8 0 0 0-2-2C17.9 5 12 5 12 5s-5.9 0-7.6.3a2.8 2.8 0 0 0-2 2C2 8.8 2 12 2 12s0 3.2.4 4.7a2.8 2.8 0 0 0 2 2C6.1 19 12 19 12 19s5.9 0 7.6-.3a2.8 2.8 0 0 0 2-2C22 15.2 22 12 22 12zM10 15.3V8.7L15.8 12 10 15.3z" />
                        </svg>
                    </a>
                </div>
                <span id="topDate"></span>
            </div>
        </div>
    </div> --}}

    {{-- Main navigation --}}
    <div class="main-nav">
        <div class="container main-nav-inner">

            <a href="{{ url('/') }}" class="brand" aria-label="Bharat Integrity Forum News - Home">
                <img src="{{ asset('images/logo1.jpeg') }}" alt="Bharat Integrity Forum News" class="brand-logo">
            </a>

            <nav class="nav-links" id="navLinks">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a>
                <a href="{{ url('/services') }}" class="{{ request()->is('services') ? 'active' : '' }}">Services</a>
                <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact Us</a>
                {{-- <a href="{{ url('/contact') }}#contact">Contact Us</a> --}}
            </nav>

            <a href="{{ url('/services') }}#reporter" class="btn btn-reporter">Become a Reporter</a>

            <button class="hamburger" id="hamburger" aria-label="Open Menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>

    <div class="nav-overlay" id="navOverlay"></div>

    {{-- Animated breaking-news ticker --}}
    <div class="ticker-bar">
        <div class="ticker-label">Breaking News</div>
        <div class="ticker-wrap">
            <div class="ticker-track">
                @php
                    $headlines = [
                        'Bharat Integrity Forum News is now expanding to your city — apply to become a reporter today.',
                        'Truth, impartiality and trustworthiness — that\'s our identity.',
                        'Accurate, verified news from across the nation, all in one place.',
                    ];
                @endphp
                @foreach (array_merge($headlines, $headlines) as $line)
                    <span>🔴 {{ $line }}</span>
                @endforeach
            </div>
        </div>
    </div>

    <div class="tricolor-ribbon"></div>
</header>
