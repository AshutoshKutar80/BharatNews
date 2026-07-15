@extends('layouts.app')

@section('title', $news->title)
@section('meta_description', Str::limit($news->short_description ?? $news->content, 160))

@section('content')
    <style>
        .article-wrapper {
            padding: 40px 0 60px;
        }

        .article-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .breadcrumb {
            font-size: 14px;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .breadcrumb a {
            color: #0f172a;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .article-header {
            margin-bottom: 30px;
        }

        .article-header .category-tag {
            display: inline-block;
            background: #0f172a;
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            margin-bottom: 15px;
        }

        .article-header h1 {
            font-size: 36px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: 15px;
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 14px;
            color: #64748b;
            padding-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .article-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .article-featured-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 12px;
            margin: 20px 0 30px;
            border: 1px solid #e2e8f0;
        }

        .article-short-description {
            font-size: 18px;
            font-style: italic;
            color: #475569;
            padding: 16px 20px;
            background: #f8fafc;
            border-left: 4px solid #0f172a;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .article-content {
            font-size: 16px;
            line-height: 1.8;
            color: #1e293b;
        }

        .article-content p {
            margin-bottom: 20px;
        }

        .article-flags {
            display: flex;
            gap: 8px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .flag-pill {
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .flag-pill.breaking {
            background: #fee2e2;
            color: #b91c1c;
        }

        .flag-pill.featured {
            background: #fef3c7;
            color: #92400e;
        }

        .flag-pill.trending {
            background: #ede9fe;
            color: #6d28d9;
        }

        .article-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .tag-pill {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 13px;
        }

        .related-news {
            margin-top: 50px;
            padding-top: 40px;
            border-top: 2px solid #e2e8f0;
        }

        .related-news h3 {
            font-size: 24px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 20px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .related-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .related-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .related-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .related-card .related-body {
            padding: 12px 16px;
        }

        .related-card .related-body h5 {
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 5px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .related-card .related-body .related-date {
            font-size: 12px;
            color: #94a3b8;
        }

        .back-button {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 24px;
            background: #c8c9ca;
            color: #0f172a;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .back-button:hover {
            background: #e2e8f0;
        }

        @media (max-width: 768px) {
            .article-header h1 {
                font-size: 28px;
            }

            .article-meta {
                flex-direction: column;
                gap: 8px;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="article-wrapper">
        <div class="container">
            <div class="article-container">
                <!-- Breadcrumb -->
                {{-- <div class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a> /
                    <a href="{{ route('news.news') }}">News</a> /
                    <span>{{ $news->title }}</span>
                </div> --}}

                <!-- Article -->
                <article>
                    <div class="article-header">
                        <span class="category-tag">{{ $news->category->name ?? 'General' }}</span>
                        <h1>{{ $news->title }}</h1>

                        <div class="article-meta">
                            <span>✍️ By {{ $news->author->name ?? 'Unknown' }}</span>
                            <span>📅
                                {{ $news->published_at ? $news->published_at->format('M d, Y') : 'Date not set' }}</span>
                            @if ($news->source)
                                <span>📰 Source: {{ $news->source }}</span>
                            @endif
                            @if ($news->location)
                                <span>📍 {{ $news->location }}</span>
                            @endif
                            <span>👁️ {{ $news->views ?? 0 }} views</span>
                        </div>
                    </div>

                    <!-- Flags -->
                    @if ($news->is_breaking || $news->is_featured || $news->is_trending)
                        <div class="article-flags">
                            @if ($news->is_breaking)
                                <span class="flag-pill breaking">🔴 Breaking</span>
                            @endif
                            @if ($news->is_featured)
                                <span class="flag-pill featured">⭐ Featured</span>
                            @endif
                            @if ($news->is_trending)
                                <span class="flag-pill trending">📈 Trending</span>
                            @endif
                        </div>
                    @endif

                    <!-- Featured Image -->
                    @if ($news->featured_image)
                        <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}"
                            class="article-featured-image">
                    @endif

                    <!-- Short Description -->
                    @if ($news->short_description)
                        <div class="article-short-description">
                            {{ $news->short_description }}
                        </div>
                    @endif

                    <!-- Full Content -->
                    <div class="article-content">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <!-- Tags -->
                    @if ($news->tags)
                        <div class="article-tags">
                            @php
                                $tags = explode(',', $news->tags);
                            @endphp
                            @foreach ($tags as $tag)
                                <span class="tag-pill">#{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    @endif
                </article>

                <!-- Back Button -->
                <a href="{{ route('news.news') }}" class="back-button">← Back to All News</a>

                {{-- <a href="{{ route('home') }}" class="back-button" style="background: white">← Back to Home</a> --}}

                <!-- Related News -->
                @if ($relatedNews->isNotEmpty())
                    <div class="related-news">
                        <h3>Related Stories</h3>
                        <div class="related-grid">
                            @foreach ($relatedNews as $related)
                                <a href="{{ route('news.show', $related->id) }}" class="related-card">
                                    @if ($related->featured_image)
                                        <img src="{{ asset('storage/' . $related->featured_image) }}"
                                            alt="{{ $related->title }}">
                                    @else
                                        <div
                                            style="width: 100%; height: 120px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 12px;">
                                            No Image
                                        </div>
                                    @endif
                                    <div class="related-body">
                                        <h5>{{ $related->title }}</h5>
                                        <span
                                            class="related-date">{{ $related->published_at ? $related->published_at->format('M d, Y') : '' }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
