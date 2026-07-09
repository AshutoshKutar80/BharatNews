@extends('layouts.app')

@section('title', 'My Products - Bharat Integrity Forum News')
@section('meta_description', 'View the products and services you have purchased from Bharat Integrity Forum News.')

@section('content')

    <section class="up-hero">
        <div class="container">
            <span class="up-badge"><span class="up-dot"></span> My Account</span>
            <h1 class="up-title">My Products</h1>
            <p class="up-subtitle">Everything you've purchased, along with approval status.</p>
        </div>
        <div class="up-shapes">
            <div class="up-shape up-shape-1"></div>
            <div class="up-shape up-shape-2"></div>
        </div>
    </section>

    <section class="up-section">
        <div class="container">
            @include('user.partials.subnav', ['active' => 'products'])

            @if ($products->isEmpty())
                <div class="up-card">
                    <div class="up-empty">
                        <p>You haven't purchased any products yet.</p>
                    </div>
                </div>
            @else
                <div class="up-products-grid">
                    @foreach ($products as $product)
                        <div class="up-product-card">
                            <div class="up-product-head">
                                <h3>{{ $product->product_name ?? ($product->details['name'] ?? $product->product_type) }}
                                </h3>
                                @php
                                    $status = strtolower($product->payment_status ?? '');
                                    $cls =
                                        $status === 'success'
                                            ? 'success'
                                            : (in_array($status, ['failed', 'expired'])
                                                ? 'danger'
                                                : 'pending');
                                @endphp
                                <span
                                    class="up-pill up-pill-{{ $cls }}">{{ ucfirst($product->payment_status ?? '-') }}</span>
                            </div>

                            @if (!empty($product->details['description']))
                                <p class="up-product-desc">{{ $product->details['description'] }}</p>
                            @endif

                            <div class="up-product-meta">
                                <div>
                                    <span class="up-info-label">Amount</span>
                                    <span class="up-info-value">₹{{ number_format((float) $product->amount, 2) }}</span>
                                </div>
                                <div>
                                    <span class="up-info-label">Tracking ID</span>
                                    <span class="up-info-value">{{ $product->tracking_id ?? '—' }}</span>
                                </div>
                                <div>
                                    <span class="up-info-label">Purchased On</span>
                                    <span
                                        class="up-info-value">{{ optional($product->purchased_at)->format('d M, Y') ?? '—' }}</span>
                                </div>
                                <div>
                                    <span class="up-info-label">Approval</span>
                                    <span class="up-info-value">
                                        @if ($product->is_approved)
                                            <span class="up-pill up-pill-success">Approved</span>
                                        @else
                                            <span class="up-pill up-pill-pending">Awaiting Approval</span>
                                        @endif
                                    </span>
                                </div>
                            </div>

                            @if (!empty($product->remark))
                                <p class="up-product-remark"><strong>Remark:</strong> {{ $product->remark }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection

@push('styles')
    @include('user.partials.styles')
@endpush
