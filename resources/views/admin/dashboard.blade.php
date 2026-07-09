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
      @if($recentUsers->isEmpty())
        <div class="empty-state"><div class="ic">👥</div>No users yet.</div>
      @else
        <table class="admin-table">
          <thead>
            <tr><th>Name</th><th>Email</th><th>City</th><th>Status</th><th>Registered</th></tr>
          </thead>
          <tbody>
            @foreach($recentUsers as $u)
              <tr>
                <td class="cell-name">{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->city }}</td>
                <td><span class="badge-status {{ $u->status }}">{{ $u->status }}</span></td>
                <td>{{ $u->created_at->format('d M Y') }}</td>
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
      @if($recentPayments->isEmpty())
        <div class="empty-state"><div class="ic">💳</div>No successful payments yet.</div>
      @else
        <table class="admin-table">
          <thead>
            <tr><th>User</th><th>Product</th><th>Amount</th><th>Txn Ref</th><th>Paid At</th></tr>
          </thead>
          <tbody>
            @foreach($recentPayments as $p)
              <tr>
                <td class="cell-name">{{ $p->user_name }}</td>
                <td>{{ $p->product_type }}</td>
                <td>₹{{ number_format($p->amount, 0) }}</td>
                <td>{{ $p->txn_ref }}</td>
                <td>{{ optional($p->paid_at)->format('d M Y, h:i A') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>

@endsection
