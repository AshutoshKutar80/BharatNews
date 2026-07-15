@extends('admin.layout')

@section('title', 'Pending Contacts')
@section('page-title', 'Pending Contacts')
@section('page-subtitle', 'View and reply to pending contact inquiries')

@section('content')
    <style>
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
            flex-wrap: wrap;
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

        .admin-table tbody tr.pending-row {
            background: #fef9f0;
            border-left: 4px solid #f59e0b;
        }

        .admin-table tbody tr.pending-row:hover {
            background: #fef3c7;
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

        .btn-mark-read {
            background: #8b5cf6;
            color: white;
        }

        .btn-mark-read:hover {
            background: #7c3aed;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
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

        /* Pending indicator */
        .pending-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            background: #fef3c7;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            color: #92400e;
        }

        .pending-indicator .dot {
            width: 8px;
            height: 8px;
            background: #f59e0b;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }

            100% {
                opacity: 1;
            }
        }

        .subject-preview {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .message-preview {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            color: #64748b;
            font-size: 13px;
        }

        .time-ago {
            font-size: 12px;
            color: #94a3b8;
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
    </style>

    {{-- Tab Navigation --}}
    <div class="tab-nav">
        <a href="{{ route('admin.contacts.index') }}">
            📋 All Messages
            <span class="badge-count">{{ $totalCount }}</span>
        </a>
        <a href="{{ route('admin.contacts.pending') }}" class="active">
            ⏳ Pending
            <span class="badge-count">{{ $pendingCount }}</span>
        </a>
        <a href="{{ route('admin.contacts.replied') }}">
            ✅ Replied
            <span class="badge-count">{{ $repliedCount }}</span>
        </a>
    </div>

    {{-- Pending Contacts Table --}}
    <div class="panel">
        <div class="panel-head">
            <h3>⏳ Pending Contacts</h3>
            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="pending-indicator">
                    <span class="dot"></span>
                    {{ $pendingCount }} pending
                </span>
                <span class="badge-status pending">{{ $contacts->total() }} total</span>
            </div>
        </div>
        <div class="panel-body">
            @if ($contacts->isEmpty())
                <div class="empty-state">
                    <div class="ic">🎉</div>
                    No pending contacts! All caught up.
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
                                <th>Received</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr class="pending-row">
                                    <td class="checkbox-column">
                                        <input type="checkbox" name="ids[]" value="{{ $contact->id }}"
                                            class="contact-checkbox">
                                    </td>
                                    <td>
                                        <div class="cell-name">{{ $contact->name }}</div>
                                        <div class="cell-sub">{{ $contact->email }}</div>
                                        <div class="cell-sub" style="margin-top: 2px;">📱 {{ $contact->mobile }}</div>
                                    </td>
                                    <td>
                                        <span class="subject-preview" title="{{ $contact->subject }}">
                                            {{ ucfirst(str_replace('-', ' ', $contact->subject)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="message-preview" title="{{ $contact->message }}">
                                            {{ Str::limit($contact->message, 60) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 500; color: #0f172a;">
                                            {{ $contact->created_at->format('d M Y') }}
                                        </div>
                                        <div class="time-ago">
                                            {{ $contact->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row-actions">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                                class="btn-sm btn-view">
                                                👁️ View
                                            </a>
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}#reply-section"
                                                class="btn-sm btn-reply">
                                                ✉️ Reply
                                            </a>
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
                // Select All checkbox
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

                // Confirm dialogs
                document.querySelectorAll('form[data-confirm]').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const message = this.getAttribute('data-confirm');
                        if (!confirm(message)) {
                            e.preventDefault();
                        }
                    });
                });

                // Auto-refresh pending count (optional)
                setInterval(function() {
                    fetch('{{ route('admin.contacts.pending') }}')
                        .then(response => response.text())
                        .then(html => {
                            // Update pending count in badge
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newCount = doc.querySelector('.pending-indicator');
                            if (newCount) {
                                const currentIndicator = document.querySelector('.pending-indicator');
                                if (currentIndicator) {
                                    currentIndicator.innerHTML = newCount.innerHTML;
                                }
                            }
                        })
                        .catch(err => console.log('Auto-refresh error:', err));
                }, 30000); // Refresh every 30 seconds
            });
        </script>
    @endpush
@endsection
