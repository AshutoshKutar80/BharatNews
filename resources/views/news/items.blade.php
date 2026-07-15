@foreach ($news as $item)
    <article class="news-card" data-id="{{ $item->id }}">
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
                <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" loading="lazy">
            @else
                <div
                    style="width: 100%; height: 220px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #94a3b8; font-size: 14px;">
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
