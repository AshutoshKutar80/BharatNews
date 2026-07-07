@extends('layouts.app')

@section('title', 'Refund Policy')
@section('meta_description', 'Read the Refund Policy of Bharat Integrity Forum News for any paid services offered on our platform.')

@section('content')

{{-- ================= PAGE HERO ================= --}}
<section class="hero" style="padding:60px 0 70px;">
    <div class="container" style="text-align:center;">
        <span class="eyebrow">Refund Policy</span>
        <h1 style="max-width:720px;margin:0 auto;">Fair terms for <span>every payment</span></h1>
        <p class="lead" style="margin:16px auto 0;">
            This policy explains how refunds are handled for any paid services offered
            by Bharat Integrity Forum News.
        </p>
    </div>
</section>

{{-- ================= INTRO ================= --}}
<section class="bg-white-alt">
    <div class="container split">
        <div class="art reveal">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Bharat Integrity Forum News">
        </div>
        <div class="about-block reveal delay-1">
            <span class="eyebrow" style="background:rgba(11,31,77,.06); border-color:rgba(11,31,77,.12); color:var(--navy);">Our Commitment</span>
            <h2>Transparent handling of payments and refunds</h2>
            <p>
                We aim to be transparent about our refund process for any paid
                subscriptions, memberships, or services purchased through our
                platform.
            </p>
            <ul class="check-list">
                <li><span class="tick">✓</span> Clear eligibility criteria for refund requests</li>
                <li><span class="tick">✓</span> Simple process to raise a refund request</li>
                <li><span class="tick">✓</span> Timely processing once a request is approved</li>
            </ul>
        </div>
    </div>
</section>

{{-- ================= POLICY DETAILS ================= --}}
<section>
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">How It Works</span>
            <h2>Our refund process</h2>
            <p>Here is what you should know before requesting a refund.</p>
        </div>
        <div class="grid-3">
            <div class="value-card reveal">
                <div class="glyph">🗓️</div>
                <h4>Eligibility Window</h4>
                <p>Refund requests must be raised within the specified period from the date of purchase to be considered valid.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">📝</div>
                <h4>How to Request</h4>
                <p>Send us your order details and reason for the refund through our contact page or support email.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">🔍</div>
                <h4>Review Process</h4>
                <p>Every request is reviewed individually, and we may reach out for additional information if required.</p>
            </div>
            <div class="value-card reveal">
                <div class="glyph">💳</div>
                <h4>Refund Method</h4>
                <p>Approved refunds are credited back to the original payment method used at the time of purchase.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">⏳</div>
                <h4>Processing Time</h4>
                <p>Once approved, refunds are typically processed within a reasonable number of working days.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">🚫</div>
                <h4>Non-Refundable Cases</h4>
                <p>Certain services, once delivered or used, may not be eligible for a refund as noted at the time of purchase.</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= CTA ================= --}}
<section class="bg-navy">
    <div class="container split">
        <div class="reveal">
            <span class="eyebrow" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.18); color:var(--gold);">Need a Refund?</span>
            <h2>Reach out to our support team</h2>
            <p style="color:rgba(255,255,255,.75);">
                If you believe you are eligible for a refund, contact us with your
                order details and we will guide you through the process.
            </p>
            <div class="hero-actions" style="margin-top:22px;">
                <a href="{{ url('/contact') }}" class="btn btn-primary">Contact Us</a>
            </div>
        </div>
        <div class="grid-2 reveal delay-1">
            <div class="cat-card">
                <div class="icon">💬</div>
                <h4>Dedicated Support</h4>
                <p>We're here to help with your request</p>
            </div>
            <div class="cat-card">
                <div class="icon">✅</div>
                <h4>Fair Review</h4>
                <p>Every case considered carefully</p>
            </div>
        </div>
    </div>
</section>

@endsection
