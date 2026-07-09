@extends('admin.layout')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')
@section('page-subtitle', 'Manage and reply to contact inquiries')

@section('content')
    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        * {
            box-sizing: border-box;
        }

        /* Tab Navigation */
        .tab-nav {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            background: white;
            padding: 8px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            min-width: 0;
        }

        .tab-nav a {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .tab-nav a:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .tab-nav a.active {
            background: #0f172a;
            color: white;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        }

        .tab-nav a .badge-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 2px 10px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .tab-nav a:not(.active) .badge-count {
            background: #e2e8f0;
            color: #475569;
        }

        /* Table Styles */
        .panel {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            margin-bottom: 32px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            max-width: 100%;
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
        }

        .panel-head h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }

        .badge-status {
            padding: 4px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-status.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-status.read {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-status.replied {
            background: #d1fae5;
            color: #065f46;
        }

        .panel-body {
            padding: 0;
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .admin-table th {
            background: #f8fafc;
            padding: 14px 16px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        .admin-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .admin-table tbody tr:hover {
            background: #f8fafc;
        }

        .admin-table tbody tr.unread {
            background: #fef9f0;
        }

        .cell-name {
            font-weight: 600;
            color: #0f172a;
        }

        .cell-sub {
            font-size: 12px;
            color: #94a3b8;
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
            background: #3b82f6;
            color: white;
        }

        .btn-view:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-reply {
            background: #10b981;
            color: white;
        }

        .btn-reply:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
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

        /* Pagination */
        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 0 0 12px 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pagination-wrap .pagination {
            display: flex;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }

        .pagination-wrap .pagination .page-item {
            margin: 0;
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

        /* Bulk action */
        .bulk-actions {
            padding: 12px 24px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .bulk-actions select {
            padding: 8px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        .bulk-actions .btn-sm {
            padding: 8px 20px;
        }

        .checkbox-column {
            width: 40px;
            text-align: center;
        }

        .checkbox-column input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #0f172a;
            cursor: pointer;
        }

        .subject-preview {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .message-preview {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            color: #64748b;
            font-size: 13px;
        }

        /* ============================================================
               TABLET  (577px – 991px)
               ============================================================ */
        @media (min-width: 577px) and (max-width: 991px) {
            .admin-table {
                font-size: 13px;
            }

            .admin-table th,
            .admin-table td {
                padding: 10px 8px;
            }

            .subject-preview,
            .message-preview {
                max-width: 140px;
            }

            .panel-head {
                padding: 16px;
            }
        }

        /* ============================================================
               LAPTOP  (992px – 1199px)
               ============================================================ */
        @media (min-width: 992px) and (max-width: 1199px) {
            .admin-table {
                font-size: 13.5px;
            }

            .subject-preview,
            .message-preview {
                max-width: 180px;
            }
        }

        /* ============================================================
               DESKTOP  (≥ 1200px) — default styles already good
               ============================================================ */

        /* ============================================================
               MOBILE  (≤ 576px) — cards
               ============================================================ */
        @media (max-width: 576px) {
            .tab-nav {
                padding: 6px;
                gap: 4px;
            }

            .tab-nav a {
                padding: 8px 14px;
                font-size: 13px;
            }

            .panel-head {
                padding: 14px;
                flex-direction: column;
                align-items: stretch;
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

            .admin-table tr.unread {
                border-left: 4px solid #f59e0b;
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

            .checkbox-column {
                width: auto;
                text-align: left;
                display: flex !important;
                align-items: center;
                gap: 8px;
            }

            .checkbox-column::before {
                content: "Select" !important;
                margin-bottom: 0 !important;
            }

            .subject-preview,
            .message-preview {
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

            .bulk-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .bulk-actions select {
                width: 100%;
            }

            #selectedCount {
                margin-left: 0 !important;
                text-align: center;
            }
        }
    </style>

    {{-- Tab Navigation --}}
    <div class="tab-nav">
        <a href="{{ route('admin.contacts.index') }}"
            class="{{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
            📋 All Messages
            <span class="badge-count">{{ $totalCount }}</span>
        </a>
        <a href="{{ route('admin.contacts.pending') }}"
            class="{{ request()->routeIs('admin.contacts.pending') ? 'active' : '' }}">
            ⏳ Pending
            <span class="badge-count">{{ $pendingCount }}</span>
        </a>
        <a href="{{ route('admin.contacts.replied') }}"
            class="{{ request()->routeIs('admin.contacts.replied') ? 'active' : '' }}">
            ✅ Replied
            <span class="badge-count">{{ $contacts->where('status', 'replied')->count() }}</span>
        </a>
    </div>

    {{-- Contacts Table --}}
    <div class="panel">
        <div class="panel-head">
            <h3>📬 All Contact Messages</h3>
            <span class="badge-status pending">{{ $totalCount }} total</span>
        </div>
        <div class="panel-body">
            @if ($contacts->isEmpty())
                <div class="empty-state">
                    <div class="ic">📭</div>
                    No contact messages found.
                </div>
            @else
                <form id="bulkForm" method="POST" action="{{ route('admin.contacts.bulk-delete') }}">
                    @csrf
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th class="checkbox-column">
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>User</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr class="{{ $contact->status === 'pending' ? 'unread' : '' }}">
                                    <td class="checkbox-column">
                                        <input type="checkbox" name="ids[]" value="{{ $contact->id }}"
                                            class="contact-checkbox">
                                    </td>
                                    <td data-label="User">
                                        <div class="cell-name">{{ $contact->name }}</div>
                                        <div class="cell-sub">{{ $contact->email }}</div>
                                        <div class="cell-sub" style="margin-top: 2px;">📱 {{ $contact->mobile }}</div>
                                    </td>
                                    <td data-label="Subject">
                                        <span class="subject-preview" title="{{ $contact->subject }}">
                                            {{ ucfirst(str_replace('-', ' ', $contact->subject)) }}
                                        </span>
                                    </td>
                                    <td data-label="Message">
                                        <span class="message-preview" title="{{ $contact->message }}">
                                            {{ Str::limit($contact->message, 60) }}
                                        </span>
                                    </td>
                                    <td data-label="Status">
                                        <span class="badge-status {{ $contact->status }}">
                                            {{ ucfirst($contact->status) }}
                                        </span>
                                        @if ($contact->status === 'replied' && $contact->replied_at)
                                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">
                                                {{ $contact->replied_at->format('d M Y') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td data-label="Received" style="font-size: 13px; color: #64748b;">
                                        {{ $contact->created_at->format('d M Y, h:i A') }}
                                    </td>
                                    <td data-label="Actions">
                                        <div class="row-actions">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                                class="btn-sm btn-view">
                                                👁️ View
                                            </a>
                                            @if ($contact->status !== 'replied')
                                                <a href="{{ route('admin.contacts.show', $contact->id) }}#reply-section"
                                                    class="btn-sm btn-reply">
                                                    ✉️ Reply
                                                </a>
                                            @endif
                                            <form method="POST"
                                                action="{{ route('admin.contacts.destroy', $contact->id) }}"
                                                data-confirm="Delete this contact message from {{ $contact->name }}? This cannot be undone."
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

                    {{-- Bulk Actions --}}
                    <div class="bulk-actions">
                        <span style="font-size: 13px; color: #64748b;">Bulk Actions:</span>
                        <button type="submit" class="btn-sm btn-delete"
                            onclick="return confirm('Delete selected contacts?')">
                            🗑 Delete Selected
                        </button>
                        <span id="selectedCount" style="font-size: 13px; color: #94a3b8; margin-left: auto;">
                            0 selected
                        </span>
                    </div>
                </form>
            @endif
        </div>
        @if ($contacts->hasPages())
            <div class="pagination-wrap">
                {{ $contacts->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAll = document.getElementById('selectAll');
                const checkboxes = document.querySelectorAll('.contact-checkbox');
                const selectedCount = document.getElementById('selectedCount');

                if (selectAll) {
                    selectAll.addEventListener('change', function() {
                        checkboxes.forEach(cb => cb.checked = this.checked);
                        updateSelectedCount();
                    });
                }

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', updateSelectedCount);
                });

                function updateSelectedCount() {
                    const checked = document.querySelectorAll('.contact-checkbox:checked').length;
                    if (selectedCount) {
                        selectedCount.textContent = checked + ' selected';
                    }
                }

                document.querySelectorAll('form[data-confirm]').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const message = this.getAttribute('data-confirm');
                        if (!confirm(message)) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
