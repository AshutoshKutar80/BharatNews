@extends('layouts.app')

@section('title', 'About Us')
@section('meta_description', 'Learn about the mission, vision, and values of Bharat Integrity Forum News.')

@section('content')

{{-- ================= PAGE HERO ================= --}}
<section class="hero" style="padding:60px 0 70px;">
    <div class="container" style="text-align:center;">
        <span class="eyebrow">About Us</span>
        <h1 style="max-width:720px;margin:0 auto;">Journalism built on truth, <span>for every voice</span></h1>
        <p class="lead" style="margin:16px auto 0;">
            Bharat Integrity Forum News is an independent platform that connects
            the nation through impartial and trustworthy reporting.
        </p>
    </div>
</section>

{{-- ================= MISSION / VISION ================= --}}
<section class="bg-white-alt">
    <div class="container split">
        <div class="art reveal">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Bharat Integrity Forum News">
        </div>
        <div class="about-block reveal delay-1">
            <span class="eyebrow" style="background:rgba(11,31,77,.06); border-color:rgba(11,31,77,.12); color:var(--navy);">Our Mission</span>
            <h2>Delivering true and accurate news to every citizen</h2>
            <p>
                Our goal is to practice journalism grounded in ground-level facts,
                free from bias — so readers can form their own informed opinions.
            </p>
            <ul class="check-list">
                <li><span class="tick">✓</span> Independent, fact-based reporting</li>
                <li><span class="tick">✓</span> Stories powered by a nationwide reporter network</li>
                <li><span class="tick">✓</span> Simple presentation, in the reader's own language</li>
            </ul>
        </div>
    </div>
</section>

{{-- ================= VALUES (matches tagline) ================= --}}
<section>
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">Our Values</span>
            <h2>Truth • Impartial • Trustworthy</h2>
            <p>These three words are the foundation of every story we publish.</p>
        </div>
        <div class="grid-3">
            <div class="value-card reveal">
                <div class="glyph">🕊️</div>
                <h4>Truth</h4>
                <p>We verify every story before publishing, so that only the truth reaches our readers.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">⚖️</div>
                <h4>Impartial</h4>
                <p>We report in a balanced way, without leaning toward any party, institution, or individual.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">🤝</div>
                <h4>Trustworthy</h4>
                <p>We earn our readers' trust every single day through transparency and accountability.</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= WHY CHOOSE US ================= --}}
<section class="bg-navy">
    <div class="container split">
        <div class="reveal">
            <span class="eyebrow" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.18); color:var(--gold);">Why Choose Us</span>
            <h2>A trustworthy news platform that becomes your voice</h2>
            <p style="color:rgba(255,255,255,.75);">
                Whether you're a reader or want to become a reporter, Bharat
                Integrity Forum News stands with you, with transparency at every step.
            </p>
            <div class="hero-actions" style="margin-top:22px;">
                <a href="{{ url('/services') }}" class="btn btn-primary">View Our Services</a>
            </div>
        </div>
        <div class="grid-2 reveal delay-1">
            <div class="cat-card">
                <div class="icon">📰</div>
                <h4>Fast Updates</h4>
                <p>Every big story, first</p>
            </div>
            <div class="cat-card">
                <div class="icon">🌏</div>
                <h4>Nationwide Network</h4>
                <p>Reporters connected across every state</p>
            </div>
            <div class="cat-card">
                <div class="icon">🔍</div>
                <h4>Fact-Checked</h4>
                <p>Every story verified</p>
            </div>
            <div class="cat-card">
                <div class="icon">💬</div>
                <h4>Reader Dialogue</h4>
                <p>Your opinion, respected</p>
            </div>
        </div>
    </div>
</section>

@endsection
