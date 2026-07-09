@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of users, payments and orders')

@section('content')

    <div class="stat-grid">
        <div class="stat-card">
            <div class="ic">👥</div>
            <div>
                <div class="num">{{ $stats['total_users'] }}</div>
                <div class="lbl">Total Users</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="ic">⏳</div>
            <div>
                <div class="num">{{ $stats['pending_users'] }}</div>
                <div class="lbl">Pending Approval</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="ic">🚫</div>
            <div>
                <div class="num">{{ $stats['blocked_users'] }}</div>
                <div class="lbl">Blocked Users</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="ic">✅</div>
            <div>
                <div class="num">{{ $stats['approved_users'] }}</div>
                <div class="lbl">Approved Users</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="ic">💳</div>
            <div>
                <div class="num">{{ $stats['pending_payments'] }}</div>
                <div class="lbl">Pending Payments</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="ic">💰</div>
            <div>
                <div class="num">₹{{ number_format($stats['revenue'], 0) }}</div>
                <div class="lbl">Total Revenue</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="ic">📦</div>
            <div>
                <div class="num">{{ $stats['purchased_pending'] }}</div>
                <div class="lbl">Orders Awaiting Tracking</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="ic">🚚</div>
            <div>
                <div class="num">{{ $stats['purchased_approved'] }}</div>
                <div class="lbl">Orders Dispatched</div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <h3>Recently Registered Users</h3>
            <a href="{{ route('admin.users') }}" class="btn-sm btn-ghost">View all →</a>
        </div>
        <div class="panel-body">
            @if ($recentUsers->isEmpty())
                <div class="empty-state">
                    <div class="ic">👥</div>No users yet.
                </div>
            @else
                <table class="admin-table responsive-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentUsers as $u)
                            <tr>
                                <td class="cell-name" data-label="Name">{{ $u->name }}</td>
                                <td data-label="Email">{{ $u->email }}</td>
                                <td data-label="City">{{ $u->city }}</td>
                                <td data-label="Status"><span
                                        class="badge-status {{ $u->status }}">{{ $u->status }}</span></td>
                                <td data-label="Registered">{{ $u->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <h3>Recent Successful Payments</h3>
            <a href="{{ route('admin.payments') }}" class="btn-sm btn-ghost">View all →</a>
        </div>
        <div class="panel-body">
            @if ($recentPayments->isEmpty())
                <div class="empty-state">
                    <div class="ic">💳</div>No successful payments yet.
                </div>
            @else
                <table class="admin-table responsive-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Txn Ref</th>
                            <th>Paid At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentPayments as $p)
                            <tr>
                                <td class="cell-name" data-label="User">{{ $p->user_name }}</td>
                                <td data-label="Product">{{ $p->product_type }}</td>
                                <td data-label="Amount">₹{{ number_format($p->amount, 0) }}</td>
                                <td data-label="Txn Ref">{{ $p->txn_ref }}</td>
                                <td data-label="Paid At">{{ optional($p->paid_at)->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* ---------- Stat cards: responsive grid ---------- */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            /* prevent overflow inside grid */
        }

        .stat-card .num {
            font-size: 1.25rem;
            font-weight: 700;
            word-break: break-word;
        }

        .stat-card .lbl {
            font-size: 0.8rem;
            opacity: 0.75;
        }

        .stat-card .ic {
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        /* ---------- Panels ---------- */
        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* ---------- Tablet ---------- */
        @media (max-width: 768px) {
            .stat-grid {
                grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
                gap: 12px;
            }

            .panel {
                padding: 12px;
            }
        }

        /* ---------- Mobile: cards instead of tables ---------- */
        @media (max-width: 576px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat-card {
                padding: 12px;
            }

            .stat-card .num {
                font-size: 1.05rem;
            }

            .stat-card .lbl {
                font-size: 0.72rem;
            }

            /* Convert table to stacked cards */
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
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
                padding: 6px 0;
                border: none;
                text-align: right;
                font-size: 0.85rem;
            }

            .responsive-table td::before {
                content: attr(data-label);
                font-weight: 600;
                font-size: 0.75rem;
                opacity: 0.6;
                text-align: left;
                flex-shrink: 0;
            }

            .responsive-table td.cell-name {
                font-weight: 600;
            }
        }

        /* ---------- Extra-small screens ---------- */
        @media (max-width: 380px) {
            .stat-grid {
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }
        }
    </style>
@endpush
