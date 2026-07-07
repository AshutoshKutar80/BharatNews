@extends('layouts.app')

@section('title', 'Our Rules')
@section('meta_description', 'Read the community and editorial rules that guide Bharat Integrity Forum News and everyone who contributes to it.')

@section('content')

{{-- ================= PAGE HERO ================= --}}
<section class="hero" style="padding:60px 0 70px;">
    <div class="container" style="text-align:center;">
        <span class="eyebrow">Our Rules</span>
        <h1 style="max-width:720px;margin:0 auto;">Guidelines that keep us <span>truthful and fair</span></h1>
        <p class="lead" style="margin:16px auto 0;">
            These rules apply to readers, reporters, and contributors, and form the
            foundation of everything we publish at Bharat Integrity Forum News.
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
            <span class="eyebrow" style="background:rgba(11,31,77,.06); border-color:rgba(11,31,77,.12); color:var(--navy);">Why Rules Matter</span>
            <h2>Setting the standard for responsible journalism</h2>
            <p>
                To maintain trust with our readers, everyone associated with Bharat
                Integrity Forum News — reporters, editors, and contributors — must
                follow a shared code of conduct.
            </p>
            <ul class="check-list">
                <li><span class="tick">✓</span> Every submission must be fact-checked before publishing</li>
                <li><span class="tick">✓</span> No content that spreads hate, rumours, or false information</li>
                <li><span class="tick">✓</span> Respectful conduct towards readers and fellow contributors</li>
            </ul>
        </div>
    </div>
</section>

{{-- ================= RULE CATEGORIES ================= --}}
<section>
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">Code of Conduct</span>
            <h2>Truth • Impartial • Trustworthy</h2>
            <p>Our rules are built around the same three values that define our reporting.</p>
        </div>
        <div class="grid-3">
            <div class="value-card reveal">
                <div class="glyph">✅</div>
                <h4>Accuracy First</h4>
                <p>All news must be verified with credible sources before it is published on our platform.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">🚫</div>
                <h4>No Misinformation</h4>
                <p>Content that is misleading, defamatory, or intended to incite unrest is strictly prohibited.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">🙏</div>
                <h4>Respectful Conduct</h4>
                <p>Reporters and readers must maintain courtesy and avoid personal attacks or abusive language.</p>
            </div>
            <div class="value-card reveal">
                <div class="glyph">⚖️</div>
                <h4>Neutrality</h4>
                <p>We do not support or promote any political party, religion, or organisation in our coverage.</p>
            </div>
            <div class="value-card reveal delay-1">
                <div class="glyph">🖋️</div>
                <h4>Original Content</h4>
                <p>Plagiarised or copied content from other sources without credit is not accepted.</p>
            </div>
            <div class="value-card reveal delay-2">
                <div class="glyph">📢</div>
                <h4>Accountability</h4>
                <p>Any error found in our reporting will be corrected transparently and promptly.</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= CTA ================= --}}
<section class="bg-navy">
    <div class="container split">
        <div class="reveal">
            <span class="eyebrow" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.18); color:var(--gold);">Get Involved</span>
            <h2>Want to report or contribute with us?</h2>
            <p style="color:rgba(255,255,255,.75);">
                Anyone who wishes to become a reporter or contributor must agree to
                follow these rules at all times.
            </p>
            <div class="hero-actions" style="margin-top:22px;">
                <a href="{{ url('/services') }}" class="btn btn-primary">View Our Services</a>
            </div>
        </div>
        <div class="grid-2 reveal delay-1">
            <div class="cat-card">
                <div class="icon">📰</div>
                <h4>Editorial Standards</h4>
                <p>Every story goes through review</p>
            </div>
            <div class="cat-card">
                <div class="icon">🤝</div>
                <h4>Community Trust</h4>
                <p>Built on shared responsibility</p>
            </div>
        </div>
    </div>
</section>

@endsection
