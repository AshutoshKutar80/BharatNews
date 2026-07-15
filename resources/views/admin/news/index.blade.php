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
            justify-content: flex-end;
            margin-bottom: 20px;
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

        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 0 0 12px 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
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
        }

        @media (max-width: 576px) {
            .admin-content {
                padding: 16px;
            }

            .page-toolbar {
                justify-content: stretch;
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
        }
    </style>

    <div class="page-toolbar">
        <a href="{{ route('admin.news.create') }}" class="btn-primary-add">
            ➕ Add News
        </a>
    </div>

    <div class="panel">
        <div class="panel-head">
            <h3>📰 All News</h3>
            <span class="badge-status published">{{ $news->total() }} total</span>
        </div>
        <div class="panel-body">
            @if ($news->isEmpty())
                <div class="empty-state">
                    <div class="ic">📭</div>
                    No news articles found.
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
                                            @method('DELETE')
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

                // Get scrollbar width
                function getScrollbarWidth() {
                    return window.innerWidth - document.documentElement.clientWidth;
                }

                let scrollbarWidth = 0;

                function openModal() {
                    scrollbarWidth = getScrollbarWidth();
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                    // Add padding to prevent content shift
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
