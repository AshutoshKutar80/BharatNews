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
                <div class="table-scroll">
                    <table class="admin-table responsive-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Product</th>
                                <th>Product Amount</th>
                                <th>GST</th>
                                <th>Total Amount</th>
                                <th>Upgrade Remark</th>
                                <th>Txn Ref</th>
                                <th>Status</th>
                                <th>Tracking ID</th>
                                <th>Purchased</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                                <tr id="product-row-{{ $p->id }}">
                                    <td data-label="User">
                                        <div class="cell-name">{{ $p->user->name ?? 'N/A' }}</div>
                                        <div class="cell-sub">{{ $p->user->email ?? '' }}</div>
                                    </td>
                                    <td data-label="Product">{{ $p->product_name ?? $p->product_type }}</td>
                                    <td data-label="Product Amount">₹{{ number_format($p->amount, 0) }}</td>
                                    <td data-label="GST">₹{{ number_format($p->gst_amount, 0) }}</td>
                                    <td data-label="Total Amount">₹{{ number_format($p->total_amount, 0) }}</td>
                                    <td data-label="Upgrade Remark">
                                        @if ($p->remark)
                                            <span>
                                                {{ $p->remark ?? 'Upgraded' }}
                                            </span>
                                        @else
                                            <span style="color: #888; font-size: 12px;">—</span>
                                        @endif
                                    </td>
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
                                            @if ($p->admin_remark)
                                                <div class="cell-sub" title="{{ $p->admin_remark }}">📝
                                                    {{ \Illuminate\Support\Str::limit($p->admin_remark, 24) }}</div>
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
                                                data-amount="{{ number_format($p->total_amount, 0) }}"
                                                data-ref="{{ $p->txn_ref }}"
                                                data-is-upgrade="{{ $p->is_upgrade ? 'true' : 'false' }}"
                                                data-remark="{{ $p->remark ?? '' }}">
                                                ✔ Approve
                                            </button>
                                        @else
                                            <span class="cell-sub">Approved
                                                {{ optional($p->approved_at)->format('d M Y') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                        <label>Tracking ID <span style="color: #e74c3c;">*</span></label>
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
                    <button type="submit" class="btn-primary" id="approveSubmitBtn">
                        <span id="approveBtnText">Confirm & Approve</span>
                        <span id="approveLoader" style="display: none;">
                            <span class="spinner"></span> Processing...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===================== LOADER OVERLAY ===================== --}}
    <div id="approveLoaderOverlay"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 99999; align-items: center; justify-content: center; flex-direction: column;">
        <div
            style="background: #fff; padding: 40px; border-radius: 16px; text-align: center; max-width: 320px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
            <div
                style="width: 60px; height: 60px; margin: 0 auto 20px; border: 5px solid #f3f3f3; border-top: 5px solid #3498db; border-radius: 50%; animation: loaderSpin 1s linear infinite;">
            </div>
            <h3 style="color: #1a1a2e; margin: 0 0 8px 0; font-size: 18px;">Approving Order...</h3>
            <p style="color: #666; margin: 0; font-size: 14px;">Please wait while we process the approval</p>
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
        }

        #approveProductForm {
            padding: 30px;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-scroll {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* ============================================================
                            PANEL HEAD
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
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: #666;
            background: #f0f0f0;
            transition: all 0.3s;
        }

        .tab-link:hover {
            background: #e0e0e0;
        }

        .tab-link.active {
            background: #3498db;
            color: #fff;
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
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .search-box button {
            padding: 8px 16px;
            background: #3498db;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .search-box button:hover {
            background: #2980b9;
        }

        /* ============================================================
                            TABLE STYLES
                        ============================================================ */
        .admin-table th {
            background: #f8f9fa;
            padding: 10px 8px;
            text-align: left;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #e0e0e0;
        }

        .admin-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .admin-table tbody tr:hover {
            background: #f8f9fa;
        }

        .cell-name {
            font-weight: 600;
        }

        .cell-sub {
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }

        .badge-status {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-status.approved {
            background: #d4edda;
            color: #155724;
        }

        .btn-sm {
            padding: 5px 12px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-approve {
            background: #2ecc71;
            color: #fff;
        }

        .btn-approve:hover {
            background: #27ae60;
        }

        .btn-approve:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #888;
        }

        .empty-state .ic {
            font-size: 48px;
            display: block;
            margin-bottom: 10px;
        }

        .pagination-wrap {
            padding: 16px 0;
            display: flex;
            justify-content: center;
        }

        /* ============================================================
                            MODAL STYLES
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
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            border-bottom: 1px solid #f0f0f0;
        }

        .modal-head h4 {
            margin: 0;
            color: #1a1a2e;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #888;
            padding: 0 4px;
        }

        .modal-close:hover {
            color: #e74c3c;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-summary {
            background: #f8f9fa;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .modal-summary .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            font-size: 14px;
        }

        .modal-summary .summary-row .label {
            color: #888;
        }

        .modal-summary .summary-row .value {
            font-weight: 600;
            color: #1a1a2e;
        }

        .modal-summary .summary-row.upgrade {
            color: #9b59b6;
            background: #f0e6f5;
            padding: 6px 10px;
            border-radius: 6px;
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
            font-size: 14px;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .modal-foot {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding: 16px 24px;
            border-top: 1px solid #f0f0f0;
        }

        .modal-foot button {
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-cancel {
            background: #f0f0f0;
            color: #666;
        }

        .btn-cancel:hover {
            background: #e0e0e0;
        }

        .btn-primary {
            background: #3498db;
            color: #fff;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* ============================================================
                            LOADER STYLES
                        ============================================================ */
        @keyframes loaderSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: loaderSpin 0.8s linear infinite;
            vertical-align: middle;
            margin-right: 6px;
        }

        #approveLoaderOverlay.show {
            display: flex !important;
        }

        /* ============================================================
                            RESPONSIVE - MOBILE
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

            .table-scroll {
                overflow-x: visible;
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
                            RESPONSIVE - TABLET
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

            .admin-table {
                font-size: 0.88rem;
                min-width: 900px;
            }

            .admin-table th,
            .admin-table td {
                padding: 8px 6px;
                white-space: nowrap;
            }

            .cell-sub {
                font-size: 0.75rem;
            }

            .modal-box {
                max-width: 440px;
            }
        }

        /* ============================================================
                            RESPONSIVE - LAPTOP
                        ============================================================ */
        @media (min-width: 992px) and (max-width: 1199px) {
            .panel {
                padding: 20px;
            }

            .admin-table {
                font-size: 0.92rem;
                min-width: 1000px;
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
                            RESPONSIVE - DESKTOP
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
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const modal = document.getElementById('approveProductModal');
            const form = document.getElementById('approveProductForm');
            const summary = document.getElementById('approveProductSummary');
            const trackingInput = document.getElementById('trackingIdInput');
            const remarkInput = document.getElementById('remarkInput');
            const submitBtn = document.getElementById('approveSubmitBtn');
            const btnText = document.getElementById('approveBtnText');
            const btnLoader = document.getElementById('approveLoader');
            const loaderOverlay = document.getElementById('approveLoaderOverlay');

            // Open modal
            document.querySelectorAll('.js-open-approve-modal').forEach(btn => {
                btn.addEventListener('click', function() {
                    const actionUrl = this.dataset.actionUrl;
                    const user = this.dataset.user;
                    const product = this.dataset.product;
                    const amount = this.dataset.amount;
                    const ref = this.dataset.ref;
                    const isUpgrade = this.dataset.isUpgrade === 'true';
                    const remark = this.dataset.remark || '';

                    // Set form action
                    form.action = actionUrl;

                    // Build summary
                    let summaryHtml = `
                        <div class="summary-row">
                            <span class="label">User</span>
                            <span class="value">${user}</span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Product</span>
                            <span class="value">${product}</span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Amount</span>
                            <span class="value">₹${amount}</span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Transaction Ref</span>
                            <span class="value" style="font-family: monospace; font-size: 12px;">${ref}</span>
                        </div>
                    `;

                    if (isUpgrade) {
                        summaryHtml += `
                            <div class="summary-row upgrade">
                                🔄 This is an UPGRADE purchase
                                ${remark ? `<br><small style="color: #6c3483;">${remark}</small>` : ''}
                            </div>
                        `;
                    }

                    summary.innerHTML = summaryHtml;

                    // Clear form fields
                    trackingInput.value = '';
                    remarkInput.value = '';

                    // Show modal
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';

                    // Focus on tracking input
                    setTimeout(() => trackingInput.focus(), 100);
                });
            });

            // Close modal functions
            function closeModal() {
                modal.classList.remove('active');
                document.body.style.overflow = '';
                // Reset button state
                btnText.style.display = 'inline';
                btnLoader.style.display = 'none';
                submitBtn.disabled = false;
            }

            document.querySelectorAll('[data-close-modal]').forEach(el => {
                el.addEventListener('click', closeModal);
            });

            // Close on overlay click
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    closeModal();
                }
            });

            // ============================================================
            // FORM SUBMIT WITH LOADER
            // ============================================================
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate tracking ID
                if (!trackingInput.value.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tracking ID Required',
                        text: 'Please enter a tracking ID for this order.',
                        confirmButtonColor: '#3498db'
                    });
                    trackingInput.focus();
                    return;
                }

                // Show loader in button
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline';
                submitBtn.disabled = true;

                // Show full page loader overlay
                loaderOverlay.style.display = 'flex';
                loaderOverlay.classList.add('show');

                // Submit form via AJAX
                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Hide loader
                        loaderOverlay.style.display = 'none';
                        loaderOverlay.classList.remove('show');

                        if (data.success) {
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Approved Successfully!',
                                text: data.message ||
                                    'The product has been approved and tracking ID assigned.',
                                confirmButtonColor: '#2ecc71',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Close modal
                                closeModal();
                                // Reload page to show updated status
                                window.location.reload();
                            });
                        } else {
                            // Show error
                            Swal.fire({
                                icon: 'error',
                                title: 'Approval Failed',
                                text: data.message || 'Something went wrong. Please try again.',
                                confirmButtonColor: '#e74c3c'
                            });
                            // Reset button
                            btnText.style.display = 'inline';
                            btnLoader.style.display = 'none';
                            submitBtn.disabled = false;
                        }
                    })
                    .catch(error => {
                        // Hide loader
                        loaderOverlay.style.display = 'none';
                        loaderOverlay.classList.remove('show');

                        console.error('Approval error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again.',
                            confirmButtonColor: '#e74c3c'
                        });

                        // Reset button
                        btnText.style.display = 'inline';
                        btnLoader.style.display = 'none';
                        submitBtn.disabled = false;
                    });
            });
        });
    </script>
@endpush
