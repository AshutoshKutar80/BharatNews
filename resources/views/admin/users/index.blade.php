@extends('admin.layout')

@section('title', 'Users')
@section('page-title', 'Users')
@section('page-subtitle', 'Review, approve, reject or block registered users')

@section('content')

    <!-- Loader Overlay -->
    <div id="pageLoader"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 9999; align-items: center; justify-content: center; flex-direction: column;">
        <div class="spinner"></div>
        <p style="margin-top: 15px; font-weight: 500; color: #333;">Loading...</p>
    </div>

    <div class="panel">
        <div class="panel-head">
            <div class="tabs">
                <a href="{{ route('admin.users', ['status' => 'all']) }}"
                    class="tab-link {{ $status === 'all' ? 'active' : '' }}">All</a>
                <a href="{{ route('admin.users', ['status' => 'pending']) }}"
                    class="tab-link {{ $status === 'pending' ? 'active' : '' }}">Pending</a>
                <a href="{{ route('admin.users', ['status' => 'approved']) }}"
                    class="tab-link {{ $status === 'approved' ? 'active' : '' }}">Approved</a>
                <a href="{{ route('admin.users', ['status' => 'rejected']) }}"
                    class="tab-link {{ $status === 'rejected' ? 'active' : '' }}">Rejected</a>
                <a href="{{ route('admin.users', ['status' => 'blocked']) }}"
                    class="tab-link {{ $status === 'blocked' ? 'active' : '' }}">Blocked</a>
            </div>

            <form class="search-box" method="GET" action="{{ route('admin.users') }}" id="searchForm">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="text" name="search" placeholder="Search name, email, mobile, city..."
                    value="{{ request('search') }}" id="searchInput">
                <button type="submit" id="searchBtn">Search</button>
            </form>
        </div>

        <div class="panel-body" id="usersContainer">
            @if ($users->isEmpty())
                <div class="empty-state">
                    <div class="ic">👥</div>
                    No users found for this filter.
                </div>
            @else
                <table class="admin-table responsive-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Mobile</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr id="user-row-{{ $u->id }}">
                                <td data-label="User">
                                    <div class="cell-name">{{ $u->name }}</div>
                                    <div class="cell-sub">{{ $u->email }}</div>
                                </td>
                                <td data-label="Mobile">{{ $u->mobile ?? '—' }}</td>
                                <td data-label="Location">
                                    {{ $u->city }}
                                    <div class="cell-sub">{{ $u->tehsil }}, {{ $u->district }}, {{ $u->state }} -
                                        {{ $u->pincode }}</div>
                                </td>
                                <td data-label="Status">
                                    <span class="badge-status {{ $u->status }}"
                                        id="status-badge-{{ $u->id }}">{{ $u->status }}</span>
                                    @if ($u->admin_remark)
                                        <div class="cell-sub" title="{{ $u->admin_remark }}">📝
                                            {{ \Illuminate\Support\Str::limit($u->admin_remark, 30) }}</div>
                                    @endif
                                </td>
                                <td data-label="Registered">{{ $u->created_at->format('d M Y') }}</td>
                                <td data-label="Actions">
                                    <div class="row-actions">
                                        <a href="{{ route('admin.users.edit', $u->id) }}" class="btn-sm btn-edit">✏️
                                            Edit</a>

                                        @if ($u->status === 'pending')
                                            <form method="POST" action="{{ route('admin.users.approve', $u->id) }}"
                                                data-confirm="Approve {{ $u->name }}?" class="action-form">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-approve action-btn"
                                                    data-user-id="{{ $u->id }}" data-action="approve">✔
                                                    Approve</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.users.reject', $u->id) }}"
                                                data-remark-prompt="Reason for rejecting {{ $u->name }} (optional):"
                                                class="action-form">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-reject action-btn"
                                                    data-user-id="{{ $u->id }}" data-action="reject">✖
                                                    Reject</button>
                                            </form>
                                        @endif

                                        @if ($u->status === 'approved')
                                            <form method="POST" action="{{ route('admin.users.block', $u->id) }}"
                                                data-remark-prompt="Reason for blocking {{ $u->name }} (optional):"
                                                class="action-form">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-block action-btn"
                                                    data-user-id="{{ $u->id }}" data-action="block">⛔ Block</button>
                                            </form>
                                        @endif

                                        @if ($u->status === 'blocked')
                                            <form method="POST" action="{{ route('admin.users.unblock', $u->id) }}"
                                                data-confirm="Unblock {{ $u->name }}?" class="action-form">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-approve action-btn"
                                                    data-user-id="{{ $u->id }}" data-action="unblock">↺
                                                    Unblock</button>
                                            </form>
                                        @endif

                                        @if ($u->status === 'rejected')
                                            <form method="POST" action="{{ route('admin.users.approve', $u->id) }}"
                                                data-confirm="Approve {{ $u->name }} after all?" class="action-form">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-approve action-btn"
                                                    data-user-id="{{ $u->id }}" data-action="approve">✔
                                                    Approve</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        @if ($users->hasPages())
            <div class="pagination-wrap">{{ $users->links() }}</div>
        @endif
    </div>

@endsection

@push('styles')
    <style>
        /* ---------- Loader Styles ---------- */
        #pageLoader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.85);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #pageLoader.active {
            display: flex !important;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Small inline loader for buttons */
        .btn-loader {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 6px;
            vertical-align: middle;
        }

        .btn-loader.dark {
            border-top: 2px solid #333;
        }

        /* Disabled button state */
        .action-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* ---------- Panel head: tabs + search ---------- */
        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .tabs {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
        }

        .tab-link {
            white-space: nowrap;
            flex-shrink: 0;
        }

        .search-box {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .search-box input[type="text"] {
            min-width: 0;
            flex: 1;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .row-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .row-actions form {
            display: inline-flex;
            margin: 0;
        }

        /* ---------- Tablet ---------- */
        @media (max-width: 768px) {
            .panel-head {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }

            .panel {
                padding: 12px;
            }
        }

        /* ---------- Mobile: table -> stacked cards ---------- */
        @media (max-width: 576px) {
            .search-box {
                flex-wrap: wrap;
            }

            .search-box input[type="text"] {
                flex: 1 1 100%;
            }

            .search-box button {
                flex: 1;
            }

            .responsive-table thead {
                display: none;
            }

            .responsive-table,
            .responsive-table tbody,
            .responsive-table tr,
            .responsive-table td {
                display: block;
                width: 100%;
            }

            .responsive-table tr {
                margin-bottom: 14px;
                border: 1px solid rgba(0, 0, 0, 0.08);
                border-radius: 10px;
                padding: 10px 12px;
                background: #fff;
            }

            .responsive-table td {
                padding: 8px 0;
                border: none;
                text-align: left;
            }

            .responsive-table td::before {
                content: attr(data-label);
                display: block;
                font-weight: 600;
                font-size: 0.72rem;
                text-transform: uppercase;
                letter-spacing: 0.03em;
                opacity: 0.55;
                margin-bottom: 4px;
            }

            .responsive-table td[data-label="Actions"] {
                border-top: 1px dashed rgba(0, 0, 0, 0.08);
                margin-top: 4px;
                padding-top: 10px;
            }

            .row-actions .btn-sm {
                flex: 1 1 auto;
                text-align: center;
                justify-content: center;
            }
        }

        /* ---------- Global safety ---------- */
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        * {
            box-sizing: border-box;
        }

        .panel {
            max-width: 100%;
            overflow: hidden;
        }

        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            min-width: 0;
        }

        .tabs {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            min-width: 0;
            flex: 1 1 auto;
            max-width: 100%;
        }

        .tab-link {
            white-space: nowrap;
            flex-shrink: 0;
        }

        .search-box {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
            min-width: 0;
        }

        .search-box input[type="text"] {
            min-width: 0;
            flex: 1;
        }

        @media (max-width: 768px) {
            .panel-head {
                flex-direction: column;
                align-items: stretch;
            }

            .tabs {
                width: 100%;
            }

            .search-box {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .search-box {
                flex-wrap: wrap;
            }

            .search-box input[type="text"] {
                flex: 1 1 100%;
            }

            .search-box button {
                flex: 1;
            }
        }

        /* Toast notification styles */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: #fff;
            font-weight: 500;
            z-index: 10000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateX(120%);
            transition: transform 0.3s ease-in-out;
            max-width: 400px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            background: #28a745;
        }

        .toast.error {
            background: #dc3545;
        }

        .toast.info {
            background: #17a2b8;
        }

        .toast.warning {
            background: #ffc107;
            color: #333;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            var loaderActive = false;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            hideLoader();

            $('.tab-link').on('click', function(e) {
                if (!loaderActive) {
                    showLoader('Loading users...');
                    loaderActive = true;
                }
            });

            $('#searchForm').on('submit', function(e) {
                if (!loaderActive) {
                    showLoader('Searching users...');
                    loaderActive = true;
                }
            });

            $('.action-btn').on('click', function(e) {
                e.preventDefault();

                var $btn = $(this);
                var $form = $btn.closest('form');
                var action = $btn.data('action');
                var userId = $btn.data('user-id');
                var userName = $btn.closest('tr').find('.cell-name').text().trim();

                var confirmMsg = $form.data('confirm');
                if (confirmMsg) {
                    if (!confirm(confirmMsg)) {
                        return false;
                    }
                }

                var remarkPrompt = $form.data('remark-prompt');
                var remark = '';
                if (remarkPrompt) {
                    remark = prompt(remarkPrompt);
                    if (remark === null) {
                        return false; // User cancelled
                    }
                }

                // Show loader
                showLoader('Processing...');
                loaderActive = true;

                $btn.prop('disabled', true);
                var originalText = $btn.html();
                $btn.html('<span class="btn-loader"></span> Processing...');

                var formData = $form.serialize();

                if (remark && remark.trim() !== '') {
                    formData += '&admin_remark=' + encodeURIComponent(remark.trim());
                }

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        loaderActive = false;
                        hideLoader();

                        if (response.success) {
                            showToast(response.message || 'Action completed successfully!',
                                'success');

                            if (response.new_status) {
                                var $badge = $('#status-badge-' + userId);
                                $badge.text(response.new_status);
                                $badge.removeClass('pending approved rejected blocked')
                                    .addClass(response.new_status);
                            }

                            setTimeout(function() {
                                location.reload();
                            }, 300);
                        } else {
                            showToast(response.message || 'Something went wrong!', 'error');
                            $btn.prop('disabled', false);
                            $btn.html(originalText);
                        }
                    },
                    error: function(xhr) {
                        loaderActive = false;
                        hideLoader();

                        var errorMsg = 'An error occurred. Please try again.';

                        if (xhr.status === 419) {
                            errorMsg =
                                'Session expired. Please refresh the page and try again.';
                            setTimeout(function() {
                                location.reload();
                            }, 300);
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        } else if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            if (errors) {
                                errorMsg = Object.values(errors).flat().join(', ');
                            }
                        }

                        showToast(errorMsg, 'error');
                        $btn.prop('disabled', false);
                        $btn.html(originalText);
                    }
                });
            });

            function showLoader(message) {
                var $loader = $('#pageLoader');
                $loader.find('p').text(message || 'Loading...');
                $loader.addClass('active');
                $loader.css('display', 'flex');
            }

            function hideLoader() {
                var $loader = $('#pageLoader');
                $loader.removeClass('active');
                $loader.css('display', 'none');
                loaderActive = false;
            }

            function showToast(message, type) {
                $('.toast').remove();

                var toast = $('<div>')
                    .addClass('toast ' + type)
                    .text(message)
                    .appendTo('body');

                setTimeout(function() {
                    toast.addClass('show');
                }, 100);

                setTimeout(function() {
                    toast.removeClass('show');
                    setTimeout(function() {
                        toast.remove();
                    }, 300);
                }, 4000);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            hideLoader();
        });

        window.addEventListener('load', function() {
            hideLoader();
        });

        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                hideLoader();
            }
        });

        function hideLoader() {
            var $loader = document.getElementById('pageLoader');
            if ($loader) {
                $loader.style.display = 'none';
                $loader.classList.remove('active');
            }
        }

        hideLoader();
    </script>
@endpush
