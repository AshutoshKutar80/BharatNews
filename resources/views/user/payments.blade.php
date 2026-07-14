@extends('layouts.app')

@section('title', 'My Payments - Bharat Integrity Forum News')
@section('meta_description', 'View your successful payment history.')

@section('content')

    <section class="up-hero">
        <div class="container">
            <span class="up-badge"><span class="up-dot"></span> My Account</span>
            <h1 class="up-title">My Payments</h1>
            <p class="up-subtitle">A history of your successful transactions.</p>
        </div>
        <div class="up-shapes">
            <div class="up-shape up-shape-1"></div>
            <div class="up-shape up-shape-2"></div>
        </div>
    </section>

    <section class="up-section">
        <div class="container">
            @include('user.partials.subnav', ['active' => 'payments'])

            {{-- <div class="up-stats-grid">
                <div class="up-stat-card">
                    <span class="up-stat-number up-text-success">{{ $payments->count() }}</span>
                    <span class="up-stat-label">Successful Payments</span>
                </div>
            </div> --}}

            <div class="up-card up-card-pad0">
                @if ($payments->isEmpty())
                    <div class="up-empty">
                        <p>No successful payments found.</p>
                    </div>
                @else
                    <div class="up-table-wrap">
                        <table class="up-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Txn Ref</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $row)
                                    <tr>
                                        <td data-label="Product">{{ $row->product_name }}</td>
                                        <td data-label="Amount">₹{{ number_format((float) $row->amount, 2) }}</td>
                                        <td data-label="Txn Ref">{{ $row->txn_ref ?? '—' }}</td>
                                        <td data-label="Status">
                                            <span class="up-pill up-pill-success">{{ ucfirst($row->status) }}</span>
                                        </td>
                                        <td data-label="Date">{{ optional($row->paid_at)->format('d M, Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection

@push('styles')
    @include('user.partials.styles')
@endpush
