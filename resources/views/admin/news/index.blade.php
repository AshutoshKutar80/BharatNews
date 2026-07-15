@extends('admin.layout')

@section('title', 'News')
@section('page-title', 'News')
@section('page-subtitle', 'Manage news articles')

@section('content')
    <style>
        /* ============================================================
                   PAGE SPECIFIC STYLES - Only affects this page
                ============================================================ */

        .admin-content {
            padding: 24px;
            height: 100%;
            overflow-y: auto;
        }

        .page-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-toolbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            flex-wrap: wrap;
        }

        /* Search Box Styles */
        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0 12px;
            transition: all 0.2s ease;
            flex: 1;
            min-width: 200px;
            max-width: 350px;
        }

        .search-box:focus-within {
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.1);
        }

        .search-box .search-icon {
            color: #94a3b8;
            font-size: 16px;
            margin-right: 8px;
        }

        .search-box input {
            border: none;
            padding: 10px 0;
            font-size: 14px;
            color: #1e293b;
            width: 100%;
            outline: none;
            background: transparent;
        }

        .search-box input::placeholder {
            color: #94a3b8;
        }

        .search-box .clear-search {
            display: none;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            font-size: 16px;
            transition: color 0.2s ease;
        }

        .search-box .clear-search:hover {
            color: #ef4444;
        }

        .search-box .clear-search.visible {
            display: block;
        }

        /* Filter Dropdown Styles */
        .filter-wrapper {
            position: relative;
            min-width: 150px;
        }

        .filter-select {
            appearance: none;
            -webkit-appearance: none;
            padding: 10px 38px 10px 16px;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
            min-width: 150px;
        }

        .filter-select:hover {
            border-color: #94a3b8;
        }

        .filter-select:focus {
            outline: none;
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.1);
        }

        .filter-wrapper .filter-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            font-size: 12px;
        }

        .filter-select option {
            padding: 8px;
        }

        .filter-select option:checked {
            background: #0f172a;
            color: white;
        }

        /* Filter Badge Counts in Dropdown */
        .filter-option-with-count {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-primary-add {
            background: #0f172a;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-primary-add:hover {
            background: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.25);
            color: white;
        }

        .panel {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            margin-bottom: 32px;
            border: 1px solid #e2e8f0;
            max-width: 100%;
            display: flex;
            flex-direction: column;
        }

        .panel-head {
            padding: 20px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            flex-shrink: 0;
        }

        .panel-head h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }

        .panel-head .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .badge-status {
            padding: 4px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-status.draft {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-status.published {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-status.total {
            background: #e2e8f0;
            color: #475569;
        }

        .badge-status.breaking {
            background: #fee2e2;
            color: #b91c1c;
        }

        .badge-status.trending {
            background: #ede9fe;
            color: #6d28d9;
        }

        .badge-status.featured {
            background: #fef3c7;
            color: #92400e;
        }

        .search-results-info {
            font-size: 14px;
            color: #64748b;
            padding: 12px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .search-results-info strong {
            color: #0f172a;
        }

        .search-results-info .clear-filters {
            color: #ef4444;
            text-decoration: none;
            font-weight: 500;
            font-size: 13px;
            padding: 4px 12px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .search-results-info .clear-filters:hover {
            background: #fee2e2;
        }

        .panel-body {
            padding: 0;
            overflow-x: auto;
            overflow-y: visible;
            flex: 1;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 950px;
        }

        .admin-table th {
            background: #f8fafc;
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .admin-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .admin-table tbody tr:hover {
            background: #f8fafc;
        }

        .thumb-cell img {
            width: 56px;
            height: 56px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .thumb-placeholder {
            width: 56px;
            height: 56px;
            border-radius: 8px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #cbd5e1;
        }

        .cell-title {
            font-weight: 600;
            color: #0f172a;
            max-width: 260px;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cell-sub {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .flag-row {
            display: flex;
            gap: 4px;
            margin-top: 6px;
            flex-wrap: wrap;
        }

        .flag-pill {
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 10px;
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

        .badge-status {
            padding: 4px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-status.draft {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-status.published {
            background: #d1fae5;
            color: #065f46;
        }

        .row-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-sm {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-view {
            background: #6366f1;
            color: white;
        }

        .btn-view:hover {
            background: #4f46e5;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #94a3b8;
        }

        .empty-state .ic {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .empty-state .empty-actions {
            margin-top: 20px;
        }

        .empty-state .empty-actions a {
            display: inline-block;
            padding: 10px 24px;
            background: #0f172a;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .empty-state .empty-actions a:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 0 0 12px 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination-wrap .pagination-info {
            font-size: 14px;
            color: #64748b;
        }

        .pagination-wrap .pagination {
            display: flex;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }

        .pagination-wrap .pagination .page-link {
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

        .pagination-wrap .pagination .page-link:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .pagination-wrap .pagination .page-item.active .page-link {
            background: #0f172a;
            border-color: #0f172a;
            color: white;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        }

        .pagination-wrap .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* ============================================================
               VIEW DETAILS MODAL
               ============================================================ */

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        html.modal-open,
        html.modal-open body {
            overflow: hidden;
            height: 100%;
        }

        .modal-box {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 680px;
            max-height: 88vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalPop 0.18s ease;
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(8px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-head {
            position: sticky;
            top: 0;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 18px 24px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            border-radius: 16px 16px 0 0;
            z-index: 2;
        }

        .modal-head h3 {
            margin: 0;
            font-size: 17px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.4;
        }

        .modal-close {
            background: white;
            border: 1px solid #e2e8f0;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            color: #64748b;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-image {
            width: 100%;
            max-height: 260px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 18px;
            border: 1px solid #e2e8f0;
        }

        .modal-loading {
            padding: 60px 20px;
            text-align: center;
            color: #94a3b8;
        }

        .modal-error {
            padding: 40px 20px;
            text-align: center;
            color: #ef4444;
        }

        .modal-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 18px;
        }

        .modal-meta-item .lbl {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #94a3b8;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .modal-meta-item .val {
            font-size: 13.5px;
            color: #0f172a;
            font-weight: 500;
        }

        .modal-section-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #64748b;
            margin-bottom: 6px;
        }

        .modal-short-desc {
            font-style: italic;
            color: #475569;
            padding: 12px 14px;
            background: #f8fafc;
            border-left: 3px solid #cbd5e1;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .modal-content-text {
            font-size: 14px;
            line-height: 1.75;
            color: #1e293b;
            margin-bottom: 18px;
            white-space: pre-line;
        }

        .modal-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .tag-pill {
            background: #eef2ff;
            color: #4338ca;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        /* ============================================================
               RESPONSIVE
               ============================================================ */

        @media (min-width: 577px) and (max-width: 991px) {
            .admin-table {
                font-size: 13px;
            }

            .admin-table th,
            .admin-table td {
                padding: 10px 8px;
            }

            .cell-title {
                max-width: 180px;
            }

            .search-box {
                max-width: 250px;
            }

            .filter-wrapper {
                min-width: 130px;
            }
        }

        @media (max-width: 576px) {
            .admin-content {
                padding: 16px;
            }

            .page-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .page-toolbar-left {
                flex-direction: column;
                width: 100%;
            }

            .search-box {
                max-width: 100%;
                width: 100%;
            }

            .filter-wrapper {
                width: 100%;
                min-width: unset;
            }

            .filter-select {
                width: 100%;
            }

            .page-toolbar .btn-primary-add {
                width: 100%;
                justify-content: center;
            }

            .panel-head {
                padding: 14px;
                flex-direction: column;
                align-items: stretch;
            }

            .panel-body {
                overflow-x: visible;
            }

            .admin-table {
                min-width: 100%;
            }

            .admin-table thead {
                display: none;
            }

            .admin-table,
            .admin-table tbody,
            .admin-table tr,
            .admin-table td {
                display: block;
                width: 100%;
            }

            .admin-table tr {
                margin-bottom: 14px;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                padding: 12px;
            }

            .admin-table td {
                padding: 8px 0;
                border: none;
                text-align: left;
            }

            .admin-table td::before {
                content: attr(data-label);
                display: block;
                font-weight: 600;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.03em;
                color: #94a3b8;
                margin-bottom: 4px;
            }

            .cell-title {
                max-width: 100%;
                white-space: normal;
            }

            .row-actions {
                border-top: 1px dashed #e2e8f0;
                padding-top: 10px;
                margin-top: 4px;
            }

            .row-actions .btn-sm {
                flex: 1;
                justify-content: center;
            }

            .modal-meta-grid {
                grid-template-columns: 1fr;
            }

            .pagination-wrap {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .search-results-info {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <!-- Page Toolbar with Search and Filter -->
    <div class="page-toolbar">
        <div class="page-toolbar-left">
            <!-- Search Box -->
            <form method="GET" action="{{ route('admin.news.index') }}" class="search-box" id="searchForm">
                <span class="search-icon">🔍</span>
                <input type="text" name="search" id="searchInput" placeholder="Search news..."
                    value="{{ request('search') }}" autocomplete="off">
                <button type="button" class="clear-search {{ request('search') ? 'visible' : '' }}" id="clearSearch"
                    title="Clear search">
                    ✕
                </button>
            </form>

            <!-- Filter Dropdown -->
            <form method="GET" action="{{ route('admin.news.index') }}" id="filterForm">
                @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <div class="filter-wrapper">
                    <select name="filter" class="filter-select" id="filterSelect">
                        <option value="all" {{ $currentFilter == 'all' ? 'selected' : '' }}>
                            📋 All ({{ $counts['all'] }})
                        </option>
                        <option value="draft" {{ $currentFilter == 'draft' ? 'selected' : '' }}>
                            📝 Draft ({{ $counts['draft'] }})
                        </option>
                        <option value="published" {{ $currentFilter == 'published' ? 'selected' : '' }}>
                            ✅ Published ({{ $counts['published'] }})
                        </option>
                        <option value="breaking" {{ $currentFilter == 'breaking' ? 'selected' : '' }}>
                            🔴 Breaking ({{ $counts['breaking'] }})
                        </option>
                        <option value="trending" {{ $currentFilter == 'trending' ? 'selected' : '' }}>
                            📈 Trending ({{ $counts['trending'] }})
                        </option>
                        <option value="featured" {{ $currentFilter == 'featured' ? 'selected' : '' }}>
                            ⭐ Featured ({{ $counts['featured'] }})
                        </option>
                    </select>
                    <span class="filter-icon">▼</span>
                </div>
            </form>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn-primary-add">
            ➕ Add News
        </a>
    </div>

    <!-- Panel -->
    <div class="panel">
        <div class="panel-head">
            <h3>📰 All News</h3>
            <div class="header-right">
                @if (request('search') || (request('filter') && request('filter') != 'all'))
                    <span class="badge-status total">{{ $news->total() }} results found</span>
                @endif
                <span class="badge-status total">{{ $news->total() }} total</span>
            </div>
        </div>

        @if ((request('search') || (request('filter') && request('filter') != 'all')) && $news->total() > 0)
            <div class="search-results-info">
                <span>
                    @if (request('search'))
                        Showing results for: <strong>"{{ request('search') }}"</strong>
                    @endif
                    @if (request('filter') && request('filter') != 'all')
                        @if (request('search'))
                            |
                        @endif
                        Filter: <strong>{{ ucfirst(request('filter')) }}</strong>
                    @endif
                    <span style="margin-left: 8px; color: #94a3b8;">
                        ({{ $news->firstItem() ?? 0 }} - {{ $news->lastItem() ?? 0 }} of {{ $news->total() }})
                    </span>
                </span>
                <a href="{{ route('admin.news.index') }}" class="clear-filters">✕ Clear Filters</a>
            </div>
        @endif

        <div class="panel-body">
            @if ($news->isEmpty())
                <div class="empty-state">
                    <div class="ic">📭</div>
                    @if (request('search') || (request('filter') && request('filter') != 'all'))
                        <h3>No results found</h3>
                        <p>Try adjusting your search terms or filters to find what you're looking for.</p>
                        <div class="empty-actions">
                            <a href="{{ route('admin.news.index') }}">Clear All Filters</a>
                        </div>
                    @else
                        <h3>No news articles found</h3>
                        <p>Start by adding your first news article.</p>
                        <div class="empty-actions">
                            <a href="{{ route('admin.news.create') }}">➕ Add News</a>
                        </div>
                    @endif
                </div>
            @else
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Published</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                            <tr>
                                <td class="thumb-cell" data-label="Image">
                                    @if ($item->featured_image)
                                        <img src="{{ asset('storage/' . $item->featured_image) }}"
                                            alt="{{ $item->title }}">
                                    @else
                                        <div class="thumb-placeholder">🖼️</div>
                                    @endif
                                </td>
                                <td data-label="Title">
                                    <span class="cell-title" title="{{ $item->title }}">{{ $item->title }}</span>
                                    <div class="flag-row">
                                        @if ($item->is_breaking)
                                            <span class="flag-pill breaking">Breaking</span>
                                        @endif
                                        @if ($item->is_featured)
                                            <span class="flag-pill featured">Featured</span>
                                        @endif
                                        @if ($item->is_trending)
                                            <span class="flag-pill trending">Trending</span>
                                        @endif
                                    </div>
                                </td>
                                <td data-label="Category">
                                    {{ $item->category->name ?? '—' }}
                                    @if ($item->subcategory)
                                        <div class="cell-sub">{{ $item->subcategory->name }}</div>
                                    @endif
                                </td>
                                <td data-label="Author">
                                    {{ $item->author->name ?? '—' }}
                                </td>
                                <td data-label="Status">
                                    <span class="badge-status {{ $item->status }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td data-label="Published" style="font-size: 13px; color: #64748b;">
                                    {{ $item->published_at ? $item->published_at->format('d M Y, h:i A') : '—' }}
                                </td>
                                <td data-label="Actions">
                                    <div class="row-actions">
                                        <button type="button" class="btn-sm btn-view js-view-news"
                                            data-url="{{ route('admin.news.show', $item->id) }}">
                                            👁️ View
                                        </button>
                                        <a href="{{ route('admin.news.edit', $item->id) }}" class="btn-sm btn-edit">
                                            ✏️ Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.news.destroy', $item->id) }}"
                                            data-confirm="Delete the article &quot;{{ $item->title }}&quot;? This cannot be undone."
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-delete">🗑 Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        @if ($news->hasPages())
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Showing {{ $news->firstItem() ?? 0 }} to {{ $news->lastItem() ?? 0 }} of {{ $news->total() }} results
                </div>
                {{ $news->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    {{-- View Details Modal --}}
    <div class="modal-overlay" id="newsViewModal">
        <div class="modal-box">
            <div class="modal-head">
                <h3 id="newsModalTitle">Loading…</h3>
                <button type="button" class="modal-close" id="newsModalClose">✕</button>
            </div>
            <div class="modal-body" id="newsModalBody">
                <div class="modal-loading">Loading article…</div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // ---- Search functionality ----
                const searchInput = document.getElementById('searchInput');
                const searchForm = document.getElementById('searchForm');
                const clearSearch = document.getElementById('clearSearch');

                // Auto-submit on typing (with debounce)
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);

                    // Show/hide clear button
                    if (this.value.length > 0) {
                        clearSearch.classList.add('visible');
                    } else {
                        clearSearch.classList.remove('visible');
                    }

                    searchTimeout = setTimeout(() => {
                        searchForm.submit();
                    }, 500);
                });

                // Clear search
                clearSearch.addEventListener('click', function() {
                    searchInput.value = '';
                    this.classList.remove('visible');
                    searchForm.submit();
                });

                // Submit on Enter key
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        searchForm.submit();
                    }
                });

                // ---- Filter functionality ----
                const filterSelect = document.getElementById('filterSelect');
                const filterForm = document.getElementById('filterForm');

                filterSelect.addEventListener('change', function() {
                    filterForm.submit();
                });

                // ---- Delete confirmation ----
                document.querySelectorAll('form[data-confirm]').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const message = this.getAttribute('data-confirm');
                        if (!confirm(message)) {
                            e.preventDefault();
                        }
                    });
                });

                // ---- View details modal ----
                const overlay = document.getElementById('newsViewModal');
                const modalTitle = document.getElementById('newsModalTitle');
                const modalBody = document.getElementById('newsModalBody');
                const modalClose = document.getElementById('newsModalClose');

                function escapeHtml(str) {
                    if (!str) return '';
                    const div = document.createElement('div');
                    div.textContent = str;
                    return div.innerHTML;
                }

                function getScrollbarWidth() {
                    return window.innerWidth - document.documentElement.clientWidth;
                }

                let scrollbarWidth = 0;

                function openModal() {
                    scrollbarWidth = getScrollbarWidth();
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                    document.body.style.paddingRight = scrollbarWidth + 'px';
                }

                function closeModal() {
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                }

                function renderArticle(data) {
                    modalTitle.textContent = data.title || 'Untitled';

                    let flagsHtml = '';
                    if (data.is_breaking) flagsHtml += '<span class="flag-pill breaking">Breaking</span>';
                    if (data.is_featured) flagsHtml += '<span class="flag-pill featured">Featured</span>';
                    if (data.is_trending) flagsHtml += '<span class="flag-pill trending">Trending</span>';

                    let html = '';

                    if (data.featured_image) {
                        html +=
                            `<img class="modal-image" src="${data.featured_image}" alt="${escapeHtml(data.title)}">`;
                    }

                    if (flagsHtml || data.status) {
                        html += `<div class="flag-row" style="margin-bottom:16px;">
                            <span class="badge-status ${data.status}">${escapeHtml((data.status || '').replace(/^\w/, c => c.toUpperCase()))}</span>
                            ${flagsHtml}
                        </div>`;
                    }

                    html += '<div class="modal-meta-grid">';
                    html += metaItem('Category', data.category);
                    html += metaItem('Subcategory', data.subcategory);
                    html += metaItem('Author', data.author);
                    html += metaItem('Source', data.source);
                    html += metaItem('Location', data.location);
                    html += metaItem('Views', data.views);
                    html += metaItem('Published', data.published_at);
                    html += metaItem('Created', data.created_at);
                    html += '</div>';

                    if (data.short_description) {
                        html +=
                            `<div class="modal-short-desc">${escapeHtml(data.short_description)}</div>`;
                    }

                    html += '<div class="modal-section-label">Content</div>';
                    html += `<div class="modal-content-text">${escapeHtml(data.content)}</div>`;

                    if (data.tags) {
                        const tags = data.tags.split(',').map(t => t.trim()).filter(Boolean);
                        if (tags.length) {
                            html += '<div class="modal-section-label">Tags</div>';
                            html += '<div class="modal-tags">';
                            tags.forEach(t => {
                                html += `<span class="tag-pill">#${escapeHtml(t)}</span>`;
                            });
                            html += '</div>';
                        }
                    }

                    modalBody.innerHTML = html;
                }

                function metaItem(label, value) {
                    if (!value && value !== 0) return '';
                    return `<div class="modal-meta-item">
                        <div class="lbl">${label}</div>
                        <div class="val">${escapeHtml(String(value))}</div>
                    </div>`;
                }

                document.querySelectorAll('.js-view-news').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const url = this.dataset.url;

                        modalTitle.textContent = 'Loading…';
                        modalBody.innerHTML = '<div class="modal-loading">Loading article…</div>';
                        openModal();

                        fetch(url, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(res => {
                                if (!res.ok) throw new Error('Request failed');
                                return res.json();
                            })
                            .then(data => renderArticle(data))
                            .catch(() => {
                                modalTitle.textContent = 'Error';
                                modalBody.innerHTML =
                                    '<div class="modal-error">Could not load this article. Please try again.</div>';
                            });
                    });
                });

                modalClose.addEventListener('click', closeModal);
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) closeModal();
                });
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && overlay.classList.contains('active')) closeModal();
                });
            });
        </script>
    @endpush
@endsection
