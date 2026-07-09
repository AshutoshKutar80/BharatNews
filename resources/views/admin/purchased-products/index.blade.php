@extends('admin.layout')

@section('title', 'Purchased Products')
@section('page-title', 'Purchased Products')
@section('page-subtitle', 'Approve orders and assign tracking IDs')

@section('content')

    <div class="panel">
        <div class="panel-head">
            <div class="tabs">
                <a href="{{ route('admin.purchased-products', ['status' => 'all']) }}"
                    class="tab-link {{ $status === 'all' ? 'active' : '' }}">All</a>
                <a href="{{ route('admin.purchased-products', ['status' => 'pending']) }}"
                    class="tab-link {{ $status === 'pending' ? 'active' : '' }}">Pending</a>
                <a href="{{ route('admin.purchased-products', ['status' => 'approved']) }}"
                    class="tab-link {{ $status === 'approved' ? 'active' : '' }}">Approved / Dispatched</a>
            </div>

            <form class="search-box" method="GET" action="{{ route('admin.purchased-products') }}">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="text" name="search" placeholder="Search user, product, txn ref, tracking id..."
                    value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="panel-body">
            @if ($products->isEmpty())
                <div class="empty-state">
                    <div class="ic">📦</div>No purchased products found.
                </div>
            @else
                <table class="admin-table responsive-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Txn Ref</th>
                            <th>Status</th>
                            <th>Tracking ID</th>
                            <th>Purchased</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td data-label="User">
                                    <div class="cell-name">{{ $p->user->name ?? 'N/A' }}</div>
                                    <div class="cell-sub">{{ $p->user->email ?? '' }}</div>
                                </td>
                                <td data-label="Product">{{ $p->product_name ?? $p->product_type }}</td>
                                <td data-label="Amount">₹{{ number_format($p->amount, 0) }}</td>
                                <td data-label="Txn Ref">{{ $p->txn_ref }}</td>
                                <td data-label="Status">
                                    @if ($p->is_approved)
                                        <span class="badge-status approved">Dispatched</span>
                                    @else
                                        <span class="badge-status pending">Pending</span>
                                    @endif
                                </td>
                                <td data-label="Tracking ID">
                                    @if ($p->tracking_id)
                                        <strong>{{ $p->tracking_id }}</strong>
                                        @if ($p->remark)
                                            <div class="cell-sub" title="{{ $p->remark }}">📝
                                                {{ \Illuminate\Support\Str::limit($p->remark, 24) }}</div>
                                        @endif
                                    @else
                                        <span class="cell-sub">—</span>
                                    @endif
                                </td>
                                <td data-label="Purchased">{{ optional($p->purchased_at)->format('d M Y') }}</td>
                                <td data-label="Actions">
                                    @if (!$p->is_approved)
                                        <button type="button" class="btn-sm btn-approve js-open-approve-modal"
                                            data-action-url="{{ route('admin.purchased-products.approve', $p->id) }}"
                                            data-id="{{ $p->id }}" data-user="{{ $p->user->name ?? 'N/A' }}"
                                            data-product="{{ $p->product_name ?? $p->product_type }}"
                                            data-amount="{{ number_format($p->amount, 0) }}"
                                            data-ref="{{ $p->txn_ref }}">✔ Approve</button>
                                    @else
                                        <span class="cell-sub">Approved
                                            {{ optional($p->approved_at)->format('d M Y') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        @if ($products->hasPages())
            <div class="pagination-wrap">{{ $products->links() }}</div>
        @endif
    </div>

    {{-- ===================== APPROVAL MODAL ===================== --}}
    <div class="modal-overlay" id="approveProductModal">
        <div class="modal-box">
            <div class="modal-head">
                <h4>Approve Purchased Product</h4>
                <button type="button" class="modal-close" data-close-modal>✕</button>
            </div>
            <form id="approveProductForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="modal-summary" id="approveProductSummary"></div>

                    <div class="form-group">
                        <label>Tracking ID</label>
                        <input type="text" id="trackingIdInput" name="tracking_id"
                            placeholder="Enter courier tracking ID" required>
                    </div>

                    <div class="form-group">
                        <label>Remark</label>
                        <textarea id="remarkInput" name="remark" rows="3" placeholder="Optional note for this order"></textarea>
                    </div>
                </div>
                <div class="modal-foot">
                    <button type="button" class="btn-cancel" data-close-modal>Cancel</button>
                    <button type="submit" class="btn-primary">Confirm & Approve</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* ============================================================
             GLOBAL SAFETY
             ============================================================ */
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

        #approveProductForm {
            padding: 30px;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* ============================================================
             PANEL HEAD: tabs + search (base / mobile-first styles)
             ============================================================ */
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

        /* ============================================================
             MOBILE  (≤ 576px)
             ============================================================ */
        @media (max-width: 576px) {
            .panel {
                padding: 12px;
                border-radius: 8px;
            }

            .panel-head {
                flex-direction: column;
                align-items: stretch;
            }

            .tabs {
                width: 100%;
            }

            .tab-link {
                font-size: 0.82rem;
                padding: 6px 10px;
            }

            .search-box {
                width: 100%;
                flex-wrap: wrap;
            }

            .search-box input[type="text"] {
                flex: 1 1 100%;
            }

            .search-box button {
                flex: 1;
            }

            /* Table -> stacked cards */
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
                font-size: 0.85rem;
            }

            .responsive-table td::before {
                content: attr(data-label);
                display: block;
                font-weight: 600;
                font-size: 0.7rem;
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

            .responsive-table td[data-label="Actions"] .btn-sm {
                width: 100%;
                text-align: center;
                justify-content: center;
                margin-bottom: 6px;
            }

            .modal-box {
                max-width: 100%;
                border-radius: 10px;
                margin: 0 16px;
            }

            .modal-foot {
                flex-direction: column-reverse;
                gap: 8px;
            }

            .modal-foot button {
                width: 100%;
            }
        }

        /* ============================================================
             TABLET  (577px – 991px)
             ============================================================ */
        @media (min-width: 577px) and (max-width: 991px) {
            .panel {
                padding: 16px;
            }

            .panel-head {
                flex-wrap: wrap;
            }

            .tabs {
                order: 1;
                width: 100%;
            }

            .search-box {
                order: 2;
                width: 100%;
                margin-top: 8px;
            }

            .search-box input[type="text"] {
                flex: 1;
            }

            /* Keep real table, but shrink some columns / font */
            .admin-table {
                font-size: 0.88rem;
            }

            .admin-table th,
            .admin-table td {
                padding: 8px 6px;
            }

            .cell-sub {
                font-size: 0.75rem;
            }

            .row-actions,
            td[data-label="Actions"] {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
            }

            .modal-box {
                max-width: 440px;
            }
        }

        /* ============================================================
             LAPTOP  (992px – 1199px)
             ============================================================ */
        @media (min-width: 992px) and (max-width: 1199px) {
            .panel {
                padding: 20px;
            }

            .admin-table {
                font-size: 0.92rem;
            }

            .admin-table th,
            .admin-table td {
                padding: 10px 8px;
            }

            .modal-box {
                max-width: 460px;
            }
        }

        /* ============================================================
             DESKTOP  (≥ 1200px)
             ============================================================ */
        @media (min-width: 1200px) {
            .panel {
                padding: 24px;
            }

            .admin-table {
                font-size: 1rem;
            }

            .admin-table th,
            .admin-table td {
                padding: 12px 10px;
            }

            .panel-head {
                flex-wrap: nowrap;
            }

            .search-box {
                max-width: 340px;
            }

            .modal-box {
                max-width: 480px;
            }
        }

        /* ============================================================
             MODAL BASE (all sizes)
             ============================================================ */
        .modal-overlay {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            padding: 16px;
            z-index: 1000;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            background: #fff;
            border-radius: 12px;
        }
    </style>
@endpush
