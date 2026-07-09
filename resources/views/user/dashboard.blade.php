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
                    <h1 class="dashboard-title">Hello, <span class="text-gold">{{ Auth::user()->name ?? 'User' }}</span> 👋
                    </h1>
                    <p class="dashboard-subtitle">Here's what's happening with your account today.</p>
                </div>
                <div class="dashboard-hero-stats">
                    <div class="hero-stat">
                        <span class="stat-number">{{ Auth::user()->created_at->diffForHumans() ?? 'New' }}</span>
                        <span class="stat-label">Member Since</span>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat">
                        <span class="stat-number">{{ Auth::user()->status ?? 'Active' }}</span>
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
                    <div class="profile-card">
                        <div class="profile-avatar">
                            @php
                                $name = Auth::user()->name ?? 'User';
                                $initial = strtoupper(substr($name, 0, 1));
                            @endphp
                            <span class="avatar-text">{{ $initial }}</span>
                            <span
                                class="avatar-status {{ Auth::user()->status === 'active' ? 'online' : 'offline' }}"></span>
                        </div>
                        <h3 class="profile-name">{{ Auth::user()->name ?? 'User' }}</h3>
                        <p class="profile-email">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                        <div class="profile-status">
                            <span class="status-badge {{ Auth::user()->status === 'active' ? 'active' : 'pending' }}">
                                {{ Auth::user()->status ?? 'Pending' }}
                            </span>
                        </div>
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
                                <span class="stat-card-number">0</span>
                                <span class="stat-card-label">Total Posts</span>
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
                                <span class="stat-card-number">0</span>
                                <span class="stat-card-label">Followers</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon orange">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M4 4v16h16" />
                                    <polyline points="20 10 12 18 8 14" />
                                </svg>
                            </div>
                            <div class="stat-card-info">
                                <span class="stat-card-number">0</span>
                                <span class="stat-card-label">Reports</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-icon purple">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                    <path d="M2 17l10 5 10-5" />
                                    <path d="M2 12l10 5 10-5" />
                                </svg>
                            </div>
                            <div class="stat-card-info">
                                <span class="stat-card-number">0</span>
                                <span class="stat-card-label">Submissions</span>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Activity --}}
                    <div class="recent-activity">
                        <div class="section-header">
                            <h3 class="section-title">Recent Activity</h3>
                            <a href="#" class="view-all">View All →</a>
                        </div>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon blue">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-text">Welcome to Bharat Integrity Forum News! 🎉</p>
                                    <span class="activity-time">Just now</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon green">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-text">Your account is now <strong>active</strong> ✅</p>
                                    <span
                                        class="activity-time">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M, Y') : 'Recent' }}</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon orange">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M4 4v16h16" />
                                        <polyline points="20 10 12 18 8 14" />
                                    </svg>
                                </div>
                                <div class="activity-content">
                                    <p class="activity-text">Start your first news submission today! 📰</p>
                                    <span class="activity-time">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="quick-actions">
                        <div class="section-header">
                            <h3 class="section-title">Quick Actions</h3>
                        </div>
                        <div class="actions-grid">
                            <a href="#" class="action-card">
                                <div class="action-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <span class="action-label">New Post</span>
                            </a>
                            <a href="#" class="action-card">
                                <div class="action-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="action-label">Edit Profile</span>
                            </a>
                            <a href="#" class="action-card">
                                <div class="action-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M4 4v16h16" />
                                        <polyline points="20 10 12 18 8 14" />
                                    </svg>
                                </div>
                                <span class="action-label">View Reports</span>
                            </a>
                            <a href="#" class="action-card">
                                <div class="action-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                                    </svg>
                                </div>
                                <span class="action-label">Submit News</span>
                            </a>
                        </div>
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
            grid-template-columns: 280px 1fr;
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

        /* Sidebar Navigation */
        .sidebar-nav {
            border-radius: 16px;
            padding: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            gap: 2px;
            background: #0e0e22;
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

        /* Recent Activity */
        .recent-activity {
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

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .activity-icon.blue {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .activity-icon.green {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }

        .activity-icon.orange {
            background: rgba(243, 156, 18, 0.1);
            color: #f39c12;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 14px;
            color: #333;
            margin: 0 0 4px;
            line-height: 1.5;
        }

        .activity-text strong {
            color: #1a1a2e;
        }

        .activity-time {
            font-size: 12px;
            color: #aaa;
        }

        /* Quick Actions */
        .quick-actions {
            background: #fff;
            border-radius: 16px;
            padding: 24px 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .action-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 20px 16px;
            border-radius: 12px;
            background: #f8f9fa;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .action-card:hover {
            background: #fff;
            border-color: #e74c3c;
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.1);
        }

        .action-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: rgba(231, 76, 60, 0.06);
            color: #e74c3c;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .action-card:hover .action-icon {
            background: rgba(231, 76, 60, 0.12);
            transform: scale(1.05);
        }

        .action-label {
            font-size: 13px;
            font-weight: 600;
            color: #555;
            text-align: center;
        }

        .action-card:hover .action-label {
            color: #e74c3c;
        }

        /* ===================================================== */
        /* ==================   RESPONSIVE   ===================== */
        /* ===================================================== */
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
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

            .recent-activity,
            .quick-actions {
                padding: 20px 18px;
            }

            .hero-stat-divider {
                display: none;
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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
    </style>
@endpush
