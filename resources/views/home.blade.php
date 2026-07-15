@extends('layouts.app')

@section('title', 'Home')
@section('meta_description',
    'Official website of Bharat Integrity Forum News - delivering every story with truth,
    impartiality, and trustworthiness.')

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
                    @auth
                        <a href="{{ url('/services') . '#reporter' }}" class="btn btn-primary">
                            Become a Reporter
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Become a Reporter
                        </a>
                    @endauth
                    <a href="{{ url('/about') }}" class="btn btn-outline"
                        style="border-color:rgba(255,255,255,.4); color:#fff;">Learn About Us</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="globe-ring">
                    <div class="ring"></div>
                    <div class="ring ring2"></div>
                    <div class="core">
                        <img src="{{ asset('images/logo2.png') }}" alt="Bharat Integrity Forum News Logo">
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
                <h2>Recent News</h2>
                <p>Stay updated with the latest stories from around the world.</p>
            </div>
            <div class="grid-3">
                @forelse($news as $index => $item)
                    <article class="news-card reveal delay-{{ $index }}">
                        <div class="news-thumb">
                            @if ($item->featured_image)
                                <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}"
                                    style="width: 100%;  object-fit: cover; border-radius: 8px;">
                            @else
                                <div
                                    style="width: 100%; height: 200px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; border-radius: 8px; color: #94a3b8;">
                                    No Image
                                </div>
                            @endif
                            <span class="news-tag">{{ $item->category->name ?? 'General' }}</span>
                        </div>
                        <div class="news-body">
                            <span
                                class="news-date">{{ $item->published_at ? $item->published_at->format('M d, Y') : 'Date not set' }}</span>
                            <h4>{{ $item->title }}</h4>
                            <p>{{ Str::limit($item->short_description ?? $item->content, 100) }}</p>
                            <div style="display: flex; gap: 10px; margin-top: 15px;">
                                <a href="{{ route('news.show', $item->id) }}" class="news-readmore">Read Full Story</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #94a3b8;">
                        <p>No news articles available yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- View All News Button -->
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('news.news') }}" class="btn-view-all"
                    style="display: inline-block; padding: 14px 40px; background: #0f172a; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                    View All News →
                </a>
            </div>
        </div>
    </section>




    {{-- ================= STATS ================= --}}
    <section class="bg-navy">
        <div class="container">
            <div class="section-head reveal">
                <span class="eyebrow" style="color:#fff">Our Impact</span>
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


    {{-- ================= REPORTER CTA ================= --}}
    <section class="bg-white-alt">
        <div class="container">
            <div class="cta-banner reveal">
                <div>
                    <h3>Become a reporter, become the voice of your city</h3>
                    <p>Join Bharat Integrity Forum News and bring your region's stories to the whole nation.</p>
                </div>
                <a href="{{ auth()->check() ? url('/services') . '#reporter' : route('register') }}" class="btn btn-gold">
                    {{ auth()->check() ? 'Buy Now' : 'Register Now' }}
                </a>
            </div>
        </div>
    </section>


@endsection
