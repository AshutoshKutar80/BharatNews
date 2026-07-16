@extends('admin.layout')

@section('title', 'Pending Payments')
@section('page-title', 'Pending Payments')
@section('page-subtitle', 'Approve or delete pending payments')

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

        /* Panel Styles */
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

        .btn-approve {
            background: #059669;
            color: white;
        }

        .btn-approve:hover {
            background: #047857;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }

        .btn-reject:hover {
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

        /* Search box */
        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-box input[type="text"] {
            padding: 8px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            min-width: 240px;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .search-box input[type="text"]:focus {
            border-color: #0f172a;
        }

        .search-box .btn-search {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            background: #0f172a;
            color: white;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
        }

        .search-box .btn-search:hover {
            background: #1e293b;
        }

        .search-box .btn-clear {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
            font-size: 13px;
            text-decoration: none;
        }

        .search-box .btn-clear:hover {
            background: #f1f5f9;
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

        @media (max-width: 640px) {
            .pagination-wrap .pagination .page-link {
                min-width: 34px;
                height: 34px;
                font-size: 13px;
                padding: 0 10px;
            }

            .search-box {
                width: 100%;
            }

            .search-box input[type="text"] {
                min-width: 0;
                flex: 1;
            }
        }
    </style>



    {{-- Pending Payments Panel --}}
    <div class="panel">
        <div class="panel-head">
            <h3>⏳ Pending / Temp Payments</h3>

            <form method="GET" action="{{ route('admin.payments') }}" class="search-box">
                <input type="hidden" name="tab" value="{{ $tab }}">
                <input type="text" name="search" value="{{ $search }}"
                    placeholder="Search name, email, txn ref, product...">
                <button type="submit" class="btn-search">🔍 Search</button>
                @if ($search)
                    <a href="{{ route('admin.payments', ['tab' => $tab]) }}" class="btn-clear">✕ Clear</a>
                @endif
            </form>

            <span class="badge-status pending">{{ $tempPayments->total() }} total</span>
        </div>
        <div class="panel-body">
            @if ($tempPayments->isEmpty())
                <div class="empty-state">
                    <div class="ic">💳</div>
                    @if ($search)
                        No pending payments found for "{{ $search }}".
                    @else
                        No pending payments.
                    @endif
                </div>
            @else
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Product</th>
                            <th>Product Amount</th>
                            <th>GST</th>
                            <th>Total Amount</th>
                            <th>Txn Ref</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tempPayments as $tp)
                            <tr>
                                <td>
                                    <div class="cell-name">{{ $tp->user_name }}</div>
                                    <div class="cell-sub">{{ $tp->user_email }}</div>
                                </td>
                                <td>{{ $tp->product_type }}</td>
                                <td>₹{{ number_format($tp->amount, 0) }}</td>
                                <td>₹{{ number_format($tp->gst_amount, 0) }}</td>
                                <td>₹{{ number_format($tp->total_amount, 0) }}</td>
                                <td>{{ $tp->txn_ref }}</td>
                                <td><span class="badge-status {{ $tp->status }}">{{ $tp->status }}</span></td>
                                <td>{{ $tp->created_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    <div class="row-actions">
                                        <form method="POST" action="{{ route('admin.payments.approve', $tp->id) }}"
                                            data-confirm="Approve this payment of ₹{{ $tp->amount }} for {{ $tp->user_name }}? This will move it to successful payments."
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-approve">✔ Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.payments.delete', $tp->id) }}"
                                            data-confirm="Delete this pending payment record? This cannot be undone."
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-reject">🗑 Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        @if ($tempPayments->hasPages())
            <div class="pagination-wrap">
                {{ $tempPayments->appends(['tab' => 'pending', 'search' => $search])->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
