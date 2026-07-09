@extends('layouts.app')

@section('title', 'My Contacts - Bharat Integrity Forum News')
@section('meta_description', 'View the status of the messages you have submitted to Bharat Integrity Forum News.')

@section('content')

    <section class="up-hero">
        <div class="container">
            <span class="up-badge"><span class="up-dot"></span> My Account</span>
            <h1 class="up-title">My Contact Messages</h1>
            <p class="up-subtitle">Track the status of messages you've sent us.</p>
        </div>
        <div class="up-shapes">
            <div class="up-shape up-shape-1"></div>
            <div class="up-shape up-shape-2"></div>
        </div>
    </section>

    <section class="up-section">
        <div class="container">
            @include('user.partials.subnav', ['active' => 'contacts'])

            <div class="up-card up-card-pad0">
                @if ($contacts->isEmpty())
                    <div class="up-empty">
                        <p>You haven't sent us any messages yet.</p>
                        <a href="{{ route('contact') }}" class="up-btn">Contact Us</a>
                    </div>
                @else
                    <div class="up-table-wrap">
                        <table class="up-table">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Reply</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td data-label="Subject">{{ $contact->subject ?? '-' }}</td>
                                        <td data-label="Message" class="up-truncate">
                                            {{ \Illuminate\Support\Str::limit($contact->message, 80) }}</td>
                                        <td data-label="Status">
                                            @php
                                                $map = [
                                                    'pending' => 'pending',
                                                    'read' => 'processing',
                                                    'replied' => 'success',
                                                ];
                                                $cls = $map[$contact->status] ?? 'pending';
                                            @endphp
                                            <span
                                                class="up-pill up-pill-{{ $cls }}">{{ ucfirst($contact->status ?? 'pending') }}</span>
                                        </td>
                                        <td data-label="Reply" class="up-truncate">
                                            {{ $contact->admin_reply ? \Illuminate\Support\Str::limit($contact->admin_reply, 60) : '—' }}
                                        </td>
                                        <td data-label="Date">{{ optional($contact->created_at)->format('d M, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="up-pagination">
                        {{ $contacts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection

@push('styles')
    @include('user.partials.styles')
@endpush
