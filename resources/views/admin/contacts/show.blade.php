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

        .detail-item.full-width {
            grid-column: 1 / -1;
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
            word-break: break-word;
        }

        .detail-item .value.large {
            min-height: 80px;
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

        /* Attachment Preview Styles */
        .attachment-wrapper {
            margin-top: 4px;
        }

        .preview-thumbnail {
            max-width: 200px;
            max-height: 150px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.2s ease;
            object-fit: contain;
            display: block;
        }

        .preview-thumbnail:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .file-preview-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 16px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            flex-wrap: wrap;
        }

        .file-preview-item .file-icon {
            flex-shrink: 0;
        }

        .file-preview-item .file-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .file-preview-item .file-name {
            font-weight: 600;
            color: #0f172a;
            font-size: 14px;
        }

        .file-preview-item .file-size {
            font-size: 12px;
            color: #94a3b8;
        }

        .preview-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .preview-actions .btn-sm {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-sm-preview {
            background: #3b82f6;
            color: white;
        }

        .btn-sm-preview:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .btn-sm-download {
            background: #10b981;
            color: white;
        }

        .btn-sm-download:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        /* Reply Box */
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

        /* ============================================================
                                   MODAL STYLES
                                   ============================================================ */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px) scale(0.95);
                opacity: 0;
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            max-width: 95%;
            max-height: 95vh;
            width: 900px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            border-bottom: 1px solid #e2e8f0;
            flex-shrink: 0;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 32px;
            color: #94a3b8;
            cursor: pointer;
            padding: 0 8px;
            transition: all 0.2s;
            line-height: 1;
        }

        .modal-close:hover {
            color: #ef4444;
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
            max-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-footer {
            display: flex;
            gap: 12px;
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            justify-content: flex-end;
            flex-shrink: 0;
            flex-wrap: wrap;
        }

        .modal-image-content {
            max-width: 100%;
            max-height: 65vh;
            object-fit: contain;
            border-radius: 8px;
            display: block;
        }

        .modal-pdf {
            width: 95%;
            max-width: 1100px;
        }

        .modal-pdf .modal-body {
            padding: 0;
        }

        .pdf-viewer-container {
            width: 100%;
            height: 600px;
            background: #f8fafc;
        }

        .pdf-viewer-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Spinner */
        .modal-loader {
            display: none;
            text-align: center;
            padding: 40px;
        }

        .modal-loader .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid #0f172a;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        .modal-loader p {
            margin-top: 12px;
            color: #94a3b8;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 98%;
                max-height: 98vh;
            }

            .modal-body {
                max-height: 55vh;
                padding: 16px;
            }

            .pdf-viewer-container {
                height: 400px;
            }

            .modal-image-content {
                max-height: 50vh;
            }

            .preview-thumbnail {
                max-width: 150px;
                max-height: 120px;
            }

            .file-preview-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .preview-actions {
                width: 100%;
            }

            .preview-actions .btn-sm {
                flex: 1;
                justify-content: center;
            }

            .modal-footer {
                flex-direction: column;
            }

            .modal-footer .btn-sm {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .pdf-viewer-container {
                height: 300px;
            }

            .modal-header {
                padding: 12px 16px;
            }

            .modal-body {
                padding: 12px;
                max-height: 50vh;
            }

            .modal-footer {
                padding: 12px 16px;
            }

            .preview-thumbnail {
                max-width: 100%;
                max-height: 150px;
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
                <div class="detail-item full-width">
                    <label>📝 Message</label>
                    <div class="value large">{{ $contact->message }}</div>
                </div>

                {{-- Attachment with Preview --}}
                @if ($contact->attachment)
                    <div class="detail-item full-width">
                        <label>📎 Attachment</label>
                        <div class="value">
                            <div class="attachment-wrapper">
                                @php
                                    $extension = pathinfo($contact->attachment, PATHINFO_EXTENSION);
                                    $filePath = asset('storage/' . $contact->attachment);
                                    $fileName = basename($contact->attachment);
                                    $fileSize = Storage::exists('public/' . $contact->attachment)
                                        ? number_format(Storage::size('public/' . $contact->attachment) / 1024, 1) .
                                            ' KB'
                                        : 'Unknown size';
                                @endphp

                                {{-- Image Preview (JPG, JPEG, PNG) --}}
                                @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                    <div class="file-preview-item">
                                        <img src="{{ $filePath }}" alt="Attachment Preview" class="preview-thumbnail"
                                            onclick="openImageModal('{{ $filePath }}', '{{ $fileName }}')">
                                        <div class="file-info">
                                            <span class="file-name">{{ $fileName }}</span>
                                            <span class="file-size">Image</span>
                                        </div>
                                        <div class="preview-actions">
                                            <button onclick="openImageModal('{{ $filePath }}', '{{ $fileName }}')"
                                                class="btn-sm btn-sm-preview">
                                                👁️ Preview
                                            </button>
                                            <a href="{{ $filePath }}" download="{{ $fileName }}"
                                                class="btn-sm btn-sm-download">
                                                ⬇️ Download
                                            </a>
                                        </div>
                                    </div>

                                    {{-- PDF Preview --}}
                                @elseif (strtolower($extension) === 'pdf')
                                    <div class="file-preview-item">
                                        <div class="file-icon">
                                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                stroke="#ef4444" stroke-width="2">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14 2 14 8 20 8" />
                                                <path d="M12 18v-4" />
                                                <path d="M8 18v-2" />
                                                <path d="M16 18v-6" />
                                            </svg>
                                        </div>
                                        <div class="file-info">
                                            <span class="file-name">{{ $fileName }}</span>
                                            <span class="file-size"> PDF Document</span>
                                        </div>
                                        <div class="preview-actions">
                                            <button onclick="openPdfModal('{{ $filePath }}', '{{ $fileName }}')"
                                                class="btn-sm btn-sm-preview">
                                                👁️ Preview
                                            </button>
                                            <a href="{{ $filePath }}" download="{{ $fileName }}"
                                                class="btn-sm btn-sm-download">
                                                ⬇️ Download
                                            </a>
                                        </div>
                                    </div>

                                    {{-- Unsupported File Type --}}
                                @else
                                    <div class="file-preview-item" style="background: #fef2f2; border-color: #fecaca;">
                                        <div class="file-icon">
                                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                stroke="#ef4444" stroke-width="2">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="12" y1="8" x2="12" y2="12" />
                                                <line x1="12" y1="16" x2="12.01" y2="16" />
                                            </svg>
                                        </div>
                                        <div class="file-info">
                                            <span class="file-name">{{ $fileName }}</span>
                                            <span class="file-size" style="color: #ef4444;">
                                                ⚠️ Unsupported file type ({{ strtoupper($extension) }})
                                            </span>
                                            <span class="file-size" style="color: #94a3b8; font-size: 11px;">
                                                Only JPG, PNG, and PDF are supported
                                            </span>
                                        </div>
                                        <div class="preview-actions">
                                            <a href="{{ $filePath }}" download="{{ $fileName }}"
                                                class="btn-sm btn-sm-download">
                                                ⬇️ Download
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
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

    {{-- ============================================================
        PREVIEW MODALS
        ============================================================ --}}

    {{-- Image Preview Modal --}}
    <div id="imagePreviewModal" class="modal-overlay" onclick="closeModal('imagePreviewModal')">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>🖼️ Image Preview</h3>
                <button class="modal-close" onclick="closeModal('imagePreviewModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-loader" id="imageLoader">
                    <div class="spinner"></div>
                    <p>Loading image...</p>
                </div>
                <img id="modalImage" src="" alt="Preview" class="modal-image-content" style="display:none;">
            </div>
            <div class="modal-footer">
                <button class="btn-sm btn-sm-download" onclick="downloadCurrentImage()">⬇️ Download</button>
                <button class="btn-sm btn-sm-preview" onclick="closeModal('imagePreviewModal')">Close</button>
            </div>
        </div>
    </div>

    {{-- PDF Preview Modal --}}
    <div id="pdfPreviewModal" class="modal-overlay" onclick="closeModal('pdfPreviewModal')">
        <div class="modal-content modal-pdf" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>📄 PDF Preview</h3>
                <button class="modal-close" onclick="closeModal('pdfPreviewModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-loader" id="pdfLoader">
                    <div class="spinner"></div>
                    <p>Loading PDF...</p>
                </div>
                <div class="pdf-viewer-container" style="display:none;">
                    <iframe id="pdfViewer" src="" style="width:100%; height:600px; border:none;"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-sm btn-sm-download" onclick="downloadCurrentFile('pdfPreviewModal')">⬇️
                    Download</button>
                <button class="btn-sm btn-sm-preview" onclick="closeModal('pdfPreviewModal')">Close</button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Reply form submission
                const replyForm = document.getElementById('replyForm');
                if (replyForm) {
                    replyForm.addEventListener('submit', function(e) {
                        const btn = document.getElementById('sendBtn');
                        btn.disabled = true;
                        btn.innerHTML = '⏳ Sending...';
                    });
                }
            });

            // ============================================================
            // MODAL FUNCTIONS
            // ============================================================

            // Open Image Preview Modal
            function openImageModal(filePath, fileName) {
                const modal = document.getElementById('imagePreviewModal');
                const img = document.getElementById('modalImage');
                const loader = document.getElementById('imageLoader');

                // Reset and show loader
                img.style.display = 'none';
                loader.style.display = 'block';

                img.onload = function() {
                    loader.style.display = 'none';
                    img.style.display = 'block';
                };

                img.onerror = function() {
                    loader.style.display = 'none';
                    alert('Failed to load image. Please try downloading instead.');
                };

                // Store for download
                img.dataset.filePath = filePath;
                img.dataset.fileName = fileName;

                img.src = filePath;
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Open PDF Preview Modal
            function openPdfModal(filePath, fileName) {
                const modal = document.getElementById('pdfPreviewModal');
                const iframe = document.getElementById('pdfViewer');
                const viewerContainer = document.querySelector('.pdf-viewer-container');
                const loader = document.getElementById('pdfLoader');

                // Reset and show loader
                viewerContainer.style.display = 'none';
                loader.style.display = 'block';

                // Store for download
                iframe.dataset.filePath = filePath;
                iframe.dataset.fileName = fileName;

                iframe.onload = function() {
                    loader.style.display = 'none';
                    viewerContainer.style.display = 'block';
                };

                iframe.onerror = function() {
                    loader.style.display = 'none';
                    alert('Failed to load PDF. Please try downloading instead.');
                };

                iframe.src = filePath;
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Close Modal
            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';

                    // Reset iframe src to stop loading
                    const iframes = modal.querySelectorAll('iframe');
                    iframes.forEach(iframe => {
                        iframe.src = 'about:blank';
                    });
                }
            }

            // Download current image
            function downloadCurrentImage() {
                const img = document.getElementById('modalImage');
                if (img && img.src && img.dataset.fileName) {
                    const link = document.createElement('a');
                    link.href = img.src;
                    link.download = img.dataset.fileName;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }

            // Download current file from modal
            function downloadCurrentFile(modalId) {
                const modal = document.getElementById(modalId);
                if (!modal) return;

                const iframe = modal.querySelector('iframe');
                if (iframe && iframe.dataset.filePath) {
                    const link = document.createElement('a');
                    link.href = iframe.dataset.filePath;
                    link.download = iframe.dataset.fileName || 'download';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }

            // Close modal on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const activeModal = document.querySelector('.modal-overlay.active');
                    if (activeModal) {
                        closeModal(activeModal.id);
                    }
                }
            });

            // Close modal on outside click
            document.querySelectorAll('.modal-overlay').forEach(overlay => {
                overlay.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeModal(this.id);
                    }
                });
            });
        </script>
    @endpush
@endsection
