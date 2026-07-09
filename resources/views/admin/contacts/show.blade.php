@extends('admin.layout')

@section('title', 'Contact Message Details')
@section('page-title', 'Contact Message')
@section('page-subtitle', 'View and reply to contact inquiry')

@section('content')
    <style>
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #0f172a;
        }

        .detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .detail-header {
            padding: 20px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .detail-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }

        .detail-body {
            padding: 24px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .detail-item {
            margin-bottom: 16px;
        }

        .detail-item label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-item .value {
            font-size: 15px;
            color: #0f172a;
            padding: 8px 12px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .detail-item .value.large {
            min-height: 80px;
            white-space: pre-wrap;
        }

        .detail-item .value .attachment-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .detail-item .value .attachment-link:hover {
            text-decoration: underline;
        }

        .reply-box {
            background: #f0fdf4;
            border: 2px solid #86efac;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .reply-box .reply-text {
            background: white;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            white-space: pre-wrap;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.read {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-badge.replied {
            background: #d1fae5;
            color: #065f46;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
        }

        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            resize: vertical;
            font-family: inherit;
            outline: none;
            min-height: 150px;
        }

        .form-group textarea:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-group .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }

        .btn-send {
            padding: 12px 35px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-send:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .btn-send:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <a href="{{ route('admin.contacts.index') }}" class="back-link">
        ← Back to All Messages
    </a>

    {{-- Contact Details --}}
    <div class="detail-card">
        <div class="detail-header">
            <h3>📬 Message from {{ $contact->name }}</h3>
            <span class="status-badge {{ $contact->status }}">
                {{ ucfirst($contact->status) }}
            </span>
        </div>
        <div class="detail-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <label>👤 Name</label>
                    <div class="value">{{ $contact->name }}</div>
                </div>
                <div class="detail-item">
                    <label>📧 Email</label>
                    <div class="value">
                        <a href="mailto:{{ $contact->email }}" style="color: #3b82f6; text-decoration: none;">
                            {{ $contact->email }}
                        </a>
                    </div>
                </div>
                <div class="detail-item">
                    <label>📱 Mobile</label>
                    <div class="value">
                        <a href="tel:{{ $contact->mobile }}" style="color: #3b82f6; text-decoration: none;">
                            {{ $contact->mobile }}
                        </a>
                    </div>
                </div>
                <div class="detail-item">
                    <label>📋 Subject</label>
                    <div class="value">{{ ucfirst(str_replace('-', ' ', $contact->subject)) }}</div>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <label>📝 Message</label>
                    <div class="value large">{{ $contact->message }}</div>
                </div>
                @if ($contact->attachment)
                    <div class="detail-item">
                        <label>📎 Attachment</label>
                        <div class="value">
                            <a href="{{ asset('storage/' . $contact->attachment) }}" target="_blank"
                                class="attachment-link">
                                📄 Download Attachment
                            </a>
                        </div>
                    </div>
                @endif
                <div class="detail-item">
                    <label>📅 Received</label>
                    <div class="value">{{ $contact->created_at->format('d M Y, h:i A') }}</div>
                </div>
                @if ($contact->status === 'replied' && $contact->replied_at)
                    <div class="detail-item">
                        <label>✅ Replied On</label>
                        <div class="value">{{ $contact->replied_at->format('d M Y, h:i A') }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Reply Section --}}
    <div class="detail-card" id="reply-section">
        <div class="detail-header">
            <h3>✉️ Reply to {{ $contact->name }}</h3>
        </div>
        <div class="detail-body">
            @if ($contact->status === 'replied')
                {{-- Show previous reply --}}
                <div class="reply-box">
                    <h4 style="color: #065f46; margin-bottom: 10px;">✅ Previous Reply</h4>
                    <div class="reply-text">{{ $contact->admin_reply }}</div>
                    <div style="margin-top: 10px; font-size: 13px; color: #94a3b8;">
                        Sent on {{ $contact->replied_at->format('d M Y, h:i A') }}
                    </div>
                </div>
                <div style="margin-top: 20px;">
                    <a href="{{ route('admin.contacts.index') }}" class="btn-send"
                        style="background: #3b82f6; text-decoration: none;">
                        📋 Back to Messages
                    </a>
                </div>
            @else
                {{-- Reply form --}}
                <form method="POST" action="{{ route('admin.contacts.reply', $contact->id) }}" id="replyForm">
                    @csrf
                    <div class="form-group">
                        <label for="reply">Your Reply <span style="color: #e74c3c;">*</span></label>
                        <textarea id="reply" name="reply" rows="6" placeholder="Write your reply here..." required>{{ old('reply') }}</textarea>
                        @error('reply')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <button type="submit" class="btn-send" id="sendBtn">
                            ✉️ Send Reply
                        </button>
                        <a href="{{ route('admin.contacts.index') }}"
                            style="padding: 12px 30px; background: #e2e8f0; color: #475569; border-radius: 10px; text-decoration: none; font-weight: 500; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px;"
                            onmouseover="this.style.background='#cbd5e1'" onmouseout="this.style.background='#e2e8f0'">
                            ← Cancel
                        </a>
                    </div>
                </form>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const replyForm = document.getElementById('replyForm');
                if (replyForm) {
                    replyForm.addEventListener('submit', function(e) {
                        const btn = document.getElementById('sendBtn');
                        btn.disabled = true;
                        btn.innerHTML = '⏳ Sending...';
                    });
                }
            });
        </script>
    @endpush
@endsection
