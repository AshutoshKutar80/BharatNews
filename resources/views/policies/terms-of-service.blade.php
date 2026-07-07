@extends('layouts.app')

@section('title', 'Terms of Service')
@section('meta_description', 'Read the Terms of Service for using the Bharat Integrity Forum News website and its content.')

@section('content')

{{-- ================= PAGE HERO ================= --}}
<section class="hero" style="padding:60px 0 70px;">
    <div class="container" style="text-align:center;">
        <span class="eyebrow">Terms of Service</span>
        <h1 style="max-width:720px;margin:0 auto;">The terms that <span>govern your use</span></h1>
        <p class="lead" style="margin:16px auto 0;">
            Please read these terms carefully before using the Bharat Integrity Forum
            News website. By accessing our site, you agree to these terms.
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
            <span class="eyebrow" style="background:rgba(11,31,77,.06); border-color:rgba(11,31,77,.12); color:var(--navy);">Agreement</span>
            <h2>Using our website responsibly</h2>
            <p>
                These Terms of Service form a binding agreement between you and
                Bharat Integrity Forum News. They explain what you can and cannot do
                while using our platform.
            </p>
            <ul class="check-list">
                <li><span class="tick">✓</span> Content is for informational use only</li>
                <li><span class="tick">✓</span> Unauthorised reproduction of our content is not allowed</li>
                <li><span class="tick">✓</span> Continued use of the site means acceptance of updated terms</li>
            </ul>
        </div>
    </div>
</section>

{{-- ================= TERMS DETAILS ================= --}}
<section>
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">The Fine Print</span>
            <h2>Key terms you should know</h2>
            <p>A summary of the main points covered in our full terms.</p>
        </div>
        <div class="grid-3">
            <div class="value-card reveal">
                <div class="glyph">📄</div>
                <h4>Use of Content</h4>
                <p>Articles, images, and other material on this site are owned by Bharat Integrity Forum News and may not be copied without permission.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">👤</div>
                <h4>User Conduct</h4>
                <p>Users must not misuse the website, attempt unauthorised access, or post unlawful or harmful content.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">⚠️</div>
                <h4>Limitation of Liability</h4>
                <p>We strive for accuracy but are not liable for any loss arising from reliance on information published on this site.</p>
            </div>
            <div class="value-card reveal">
                <div class="glyph">🔗</div>
                <h4>External Links</h4>
                <p>Our site may link to third-party websites. We are not responsible for their content or practices.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">🛑</div>
                <h4>Termination</h4>
                <p>We reserve the right to suspend or restrict access to users who violate these terms.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">🔄</div>
                <h4>Changes to Terms</h4>
                <p>These terms may be revised from time to time. Continued use of the site indicates your acceptance of changes.</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= CTA ================= --}}
<section class="bg-navy">
    <div class="container split">
        <div class="reveal">
            <span class="eyebrow" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.18); color:var(--gold);">Need Clarity?</span>
            <h2>Questions about our terms?</h2>
            <p style="color:rgba(255,255,255,.75);">
                If any part of these terms is unclear, feel free to reach out to our
                team before continuing to use the website.
            </p>
            <div class="hero-actions" style="margin-top:22px;">
                <a href="{{ url('/contact') }}" class="btn btn-primary">Contact Us</a>
            </div>
        </div>
        <div class="grid-2 reveal delay-1">
            <div class="cat-card">
                <div class="icon">📜</div>
                <h4>Fair Usage</h4>
                <p>Clear rules for everyone</p>
            </div>
            <div class="cat-card">
                <div class="icon">🛡️</div>
                <h4>Protected Content</h4>
                <p>Respecting original work</p>
            </div>
        </div>
    </div>
</section>

@endsection
