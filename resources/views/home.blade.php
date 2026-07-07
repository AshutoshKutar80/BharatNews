@extends('layouts.app')

@section('title', 'Home')
@section('meta_description', 'Official website of Bharat Integrity Forum News - delivering every story with truth, impartiality, and trustworthiness.')

@section('content')

{{-- ================= HERO ================= --}}
<section class="hero">
    <div class="container hero-grid">
        <div>
            <span class="eyebrow">🇮🇳 Truth • Impartial • Trustworthy</span>
            <h1>Every true story of the nation, <span>without fear, without bias</span></h1>
            <p class="lead">
                Bharat Integrity Forum News brings you every major story on politics,
                crime, sports, and society — with impartiality and trustworthiness
                at its core.
            </p>
            <div class="hero-actions">
                <a href="{{ url('/services') }}#reporter" class="btn btn-primary">Become a Reporter</a>
                <a href="{{ url('/about') }}" class="btn btn-outline" style="border-color:rgba(255,255,255,.4); color:#fff;">Learn About Us</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="globe-ring">
                <div class="ring"></div>
                <div class="ring ring2"></div>
                <div class="core">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Bharat Integrity Forum News Logo">
                </div>
                <div class="orbit-dot"></div>
            </div>
        </div>
    </div>
</section>

{{-- ================= CATEGORIES ================= --}}
<section class="bg-white-alt">
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">Categories</span>
            <h2>Pick the news that matters to you</h2>
            <p>Fresh, accurate, and trustworthy coverage on every subject.</p>
        </div>
        <div class="grid-4">
            <div class="cat-card reveal">
                <div class="icon">🏛️</div>
                <h4>Politics</h4>
                <p>National and state political developments</p>
            </div>
            <div class="cat-card reveal delay-1">
                <div class="icon">🚨</div>
                <h4>Crime</h4>
                <p>Honest reporting from the world of crime</p>
            </div>
            <div class="cat-card reveal delay-2">
                <div class="icon">🏆</div>
                <h4>Sports</h4>
                <p>Every big moment from the world of sport</p>
            </div>
            <div class="cat-card reveal delay-3">
                <div class="icon">🌐</div>
                <h4>International</h4>
                <p>Important stories from around the world</p>
            </div>
        </div>
    </div>
</section>

{{-- ================= LATEST NEWS ================= --}}
<section>
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">Latest News</span>
            <h2>Recent Reports</h2>
            <p>This is demo content — real stories can be added here easily.</p>
        </div>
        <div class="grid-3">
            @php
                $demo = [
                    ['tag' => 'Politics', 'title' => 'Key discussion expected in today\'s parliament session', 'date' => 'July 07, 2026'],
                    ['tag' => 'Sports', 'title' => 'Indian team creates new history', 'date' => 'July 06, 2026'],
                    ['tag' => 'Society', 'title' => 'New initiative for rural education', 'date' => 'July 05, 2026'],
                ];
            @endphp
            @foreach ($demo as $i => $item)
                <article class="news-card reveal delay-{{ $i }}">
                    <div class="news-thumb">
                        <span class="news-tag">{{ $item['tag'] }}</span>
                        <span>News Thumbnail</span>
                    </div>
                    <div class="news-body">
                        <span class="news-date">{{ $item['date'] }}</span>
                        <h4>{{ $item['title'] }}</h4>
                        <p>A short summary of the story will appear here so readers can grasp the key points instantly.</p>
                        <a href="#" class="news-readmore">Read Full Story</a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ================= REPORTER CTA ================= --}}
<section class="bg-white-alt">
    <div class="container">
        <div class="cta-banner reveal">
            <div>
                <h3>Become a reporter, become the voice of your city</h3>
                <p>Join Bharat Integrity Forum News and bring your region's stories to the whole nation.</p>
            </div>
            <a href="{{ url('/services') }}#reporter" class="btn btn-gold">Apply Now</a>
        </div>
    </div>
</section>

{{-- ================= STATS ================= --}}
<section class="bg-navy">
    <div class="container">
        <div class="section-head reveal">
            <span class="eyebrow">Our Impact</span>
            <h2>Numbers that reflect our reach</h2>
        </div>
        <div class="stats-strip reveal">
            <div class="stat-item">
                <div class="num" data-count="50" data-suffix="+">0</div>
                <div class="lbl">Cities Covered</div>
            </div>
            <div class="stat-item">
                <div class="num" data-count="200" data-suffix="+">0</div>
                <div class="lbl">Active Reporters</div>
            </div>
            <div class="stat-item">
                <div class="num" data-count="10" data-suffix="K+">0</div>
                <div class="lbl">Daily Readers</div>
            </div>
            <div class="stat-item">
                <div class="num" data-count="3" data-suffix="+">0</div>
                <div class="lbl">Years of Experience</div>
            </div>
        </div>
    </div>
</section>

@endsection
