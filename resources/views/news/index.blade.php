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

        .filter-btn .badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .filter-btn.active .badge {
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
            opacity: 0;
            animation: fadeInUp 0.5s ease forwards;
        }

        .news-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .news-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .news-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .news-card:nth-child(4) {
            animation-delay: 0.2s;
        }

        .news-card:nth-child(5) {
            animation-delay: 0.25s;
        }

        .news-card:nth-child(6) {
            animation-delay: 0.3s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            height: 220px;
        }

        .news-thumb img {
            width: 100%;
            height: 100%;
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

        .load-more-wrapper {
            text-align: center;
            margin: 40px 0;
        }

        .load-more-btn {
            padding: 14px 48px;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .load-more-btn:hover:not(:disabled) {
            background: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.25);
        }

        .load-more-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .load-more-btn .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .load-more-btn.loading .spinner {
            display: inline-block;
        }

        .load-more-btn.loading .btn-text {
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .no-more-news {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-size: 16px;
            display: none;
        }

        .no-more-news.show {
            display: block;
        }

        .loading-overlay {
            display: none;
            text-align: center;
            padding: 40px;
        }

        .loading-overlay.show {
            display: block;
        }

        .loading-overlay .spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #0f172a;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .count-display {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .count-display strong {
            color: #0f172a;
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

            .news-thumb {
                height: 180px;
            }

            .load-more-btn {
                width: 100%;
                justify-content: center;
                padding: 12px 24px;
                font-size: 14px;
            }
        }
    </style>

    <!-- Page Header -->
    <section class="news-page-header">
        <div class="container">
            <h1 style="color: white">📰 All News Articles</h1>
            <p>Stay informed with the latest stories from across the nation</p>

            <div class="filter-buttons" id="filterButtons">
                <a href="javascript:void(0)" data-type="all"
                    class="filter-btn all {{ $currentType == 'all' ? 'active' : '' }}">
                    📰 All News
                    <span class="badge">{{ $counts['all'] }}</span>
                </a>

                <a href="javascript:void(0)" data-type="breaking"
                    class="filter-btn breaking {{ $currentType == 'breaking' ? 'active' : '' }}">
                    🔴 Breaking
                    <span class="badge">{{ $counts['breaking'] }}</span>
                </a>

                <a href="javascript:void(0)" data-type="trending"
                    class="filter-btn trending {{ $currentType == 'trending' ? 'active' : '' }}">
                    📈 Trending
                    <span class="badge">{{ $counts['trending'] }}</span>
                </a>

                <a href="javascript:void(0)" data-type="featured"
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
            <div class="count-display" id="countDisplay">
                Showing <strong id="showingCount">{{ $news->count() }}</strong> of <strong
                    id="totalCount">{{ $counts[$currentType] ?? $counts['all'] }}</strong> articles
            </div>

            <div class="news-grid-container">
                <div class="news-grid" id="newsGrid">
                    @include('news.items', ['news' => $news])
                </div>

                <div class="loading-overlay" id="loadingOverlay">
                    <div class="spinner"></div>
                    <p style="margin-top: 12px; color: #94a3b8;">Loading more news...</p>
                </div>
            </div>

            <div class="load-more-wrapper" id="loadMoreWrapper">
                <button class="load-more-btn" id="loadMoreBtn">
                    <span class="spinner"></span>
                    <span class="btn-text">Load More News</span>
                </button>
            </div>

            <div class="no-more-news" id="noMoreNews">
                🎯 You've reached the end! No more news to load.
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentPage = 1;
            let isLoading = false;
            let hasMorePages = true;
            let currentType = '{{ $currentType }}';
            let totalItems = parseInt('{{ $counts[$currentType] ?? $counts['all'] }}');
            let loadedItems = parseInt('{{ $news->count() }}');

            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const newsGrid = document.getElementById('newsGrid');
            const noMoreNews = document.getElementById('noMoreNews');
            const loadingOverlay = document.getElementById('loadingOverlay');
            const showingCount = document.getElementById('showingCount');
            const totalCount = document.getElementById('totalCount');
            const filterButtons = document.querySelectorAll('.filter-btn');

            function updateCount() {
                showingCount.textContent = loadedItems;
                totalCount.textContent = totalItems;
                checkHasMorePages();
            }

            function checkHasMorePages() {
                if (loadedItems >= totalItems) {
                    hasMorePages = false;
                    loadMoreBtn.style.display = 'none';
                    noMoreNews.classList.add('show');
                } else {
                    hasMorePages = true;
                    loadMoreBtn.style.display = 'inline-flex';
                    noMoreNews.classList.remove('show');
                }
            }

            updateCount();

            function loadMoreNews() {
                if (isLoading || !hasMorePages) {
                    return;
                }

                isLoading = true;
                currentPage++;
                loadMoreBtn.classList.add('loading');
                loadMoreBtn.disabled = true;
                loadingOverlay.classList.add('show');

                const url = new URL('{{ route('news.news') }}', window.location.origin);
                url.searchParams.set('page', currentPage);
                url.searchParams.set('type', currentType);

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success && data.data) {
                            const existingIds = new Set();
                            document.querySelectorAll('.news-card').forEach(card => {
                                const id = card.dataset.id;
                                if (id) existingIds.add(id);
                            });

                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = data.data;
                            const newCards = tempDiv.querySelectorAll('.news-card');
                            let newContent = '';

                            newCards.forEach(card => {
                                const id = card.dataset.id;
                                if (!existingIds.has(id)) {
                                    newContent += card.outerHTML;
                                    existingIds.add(id);
                                }
                            });

                            if (newContent) {
                                newsGrid.insertAdjacentHTML('beforeend', newContent);
                                loadedItems += data.current_count || newCards.length;
                                updateCount();
                            }

                            if (data.counts && data.counts[currentType] !== undefined) {
                                totalItems = data.counts[currentType];
                                totalCount.textContent = totalItems;
                            }

                            if (!data.has_more) {
                                hasMorePages = false;
                                loadMoreBtn.style.display = 'none';
                                noMoreNews.classList.add('show');
                            }
                        } else {
                            hasMorePages = false;
                            loadMoreBtn.style.display = 'none';
                            noMoreNews.classList.add('show');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        currentPage--;
                        alert('Failed to load more news. Please try again.');
                    })
                    .finally(() => {
                        isLoading = false;
                        loadMoreBtn.classList.remove('loading');
                        loadMoreBtn.disabled = false;
                        loadingOverlay.classList.remove('show');
                    });
            }

            // Filter functionality
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const type = this.dataset.type;
                    if (type === currentType && loadedItems > 0) return;

                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    currentType = type;
                    currentPage = 1;
                    hasMorePages = true;
                    loadedItems = 0;

                    newsGrid.innerHTML = '';
                    loadingOverlay.classList.add('show');
                    loadMoreBtn.style.display = 'none';
                    noMoreNews.classList.remove('show');

                    const badge = this.querySelector('.badge');
                    if (badge) {
                        totalItems = parseInt(badge.textContent) || 0;
                        totalCount.textContent = totalItems;
                    }

                    const url = new URL('{{ route('news.news') }}', window.location.origin);
                    url.searchParams.set('type', type);

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.data) {
                                newsGrid.innerHTML = data.data;
                                const count = newsGrid.querySelectorAll('.news-card').length;
                                loadedItems = count;
                                showingCount.textContent = loadedItems;

                                if (data.counts && data.counts[type] !== undefined) {
                                    totalItems = data.counts[type];
                                    totalCount.textContent = totalItems;
                                }

                                if (data.counts) {
                                    filterButtons.forEach(b => {
                                        const badgeEl = b.querySelector('.badge');
                                        if (badgeEl && data.counts[b.dataset.type] !==
                                            undefined) {
                                            badgeEl.textContent = data.counts[b.dataset
                                                .type];
                                        }
                                    });
                                }

                                if (loadedItems < totalItems) {
                                    loadMoreBtn.style.display = 'inline-flex';
                                    noMoreNews.classList.remove('show');
                                    hasMorePages = true;
                                } else {
                                    loadMoreBtn.style.display = 'none';
                                    noMoreNews.classList.add('show');
                                    hasMorePages = false;
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to load news. Please try again.');
                        })
                        .finally(() => {
                            loadingOverlay.classList.remove('show');
                        });
                });
            });

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', loadMoreNews);
            }
        });
    </script>
@endsection
