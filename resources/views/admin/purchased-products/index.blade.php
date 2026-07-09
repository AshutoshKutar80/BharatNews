@extends('admin.layout')

@section('title', 'Purchased Products')
@section('page-title', 'Purchased Products')
@section('page-subtitle', 'Approve orders and assign tracking IDs')

@section('content')

  <div class="panel">
    <div class="panel-head">
      <div class="tabs">
        <a href="{{ route('admin.purchased-products', ['status' => 'all']) }}" class="tab-link {{ $status === 'all' ? 'active' : '' }}">All</a>
        <a href="{{ route('admin.purchased-products', ['status' => 'pending']) }}" class="tab-link {{ $status === 'pending' ? 'active' : '' }}">Pending</a>
        <a href="{{ route('admin.purchased-products', ['status' => 'approved']) }}" class="tab-link {{ $status === 'approved' ? 'active' : '' }}">Approved / Dispatched</a>
      </div>
    </div>

    <div class="panel-body">
      @if($products->isEmpty())
        <div class="empty-state"><div class="ic">📦</div>No purchased products found.</div>
      @else
        <table class="admin-table">
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
            @foreach($products as $p)
              <tr>
                <td>
                  <div class="cell-name">{{ $p->user->name ?? 'N/A' }}</div>
                  <div class="cell-sub">{{ $p->user->email ?? '' }}</div>
                </td>
                <td>{{ $p->product_name ?? $p->product_type }}</td>
                <td>₹{{ number_format($p->amount, 0) }}</td>
                <td>{{ $p->txn_ref }}</td>
                <td>
                  @if($p->is_approved)
                    <span class="badge-status approved">Dispatched</span>
                  @else
                    <span class="badge-status pending">Pending</span>
                  @endif
                </td>
                <td>
                  @if($p->tracking_id)
                    <strong>{{ $p->tracking_id }}</strong>
                    @if($p->remark)
                      <div class="cell-sub" title="{{ $p->remark }}">📝 {{ \Illuminate\Support\Str::limit($p->remark, 24) }}</div>
                    @endif
                  @else
                    <span class="cell-sub">—</span>
                  @endif
                </td>
                <td>{{ optional($p->purchased_at)->format('d M Y') }}</td>
                <td>
                  @if(!$p->is_approved)
                    <button
                      type="button"
                      class="btn-sm btn-approve js-open-approve-modal"
                      data-action-url="{{ route('admin.purchased-products.approve', $p->id) }}"
                      data-id="{{ $p->id }}"
                      data-user="{{ $p->user->name ?? 'N/A' }}"
                      data-product="{{ $p->product_name ?? $p->product_type }}"
                      data-amount="{{ number_format($p->amount, 0) }}"
                      data-ref="{{ $p->txn_ref }}"
                    >✔ Approve</button>
                  @else
                    <span class="cell-sub">Approved {{ optional($p->approved_at)->format('d M Y') }}</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>

    @if($products->hasPages())
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
            <input type="text" id="trackingIdInput" name="tracking_id" placeholder="Enter courier tracking ID" required>
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
