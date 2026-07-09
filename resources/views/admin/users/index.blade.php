@extends('admin.layout')

@section('title', 'Users')
@section('page-title', 'Users')
@section('page-subtitle', 'Review, approve, reject or block registered users')

@section('content')

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

            <form class="search-box" method="GET" action="{{ route('admin.users') }}">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="text" name="search" placeholder="Search name, email, mobile, city..."
                    value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="panel-body">
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
                            <tr>
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
                                    <span class="badge-status {{ $u->status }}">{{ $u->status }}</span>
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
                                                data-confirm="Approve {{ $u->name }}?">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-approve">✔ Approve</button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.users.reject', $u->id) }}"
                                                data-remark-prompt="Reason for rejecting {{ $u->name }} (optional):">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-reject">✖ Reject</button>
                                            </form>
                                        @endif

                                        @if ($u->status === 'approved')
                                            {{-- After approval, only a "blocked" action is shown, as requested --}}
                                            <form method="POST" action="{{ route('admin.users.block', $u->id) }}"
                                                data-remark-prompt="Reason for blocking {{ $u->name }} (optional):">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-block">⛔ Block</button>
                                            </form>
                                        @endif

                                        @if ($u->status === 'blocked')
                                            <form method="POST" action="{{ route('admin.users.unblock', $u->id) }}"
                                                data-confirm="Unblock {{ $u->name }}?">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-approve">↺ Unblock</button>
                                            </form>
                                        @endif

                                        @if ($u->status === 'rejected')
                                            <form method="POST" action="{{ route('admin.users.approve', $u->id) }}"
                                                data-confirm="Approve {{ $u->name }} after all?">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-approve">✔ Approve</button>
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

            /* Actions cell: no label repetition needed above buttons, keep it minimal */
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

        /* ---------- Global safety: prevent page from stretching horizontally ---------- */
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
            /* contains any runaway children */
        }

        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            min-width: 0;
        }

        /* KEY FIX: flex children need min-width:0, warna .tabs apna scroll
             content parent ko force kar deta hai aur pura page fat jaata hai */
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

        /* ---------- Mobile ---------- */
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
    </style>
@endpush
