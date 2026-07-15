@extends('layouts.app')

@section('title', 'All News')
@section('meta_description',
    'Browse all news articles from Bharat Integrity Forum News - delivering every story with
    truth, impartiality, and trustworthiness.')

@section('content')
    <style>
        .news-page-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 60px 0 40px;
            margin-bottom: 40px;
            color: white;
        }

        .news-page-header h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .news-page-header p {
            font-size: 18px;
            opacity: 0.8;
            margin-bottom: 20px;
        }

        /* Filter Buttons Styles */
        .filter-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .filter-btn {
            padding: 10px 28px;
            border-radius: 30px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: transparent;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .filter-btn.active {
            background: white;
            color: #0f172a;
            border-color: white;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
        }

        .filter-btn .count {
            background: rgba(255, 255, 255, 0.2);
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .filter-btn.active .count {
            background: #e2e8f0;
            color: #0f172a;
        }

        .filter-btn.breaking:hover {
            border-color: #ef4444;
        }

        .filter-btn.breaking.active {
            background: #dc2626;
            border-color: #dc2626;
            color: white;
        }

        .filter-btn.trending:hover {
            border-color: #8b5cf6;
        }

        .filter-btn.trending.active {
            background: #7c3aed;
            border-color: #7c3aed;
            color: white;
        }

        .filter-btn.featured:hover {
            border-color: #f59e0b;
        }

        .filter-btn.featured.active {
            background: #d97706;
            border-color: #d97706;
            color: white;
        }

        .filter-btn.all:hover {
            border-color: #60a5fa;
        }

        .filter-btn.all.active {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
        }

        .filter-btn .badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .filter-btn.active .badge {
            background: rgba(255, 255, 255, 0.3);
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }

        .news-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .news-card .flags {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            gap: 4px;
            z-index: 2;
            flex-direction: column;
            align-items: flex-end;
        }

        .news-card .flag-pill {
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .flag-pill.breaking {
            background: #dc2626;
            color: white;
        }

        .flag-pill.featured {
            background: #d97706;
            color: white;
        }

        .flag-pill.trending {
            background: #7c3aed;
            color: white;
        }

        .news-thumb {
            position: relative;
            overflow: hidden;
            background: #f8fafc;
        }

        .news-thumb img {
            width: 100%;
            object-fit: cover;
        }

        .news-tag {
            position: absolute;
            left: 12px;
            background: rgba(15, 23, 42, 0.85);
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            z-index: 1;
            backdrop-filter: blur(4px);
        }

        .news-body {
            padding: 20px;
        }

        .news-date {
            font-size: 13px;
            color: #94a3b8;
            display: block;
            margin-bottom: 8px;
        }

        .news-body h4 {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 10px 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-body p {
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 15px 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-readmore {
            display: inline-block;
            padding: 8px 20px;
            color: #dc2626;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .news-readmore:hover {
            transform: translateY(-1px);
            font-weight: bold;
            color: #b91c1c;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state .icon {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            color: #475569;
            margin-bottom: 8px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-wrapper .pagination {
            display: flex;
            gap: 4px;
            list-style: none;
            padding: 0;
        }

        .pagination-wrapper .pagination .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: white;
            color: #1e293b;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination-wrapper .pagination .page-item .page-link:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .pagination-wrapper .pagination .page-item.active .page-link {
            background: #0f172a;
            border-color: #0f172a;
            color: white;
        }

        .pagination-wrapper .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media (max-width: 992px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .news-grid {
                grid-template-columns: 1fr;
            }

            .news-page-header h1 {
                font-size: 28px;
            }

            .filter-buttons {
                gap: 8px;
            }

            .filter-btn {
                padding: 8px 16px;
                font-size: 12px;
                flex: 1;
                justify-content: center;
            }
        }
    </style>

    <!-- Page Header -->
    <section class="news-page-header">
        <div class="container">
            <h1 style="color: white">📰 All News Articles</h1>
            <p>Stay informed with the latest stories from across the nation</p>

            <!-- Filter Buttons -->
            <div class="filter-buttons">
                <a href="{{ route('news.news', ['type' => 'all']) }}"
                    class="filter-btn all {{ $currentType == 'all' ? 'active' : '' }}">
                    📰 All News
                    <span class="badge">{{ $counts['all'] }}</span>
                </a>

                <a href="{{ route('news.news', ['type' => 'breaking']) }}"
                    class="filter-btn breaking {{ $currentType == 'breaking' ? 'active' : '' }}">
                    🔴 Breaking
                    <span class="badge">{{ $counts['breaking'] }}</span>
                </a>

                <a href="{{ route('news.news', ['type' => 'trending']) }}"
                    class="filter-btn trending {{ $currentType == 'trending' ? 'active' : '' }}">
                    📈 Trending
                    <span class="badge">{{ $counts['trending'] }}</span>
                </a>

                <a href="{{ route('news.news', ['type' => 'featured']) }}"
                    class="filter-btn featured {{ $currentType == 'featured' ? 'active' : '' }}">
                    ⭐ Featured
                    <span class="badge">{{ $counts['featured'] }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- News Grid -->
    <section>
        <div class="container">
            @if ($news->isEmpty())
                <div class="empty-state">
                    <div class="icon">📭</div>
                    <h3>No news articles found</h3>
                    <p>Check back later for updates.</p>
                </div>
            @else
                <div class="news-grid">
                    @foreach ($news as $item)
                        <article class="news-card">
                            <!-- Flags on card -->
                            @if ($item->is_breaking || $item->is_featured || $item->is_trending)
                                <div class="flags">
                                    @if ($item->is_breaking)
                                        <span class="flag-pill breaking">🔴 Breaking</span>
                                    @endif
                                    @if ($item->is_featured)
                                        <span class="flag-pill featured">⭐ Featured</span>
                                    @endif
                                    @if ($item->is_trending)
                                        <span class="flag-pill trending">📈 Trending</span>
                                    @endif
                                </div>
                            @endif

                            <div class="news-thumb">
                                @if ($item->featured_image)
                                    <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}">
                                @else
                                    <div
                                        style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #94a3b8; font-size: 14px;">
                                        No Image
                                    </div>
                                @endif
                                <span class="news-tag">{{ $item->category->name ?? 'General' }}</span>
                            </div>
                            <div class="news-body">
                                <span class="news-date">
                                    {{ $item->published_at ? $item->published_at->format('M d, Y') : 'Date not set' }}
                                    @if ($item->views)
                                        • 👁️ {{ $item->views }} views
                                    @endif
                                </span>
                                <h4>{{ $item->title }}</h4>
                                <p>{{ Str::limit($item->short_description ?? $item->content, 120) }}</p>
                                <a href="{{ route('news.show', $item->id) }}" class="news-readmore">Read Full Story </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $news->appends(['type' => $currentType])->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>
@endsection
