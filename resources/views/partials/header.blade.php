<header class="site-header" id="siteHeader">
    {{-- Main Navigation Bar --}}
    <div class="main-nav">
        <div class="container main-nav-inner">

            {{-- Brand Logo --}}
            <a href="{{ route('home') }}" class="brand" aria-label="Bharat Integrity Forum News - Home">
                <img src="{{ asset('images/logo1.jpeg') }}" alt="Bharat Integrity Forum News" class="brand-logo">
            </a>

            {{-- Desktop Navigation Links --}}
            <nav class="nav-links" id="navLinks" aria-label="Main Navigation">

                {{-- Authentication Section --}}
                @guest
                    {{-- Guest Dropdown --}}
                    <div class="nav-dropdown">
                        <a href="#" class="nav-dropdown-toggle" id="authDropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            Account ▾
                        </a>
                        <div class="nav-dropdown-menu" aria-labelledby="authDropdown">
                            <a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">Login</a>
                            <a href="{{ route('register') }}"
                                class="{{ request()->is('register') ? 'active' : '' }}">Register</a>
                        </div>
                    </div>
                @else
                    {{-- Authenticated User Dropdown --}}
                    <div class="nav-dropdown">
                        <a href="#" class="nav-dropdown-toggle" id="userDropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            {{ Auth::user()->name }} ▾
                        </a>
                        <div class="nav-dropdown-menu" aria-labelledby="userDropdown">
                            <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                                Dashboard
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
                                Activity
                            </a>
                            {{-- <div class="dropdown-divider"></div>
                            <a href="{{ route('user.contacts') }}"
                                class="{{ request()->is('my-contacts') ? 'active' : '' }}">
                                Contacts
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('user.payments') }}"
                                class="{{ request()->is('my-payments') ? 'active' : '' }}">
                                Payments
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('user.products') }}"
                                class="{{ request()->is('my-products') ? 'active' : '' }}">
                                Products
                            </a> --}}
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('ticket.index') }}"
                                class="{{ request()->is('ticket.index') ? 'active' : '' }}">
                                Support
                            </a>

                            <div class="dropdown-divider"></div>
                            <a href="#" onclick="confirmLogout(event, 'logout-form')" class="text-danger">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest

                {{-- General Links --}}
                <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a>
                <a href="{{ route('services') }}" class="{{ request()->is('services') ? 'active' : '' }}">Services</a>
                <a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact Us</a>

            </nav>

            {{-- Hamburger Menu for Mobile --}}
            <button class="hamburger" id="hamburger" aria-label="Open Menu" aria-controls="mobileSidebar">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>

    {{-- Mobile Sidebar --}}
    <div class="mobile-sidebar" id="mobileSidebar" aria-hidden="true">
        <div class="sidebar-header">
            <a href="{{ route('home') }}" class="sidebar-brand" aria-label="Bharat Integrity Forum News - Home">
                <img src="{{ asset('images/logo1.jpeg') }}" alt="Bharat Integrity Forum News" class="sidebar-logo">
            </a>
            <button class="sidebar-close" id="sidebarClose" aria-label="Close Menu">✕</button>
        </div>

        <nav class="sidebar-nav" aria-label="Mobile Navigation">
            @auth
                {{-- Logged In User Mobile Links (With Icons) --}}
                <a href="{{ route('dashboard') }}"
                    class="sidebar-nav-dashboard {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="{{ route('user.contacts') }}" class="{{ request()->is('my-contacts') ? 'active' : '' }}">
                    <i class="fas fa-envelope-open-text"></i> Contacts
                </a>
                <a href="{{ route('user.payments') }}" class="{{ request()->is('my-payments') ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i> Payments
                </a>
                <a href="{{ route('user.products') }}" class="{{ request()->is('my-products') ? 'active' : '' }}">
                    <i class="fas fa-box-open"></i> Products
                </a>
                <a href="{{ route('ticket.index') }}" class="{{ request()->routeIs('ticket.index') ? 'active' : '' }}">
                    <i class="fa-solid fa-ticket"></i> Support
                </a>
                <a href="#" onclick="confirmLogout(event, 'logout-form-mobile')"
                    class="sidebar-nav-logout text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                {{-- Guest Mobile Links (With Icons Added) --}}
                <a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{ route('register') }}" class="{{ request()->is('register') ? 'active' : '' }}">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            @endauth

            <div class="sidebar-divider"></div>

            {{-- General Mobile Links (With Icons Added) --}}
            <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i> About Us
            </a>
            <a href="{{ route('services') }}" class="{{ request()->is('services') ? 'active' : '' }}">
                <i class="fas fa-concierge-bell"></i> Services
            </a>
            <a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Contact Us
            </a>
        </nav>
    </div>

    {{-- Overlay --}}
    <div class="nav-overlay" id="navOverlay"></div>

    {{-- Animated Breaking News Ticker --}}
    <div class="ticker-bar">
        <div class="ticker-label">
            <span class="ticker-pulse"></span>
            <span>Breaking News</span>
        </div>
        <div class="ticker-wrap">
            <div class="ticker-track">
                @php
                    $headlines = [
                        '🚀 Bharat Integrity Forum News is now expanding to your city — apply to become a reporter today.',
                        '⚡ Truth, impartiality and trustworthiness — that\'s our identity.',
                        '📰 Accurate, verified news from across the nation, all in one place.',
                        '🎯 Empowering citizen journalism with integrity and transparency.',
                    ];
                @endphp
                {{-- Loop twice for infinite scrolling effect --}}
                @foreach (array_merge($headlines, $headlines) as $line)
                    <span>{{ $line }}</span>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Tricolor Bottom Ribbon --}}
    <div class="tricolor-ribbon"></div>
</header>
