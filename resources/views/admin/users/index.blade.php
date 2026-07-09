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
                <table class="admin-table">
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
                                <td>
                                    <div class="cell-name">{{ $u->name }}</div>
                                    <div class="cell-sub">{{ $u->email }}</div>
                                </td>
                                <td>{{ $u->mobile ?? '—' }}</td>
                                <td>
                                    {{ $u->city }}
                                    <div class="cell-sub">{{ $u->tehsil }}, {{ $u->district }}, {{ $u->state }} -
                                        {{ $u->pincode }}</div>
                                </td>
                                <td>
                                    <span class="badge-status {{ $u->status }}">{{ $u->status }}</span>
                                    @if ($u->admin_remark)
                                        <div class="cell-sub" title="{{ $u->admin_remark }}">📝
                                            {{ \Illuminate\Support\Str::limit($u->admin_remark, 30) }}</div>
                                    @endif
                                </td>
                                <td>{{ $u->created_at->format('d M Y') }}</td>
                                <td>
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
