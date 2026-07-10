@extends('layouts.app')

@section('title', 'My Profile - Bharat Integrity Forum News')
@section('meta_description', 'View your Bharat Integrity Forum News profile details.')

@section('content')

    <section class="up-hero">
        <div class="container">
            <span class="up-badge"><span class="up-dot"></span> My Account</span>
            <h1 class="up-title">My Profile</h1>
            <p class="up-subtitle">This information is read-only. To update any detail, please contact support.</p>
        </div>
        <div class="up-shapes">
            <div class="up-shape up-shape-1"></div>
            <div class="up-shape up-shape-2"></div>
        </div>
    </section>

    <section class="up-section">
        <div class="container">
            @include('user.partials.subnav', ['active' => 'profile'])

            <div class="up-card">
                <div class="up-profile-head">
                    @php
                        $name = $user->name ?? 'User';
                        $initial = strtoupper(substr($name, 0, 1));
                    @endphp
                    <div class="up-avatar">{{ $initial }}</div>
                    <div>
                        <h2 class="up-profile-name">{{ $user->name ?? '-' }}</h2>
                        <span class="up-status-badge {{ $user->status === 'active' ? 'active' : 'pending' }}">
                            {{ ucfirst($user->status ?? 'pending') }}
                        </span>
                    </div>
                </div>

                <div class="up-info-grid">
                    <div class="up-info-item">
                        <span class="up-info-label">Email</span>
                        <span class="up-info-value">{{ $user->email ?? '-' }}</span>
                    </div>
                    <div class="up-info-item">
                        <span class="up-info-label">Mobile</span>
                        <span class="up-info-value">{{ $user->mobile ?? '-' }}</span>
                    </div>
                    <div class="up-info-item">
                        <span class="up-info-label">State</span>
                        <span class="up-info-value">{{ $user->state ?? '-' }}</span>
                    </div>
                    <div class="up-info-item">
                        <span class="up-info-label">District</span>
                        <span class="up-info-value">{{ $user->district ?? '-' }}</span>
                    </div>
                    <div class="up-info-item">
                        <span class="up-info-label">Tehsil</span>
                        <span class="up-info-value">{{ $user->tehsil ?? '-' }}</span>
                    </div>
                    <div class="up-info-item">
                        <span class="up-info-label">City</span>
                        <span class="up-info-value">{{ $user->city ?? '-' }}</span>
                    </div>
                    <div class="up-info-item">
                        <span class="up-info-label">Pincode</span>
                        <span class="up-info-value">{{ $user->pincode ?? '-' }}</span>
                    </div>
                    @if (!empty($user->tracking))
                        <div class="up-info-item">
                            <span class="up-info-label">Tracking ID</span>
                            <span class="up-info-value">{{ $user->tracking }}</span>
                        </div>
                    @endif
                    <div class="up-info-item">
                        <span class="up-info-label">Member Since</span>
                        <span class="up-info-value">{{ optional($user->created_at)->format('d M, Y') ?? '-' }}</span>
                    </div>
                </div>

                <p class="up-note">Need to change something above? Please raise a support ticket rather than editing
                    this page directly.</p>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    @include('user.partials.styles')
@endpush
