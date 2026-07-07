@extends('layouts.app')

@section('title', 'Privacy Policy')
@section('meta_description', 'Read the Privacy Policy of Bharat Integrity Forum News to understand how we collect, use, and protect your information.')

@section('content')

{{-- ================= PAGE HERO ================= --}}
<section class="hero" style="padding:60px 0 70px;">
    <div class="container" style="text-align:center;">
        <span class="eyebrow">Privacy Policy</span>
        <h1 style="max-width:720px;margin:0 auto;">Your privacy, <span>our responsibility</span></h1>
        <p class="lead" style="margin:16px auto 0;">
            Bharat Integrity Forum News respects your privacy and is committed to
            protecting the personal information you share with us.
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
            <span class="eyebrow" style="background:rgba(11,31,77,.06); border-color:rgba(11,31,77,.12); color:var(--navy);">Overview</span>
            <h2>How we handle your information</h2>
            <p>
                This Privacy Policy explains what information we collect when you visit
                our website, why we collect it, and how we keep it safe. By using our
                website, you agree to the practices described below.
            </p>
            <ul class="check-list">
                <li><span class="tick">✓</span> Clear disclosure of data we collect</li>
                <li><span class="tick">✓</span> No selling of personal information to third parties</li>
                <li><span class="tick">✓</span> Reasonable security measures to protect your data</li>
            </ul>
        </div>
    </div>
</section>

{{-- ================= POLICY DETAILS ================= --}}
<section>
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">The Details</span>
            <h2>What our policy covers</h2>
            <p>Every section below explains a specific part of how we manage your data.</p>
        </div>
        <div class="grid-3">
            <div class="value-card reveal">
                <div class="glyph">📥</div>
                <h4>Information We Collect</h4>
                <p>Name, email address, contact details, and browsing data such as IP address and cookies when you visit our site or contact us.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">🎯</div>
                <h4>How We Use It</h4>
                <p>To improve our content, respond to queries, send updates you have subscribed to, and maintain the security of our platform.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">🔒</div>
                <h4>Data Protection</h4>
                <p>We use reasonable technical and organisational measures to safeguard your information from unauthorised access or misuse.</p>
            </div>
            <div class="value-card reveal">
                <div class="glyph">🍪</div>
                <h4>Cookies</h4>
                <p>Our site may use cookies to enhance your browsing experience. You can disable cookies through your browser settings at any time.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">🔗</div>
                <h4>Third-Party Links</h4>
                <p>Our website may contain links to external sites. We are not responsible for the privacy practices of those third-party websites.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">✏️</div>
                <h4>Policy Updates</h4>
                <p>This policy may be updated periodically. Any changes will be posted on this page with a revised effective date.</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= CONTACT CTA ================= --}}
<section class="bg-navy">
    <div class="container split">
        <div class="reveal">
            <span class="eyebrow" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.18); color:var(--gold);">Questions?</span>
            <h2>Reach out about your data anytime</h2>
            <p style="color:rgba(255,255,255,.75);">
                If you have any questions or concerns regarding this Privacy Policy or
                how your information is handled, our team is here to help.
            </p>
            <div class="hero-actions" style="margin-top:22px;">
                <a href="{{ url('/contact') }}" class="btn btn-primary">Contact Us</a>
            </div>
        </div>
        <div class="grid-2 reveal delay-1">
            <div class="cat-card">
                <div class="icon">📧</div>
                <h4>Email Support</h4>
                <p>Write to us for any privacy request</p>
            </div>
            <div class="cat-card">
                <div class="icon">🕒</div>
                <h4>Quick Response</h4>
                <p>We aim to reply within a few working days</p>
            </div>
        </div>
    </div>
</section>

@endsection
