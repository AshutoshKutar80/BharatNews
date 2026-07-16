@extends('layouts.app')

@section('title', 'Dashboard - Bharat Integrity Forum News')
@section('meta_description',
    'Manage your profile, track your activities, and access exclusive content on your Bharat
    Integrity Forum News dashboard.')
@section('meta_keywords', 'dashboard, user dashboard, profile, Bharat Integrity Forum')

@section('content')

    {{-- ================= DASHBOARD HERO ================= --}}
    <section class="dashboard-hero">
        <div class="container">
            <div class="dashboard-hero-inner">
                <div class="dashboard-hero-content">
                    <span class="dashboard-badge">
                        <span class="badge-dot"></span>
                        Welcome Back
                    </span>
                    <h1 class="dashboard-title">Hello, <span class="text-gold">{{ $user->name ?? 'User' }}</span> 👋</h1>
                    <p class="dashboard-subtitle">Here's what's happening with your account today.</p>
                </div>
                <div class="dashboard-hero-stats">
                    <div class="hero-stat">
                        <span class="stat-number">{{ $user->created_at->diffForHumans() ?? 'New' }}</span>
                        <span class="stat-label">Member Since</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <span class="stat-number">{{ ucfirst($user->status ?? 'Active') }}</span>
                        <span class="stat-label">Account Status</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-shapes">
            <div class="dash-shape dash-shape-1"></div>
            <div class="dash-shape dash-shape-2"></div>
        </div>
    </section>

    {{-- ================= DASHBOARD CONTENT ================= --}}
    <section class="dashboard-section">
        <div class="container">
            <div class="dashboard-grid">

                {{-- Left Sidebar --}}
                <aside class="dashboard-sidebar">
                    {{-- Profile Card --}}
                    <div class="profile-card">
                        <div class="profile-avatar">
                            @php
                                $name = $user->name ?? 'User';
                                $initial = strtoupper(substr($name, 0, 1));
                            @endphp
                            <span class="avatar-text">{{ $initial }}</span>
                            <span class="avatar-status {{ $user->status === 'active' ? 'online' : 'offline' }}"></span>
                        </div>
                        <h3 class="profile-name">{{ $user->name ?? 'User' }}</h3>
                        <p class="profile-email">{{ $user->email ?? 'user@example.com' }}</p>
                        <div class="profile-status">
                            <span class="status-badge {{ $user->status === 'active' ? 'active' : 'pending' }}">
                                {{ $user->status ?? 'Pending' }}
                            </span>
                        </div>
                    </div>

                    {{-- User Details Card --}}
                    {{-- <div class="profile-details-card">
                        <h4 class="details-title">User Details</h4>
                        <div class="details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Name</span>
                                <span class="detail-value">{{ $user->name ?? 'Not provided' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Mobile</span>
                                <span class="detail-value">{{ $user->mobile ?? 'Not provided' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">State</span>
                                <span class="detail-value">{{ $user->state ?? 'Not provided' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">District</span>
                                <span class="detail-value">{{ $user->district ?? 'Not provided' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Tehsil</span>
                                <span class="detail-value">{{ $user->tehsil ?? 'Not provided' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">City</span>
                                <span class="detail-value">{{ $user->city ?? 'Not provided' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Pincode</span>
                                <span class="detail-value">{{ $user->pincode ?? 'Not provided' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Member Since</span>
                                <span
                                    class="detail-value">{{ $user->created_at ? $user->created_at->format('d M, Y') : 'New' }}</span>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Sidebar Navigation --}}
                    <div class="sidebar-nav">
                        <a href="{{ route('dashboard') }}" class="sidebar-nav-item active">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('profile') }}" class="sidebar-nav-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            Profile
                        </a>
                        <a href="{{ route('user.products') }}" class="sidebar-nav-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                                <line x1="3" y1="6" x2="21" y2="6" />
                                <path d="M16 10a4 4 0 01-8 0" />
                            </svg>
                            Purchases
                            @if ($totalProducts > 0)
                                <span class="nav-badge">{{ $totalProducts }}</span>
                            @endif
                        </a>
                        <a href="{{ route('user.contacts') }}" class="sidebar-nav-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                            </svg>
                            Contacts
                            @if ($totalContacts > 0)
                                <span class="nav-badge">{{ $totalContacts }}</span>
                            @endif
                        </a>
                    </div>
                </aside>

                {{-- Main Content --}}
                <main class="dashboard-main">

                    {{-- Stats Cards --}}
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-card-icon blue">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="stat-card-info">
                                <span class="stat-card-number">{{ $totalProducts }}</span>
                                <span class="stat-card-label">Total Purchases</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon green">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </div>
                            <div class="stat-card-info">
                                <span class="stat-card-number">{{ $totalContacts }}</span>
                                <span class="stat-card-label">Total Contacts</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon orange">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M4 4v16h16" />
                                    <polyline points="20 10 12 18 8 14" />
                                </svg>
                            </div>
                            <div class="stat-card-info">
                                <span class="stat-card-number">{{ $totalNews }}</span>
                                <span class="stat-card-label">Breaking News</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon purple">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                    <path d="M2 17l10 5 10-5" />
                                    <path d="M2 12l10 5 10-5" />
                                </svg>
                            </div>
                            <div class="stat-card-info">
                                <span
                                    class="stat-card-number">{{ $user->created_at ? $user->created_at->format('Y') : 'New' }}</span>
                                <span class="stat-card-label">Member Since</span>
                            </div>
                        </div>
                    </div>

                    {{-- Purchased Products Section --}}
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title">Purchased Products</h3>
                            <div class="section-actions">
                                @if ($totalProducts > 0)
                                    <a href="{{ route('user.products') }}" class="view-all-link">View All</a>
                                @endif
                            </div>
                        </div>
                        @if ($products->count() > 0)
                            <div class="product-list">
                                @foreach ($products as $product)
                                    <div class="list-item">
                                        <div class="item-icon product">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                                                <line x1="3" y1="6" x2="21" y2="6" />
                                                <path d="M16 10a4 4 0 01-8 0" />
                                            </svg>
                                        </div>
                                        <div class="item-content">
                                            <p class="item-title">{{ $product->product_name }}</p>
                                            <span class="item-meta">
                                                Type: {{ ucfirst($product->product_type) }} •
                                                ₹{{ number_format($product->amount, 2) }} •
                                                {{ $product->purchased_at ? $product->purchased_at->format('d M, Y') : 'Recent' }}
                                            </span>
                                        </div>
                                        <div class="item-actions">
                                            <span
                                                class="item-status {{ $product->payment_status === 'completed' ? 'success' : ($product->payment_status === 'pending' ? 'pending' : 'failed') }}">
                                                {{ ucfirst($product->payment_status) }}
                                            </span>
                                            @if ($product->tracking_id)
                                                <span class="item-tracking">#{{ $product->tracking_id }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                                        <line x1="3" y1="6" x2="21" y2="6" />
                                        <path d="M16 10a4 4 0 01-8 0" />
                                    </svg>
                                </div>
                                <p>No purchased products yet.</p>
                                {{-- <a href="{{ route('user.products') }}" class="empty-action">Browse Products</a> --}}
                            </div>
                        @endif
                    </div>

                    {{-- Contacts Section --}}
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title">Recent Contacts</h3>
                            <div class="section-actions">
                                @if ($totalContacts > 0)
                                    <a href="{{ route('user.contacts') }}" class="view-all-link">View All</a>
                                @endif
                            </div>
                        </div>
                        @if ($contacts->count() > 0)
                            <div class="contact-list">
                                @foreach ($contacts as $contact)
                                    <div class="list-item">
                                        <div class="item-icon contact">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                                            </svg>
                                        </div>
                                        <div class="item-content">
                                            <p class="item-title">{{ $contact->name }}</p>
                                            <span class="item-meta">
                                                {{ $contact->subject }} •
                                                {{ $contact->created_at->format('d M, Y') }}
                                                @if ($contact->mobile)
                                                    • 📱 {{ $contact->mobile }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="item-actions">
                                            <span
                                                class="item-status {{ $contact->status === 'replied' ? 'success' : ($contact->status === 'read' ? 'info' : 'pending') }}">
                                                {{ ucfirst($contact->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                                    </svg>
                                </div>
                                <p>No contacts yet.</p>
                                {{-- <a href="{{ route('contact') }}" class="empty-action">Create Contact</a> --}}
                            </div>
                        @endif
                    </div>

                    {{-- News Section --}}
                    <div class="section-card">
                        <div class="section-header">
                            <h3 class="section-title">Breaking News</h3>
                            <div class="section-actions">
                                @if ($totalNews > 0)
                                    <a href="{{ route('news.news') }}" class="view-all-link">View All</a>
                                @endif
                            </div>
                        </div>
                        @if ($news->count() > 0)
                            <div class="news-grid">
                                @foreach ($news as $newsItem)
                                    <div class="news-item">
                                        @if ($newsItem->featured_image)
                                            <div class="news-image"
                                                style="background-image: url('{{ asset('storage/' . $newsItem->featured_image) }}')">
                                            </div>
                                        @else
                                            <div class="news-image"
                                                style="background-image: url('{{ asset('images/default-news.jpg') }}')">
                                            </div>
                                        @endif
                                        <div class="news-content">
                                            <span class="news-badge">
                                                <span class="badge-dot-small"></span>
                                                Breaking
                                            </span>
                                            <h4 class="news-title">{{ Str::limit($newsItem->title, 60) }}</h4>
                                            <p class="news-excerpt">
                                                {{ Str::limit($newsItem->short_description ?? $newsItem->content, 80) }}
                                            </p>
                                            <div class="news-meta">
                                                <span class="news-date">
                                                    <svg width="14" height="14" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2">
                                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                                            ry="2" />
                                                        <line x1="16" y1="2" x2="16"
                                                            y2="6" />
                                                        <line x1="8" y1="2" x2="8"
                                                            y2="6" />
                                                        <line x1="3" y1="10" x2="21"
                                                            y2="10" />
                                                    </svg>
                                                    {{ $newsItem->published_at ? $newsItem->published_at->format('d M, Y') : 'Recent' }}
                                                </span>
                                                <a href="{{ route('news.show', $newsItem->slug) }}" class="read-more">
                                                    Read More →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M4 4v16h16" />
                                        <polyline points="20 10 12 18 8 14" />
                                    </svg>
                                </div>
                                <p>No breaking news available.</p>
                                <a href="{{ route('news') }}" class="empty-action">View All News</a>
                            </div>
                        @endif
                    </div>



                </main>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        /* ===================================================== */
        /* =================   DASHBOARD HERO   ================== */
        /* ===================================================== */
        .dashboard-hero {
            background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 40%, #16213e 100%);
            padding: 40px 0 50px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .dashboard-hero-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
            position: relative;
            z-index: 2;
        }

        .dashboard-hero-content {
            flex: 1;
        }

        .dashboard-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 12px;
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #2ecc71;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(0.8);
            }
        }

        .dashboard-title {
            font-size: 36px;
            font-weight: 800;
            margin: 0 0 8px;
            color: #fff;
        }

        .text-gold {
            color: #f39c12;
        }

        .dashboard-subtitle {
            font-size: 16px;
            opacity: 0.6;
            margin: 0;
            font-weight: 400;
        }

        .dashboard-hero-stats {
            display: flex;
            align-items: center;
            gap: 24px;
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 16px 24px;
        }

        .hero-stat {
            text-align: center;
        }

        .hero-stat .stat-number {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
        }

        .hero-stat .stat-label {
            display: block;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }

        .hero-stat-divider {
            width: 1px;
            height: 30px;
            background: rgba(255, 255, 255, 0.08);
        }

        .dashboard-shapes {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            overflow: hidden;
        }

        .dash-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.05;
        }

        .dash-shape-1 {
            top: -100px;
            right: -80px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, #e74c3c, transparent);
            animation: float 10s ease-in-out infinite;
        }

        .dash-shape-2 {
            bottom: -120px;
            left: -60px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, #f39c12, transparent);
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-30px) scale(1.05);
            }
        }

        /* ===================================================== */
        /* =================   DASHBOARD SECTION   =============== */
        /* ===================================================== */
        .dashboard-section {
            padding: 40px 0 70px;
            background: #f8f9fa;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
        }

        /* ===================================================== */
        /* =================   SIDEBAR   ======================== */
        /* ===================================================== */
        .dashboard-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px 20px 24px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .profile-avatar {
            position: relative;
            width: 72px;
            height: 72px;
            margin: 0 auto 14px;
        }

        .avatar-text {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .avatar-status {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .avatar-status.online {
            background: #2ecc71;
        }

        .avatar-status.offline {
            background: #e74c3c;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0 0 4px;
        }

        .profile-email {
            font-size: 13px;
            color: #888;
            margin: 0 0 12px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.active {
            background: #f0fdf4;
            color: #1e8449;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #b45309;
        }

        /* Profile Details */
        .profile-details-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .details-title {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0 0 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f0f0;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 20px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .detail-label {
            font-size: 11px;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .detail-value {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            background: #fff;
            border-radius: 16px;
            padding: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .sidebar-nav a {
            color: rgb(6 6 6 / 85%);
        }

        .sidebar-nav a.active {
            background: rgb(86 83 64 / 12%);
            color: #099716;
            border-left-color: #3c9d6a;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 10px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.25s ease;
            position: relative;
        }

        .sidebar-nav-item:hover {
            background: #f8f9fa;
            color: #1a1a2e;
        }

        .sidebar-nav-item.active {
            background: rgba(231, 76, 60, 0.06);
            color: #e74c3c;
            font-weight: 600;
        }

        .sidebar-nav-item.active svg {
            stroke: #e74c3c;
        }

        .sidebar-nav-item svg {
            flex-shrink: 0;
            stroke: #999;
            transition: stroke 0.25s ease;
        }

        .sidebar-nav-item:hover svg {
            stroke: #1a1a2e;
        }

        .sidebar-nav-item.active svg {
            stroke: #e74c3c;
        }

        .sidebar-nav-item .nav-badge {
            margin-left: auto;
            background: #e74c3c;
            color: #fff;
            font-size: 11px;
            padding: 2px 10px;
            border-radius: 50px;
            font-weight: 700;
        }

        .sidebar-nav-item.logout {
            margin-top: 4px;
            border-top: 1px solid #f0f0f0;
            border-radius: 0;
            color: #e74c3c;
        }

        .sidebar-nav-item.logout:hover {
            background: #fef2f2;
            color: #c0392b;
        }

        .sidebar-nav-item.logout:hover svg {
            stroke: #c0392b;
        }

        /* ===================================================== */
        /* =================   MAIN CONTENT   =================== */
        /* ===================================================== */
        .dashboard-main {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-card-icon.blue {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .stat-card-icon.green {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }

        .stat-card-icon.orange {
            background: rgba(243, 156, 18, 0.1);
            color: #f39c12;
        }

        .stat-card-icon.purple {
            background: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
        }

        .stat-card-info {
            flex: 1;
        }

        .stat-card-number {
            display: block;
            font-size: 24px;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.2;
        }

        .stat-card-label {
            display: block;
            font-size: 13px;
            color: #888;
            font-weight: 500;
        }

        /* Section Cards */
        .section-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0;
        }

        .section-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .view-all {
            color: #e74c3c;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .view-all:hover {
            color: #c0392b;
            text-decoration: underline;
        }

        .view-all-link {
            color: #3498db;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .view-all-link:hover {
            color: #2980b9;
            font-weight: 600;
            text-decoration: underline;
        }

        /* List Items */
        .list-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .list-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .item-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .item-icon.product {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .item-icon.contact {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }

        .item-content {
            flex: 1;
        }

        .item-title {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a2e;
            margin: 0 0 2px;
        }

        .item-meta {
            font-size: 12px;
            color: #aaa;
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .item-status {
            font-size: 12px;
            font-weight: 600;
            padding: 3px 12px;
            border-radius: 50px;
        }

        .item-status.success {
            background: #f0fdf4;
            color: #1e8449;
        }

        .item-status.pending {
            background: #fef3c7;
            color: #b45309;
        }

        .item-status.failed {
            background: #fef2f2;
            color: #dc2626;
        }

        .item-status.info {
            background: #f0f9ff;
            color: #1a6ea8;
        }

        .item-tracking {
            font-size: 11px;
            color: #888;
            background: #f0f0f0;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        /* News Grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .news-item {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .news-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .news-image {
            height: 150px;
            background-size: cover;
            background-position: center;
            background-color: #f0f0f0;
        }

        .news-content {
            padding: 16px 18px 18px;
        }

        .news-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e74c3c;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 3px 12px;
            border-radius: 50px;
            margin-bottom: 8px;
        }

        .badge-dot-small {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #fff;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        .news-title {
            font-size: 15px;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0 0 8px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-excerpt {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
            margin: 0 0 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            color: #aaa;
        }

        .news-date {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .read-more {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .read-more:hover {
            color: #c0392b;
            text-decoration: underline;
        }



        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }

        .empty-icon {
            margin-bottom: 16px;
            color: #ccc;
        }

        .empty-state p {
            margin: 0 0 16px;
            font-size: 14px;
        }

        .empty-action {
            display: inline-block;
            padding: 8px 24px;
            background: #e74c3c;
            color: #fff;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .empty-action:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
            color: #fff;
        }

        /* ===================================================== */
        /* ==================   RESPONSIVE   ===================== */
        /* ===================================================== */
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: 280px 1fr;
                gap: 24px;
            }
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
            }

            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .details-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-hero-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .dashboard-hero-stats {
                width: 100%;
                justify-content: space-around;
                padding: 14px 16px;
            }

            .dashboard-title {
                font-size: 28px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-sidebar {
                grid-template-columns: 1fr;
            }

            .section-card {
                padding: 20px 18px;
            }

            .quick-actions {
                padding: 20px 18px;
            }

            .hero-stat-divider {
                display: none;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .list-item {
                flex-wrap: wrap;
            }

            .item-actions {
                margin-left: auto;
            }
        }

        @media (max-width: 480px) {
            .dashboard-hero {
                padding: 30px 0 35px;
            }

            .dashboard-title {
                font-size: 22px;
            }

            .dashboard-hero-stats {
                flex-wrap: wrap;
                gap: 12px;
            }

            .hero-stat {
                flex: 1;
                min-width: 80px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 14px 16px;
            }

            .stat-card-number {
                font-size: 18px;
            }

            .stat-card-icon {
                width: 40px;
                height: 40px;
            }

            .section-card {
                padding: 16px 14px;
            }

            .quick-actions {
                padding: 16px 14px;
            }

            .actions-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .action-card {
                padding: 14px 12px;
            }

            .action-icon {
                width: 44px;
                height: 44px;
            }

            .action-label {
                font-size: 12px;
            }

            .news-image {
                height: 120px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
@endpush
