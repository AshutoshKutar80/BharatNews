@extends('layouts.app')

@section('title', 'My Payments - Bharat Integrity Forum News')
@section('meta_description', 'View your payment history - pending, successful and failed transactions.')

@section('content')

    <section class="up-hero">
        <div class="container">
            <span class="up-badge"><span class="up-dot"></span> My Account</span>
            <h1 class="up-title">My Payments</h1>
            <p class="up-subtitle">A full history of your transactions and their current status.</p>
        </div>
        <div class="up-shapes">
            <div class="up-shape up-shape-1"></div>
            <div class="up-shape up-shape-2"></div>
        </div>
    </section>

    <section class="up-section">
        <div class="container">
            @include('user.partials.subnav', ['active' => 'payments'])

            <div class="up-stats-grid">
                <div class="up-stat-card">
                    <span class="up-stat-number">{{ $allPayments->count() }}</span>
                    <span class="up-stat-label">Total</span>
                </div>
                <div class="up-stat-card">
                    <span class="up-stat-number up-text-warning">{{ $pending->count() }}</span>
                    <span class="up-stat-label">Pending</span>
                </div>
                <div class="up-stat-card">
                    <span class="up-stat-number up-text-success">{{ $success->count() }}</span>
                    <span class="up-stat-label">Success</span>
                </div>
                <div class="up-stat-card">
                    <span class="up-stat-number up-text-danger">{{ $failed->count() }}</span>
                    <span class="up-stat-label">Failed</span>
                </div>
            </div>

            <div class="up-card up-card-pad0">
                <div class="up-tabs" role="tablist">
                    <button class="up-tab active" data-tab="all">All</button>
                    <button class="up-tab" data-tab="pending">Pending</button>
                    <button class="up-tab" data-tab="success">Success</button>
                    <button class="up-tab" data-tab="failed">Failed</button>
                </div>

                @foreach (['all' => $allPayments, 'pending' => $pending, 'success' => $success, 'failed' => $failed] as $key => $rows)
                    <div class="up-tab-panel {{ $key === 'all' ? '' : 'up-hidden' }}" data-panel="{{ $key }}">
                        @if ($rows->isEmpty())
                            <div class="up-empty">
                                <p>No {{ $key === 'all' ? '' : $key }} payments found.</p>
                            </div>
                        @else
                            <div class="up-table-wrap">
                                <table class="up-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Amount</th>
                                            <th>Txn Ref</th>
                                            {{-- <th>Order ID</th> --}}
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $row)
                                            @php
                                                $status = strtolower($row->status ?? '');
                                                $cls = in_array($status, ['success'])
                                                    ? 'success'
                                                    : (in_array($status, ['failed', 'expired'])
                                                        ? 'danger'
                                                        : 'pending');
                                            @endphp
                                            <tr>
                                                <td data-label="Product">{{ $row->product_name }}</td>
                                                <td data-label="Amount">₹{{ number_format((float) $row->amount, 2) }}</td>
                                                <td data-label="Txn Ref">{{ $row->txn_ref ?? '—' }}</td>
                                                {{-- <td data-label="Order ID">{{ $row->order_id ?? '—' }}</td> --}}
                                                <td data-label="Status">
                                                    <span
                                                        class="up-pill up-pill-{{ $cls === 'danger' ? 'danger' : $cls }}">{{ ucfirst($row->status ?? '-') }}</span>
                                                </td>
                                                <td data-label="Date">{{ optional($row->date)->format('d M, Y h:i A') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('styles')
    @include('user.partials.styles')
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.up-tab');
            const panels = document.querySelectorAll('.up-tab-panel');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const target = this.dataset.tab;
                    panels.forEach(panel => {
                        panel.classList.toggle('up-hidden', panel.dataset.panel !== target);
                    });
                });
            });
        });
    </script>
@endpush
