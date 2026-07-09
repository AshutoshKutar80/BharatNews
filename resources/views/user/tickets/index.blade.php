@extends('layouts.app')

@section('title', 'Support Tickets - Bharat Integrity Forum News')
@section('meta_description', 'Manage your support tickets and get help from Bharat Integrity Forum News team.')
@section('meta_keywords', 'support, tickets, help, Bharat Integrity Forum')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ══════════════════════════════════════════
                       TOKENS
                    ══════════════════════════════════════════ */
        :root {
            --brand: #06246d;
            --brand-light: #0d3a99;
            --brand-glow: rgba(6, 36, 109, 0.10);
            --accent: #4f7cff;
            --accent-soft: rgba(79, 124, 255, 0.10);
            --surface: #ffffff;
            --bg: #f0f3fa;
            --border: #e4e8f0;
            --text: #1a1f36;
            --muted: #8891aa;
            --radius: 14px;
            --shadow: 0 4px 24px rgba(6, 36, 109, 0.08);
            --shadow-hover: 0 8px 28px rgba(6, 36, 109, 0.14);
        }

        .ticket-page {
            padding: 40px 0;
            background: var(--bg);
            /* min-height: 100vh; */
        }

        .ticket-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ══ PAGE HEADER ══ */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .ph-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .ph-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--brand), var(--brand-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(6, 36, 109, 0.25);
        }

        .ph-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--brand);
        }

        .ph-sub {
            margin: 0;
            font-size: 14px;
            color: var(--muted);
        }

        .stat-pills {
            display: flex;
            gap: 10px;
        }

        .stat-pill {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid var(--border);
            background: var(--surface);
            color: var(--muted);
        }

        .stat-pill .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-open {
            background: #22c55e;
        }

        .dot-closed {
            background: #ef4444;
        }

        /* ══ SPLIT GRID ══ */
        .split-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 24px;
            align-items: start;
        }

        /* ══ CARD ══ */
        .card-box {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .card-box:hover {
            box-shadow: var(--shadow-hover);
        }

        .card-head {
            padding: 16px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, #f8faff 0%, #fff 100%);
        }

        .ch-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--brand-glow);
            color: var(--brand);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .card-head h6 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--brand);
        }

        .card-head .sub {
            font-size: 12px;
            color: var(--muted);
            display: block;
        }

        .card-body-inner {
            padding: 22px;
        }

        /* ══ FORM ══ */
        .form-label-sm {
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 6px;
            display: block;
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid var(--border);
            font-size: 14px;
            padding: 10px 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
            color: var(--text);
            width: 100%;
            font-family: inherit;
            background: #fff;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(79, 124, 255, 0.12);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--brand), var(--brand-light));
            color: #fff;
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(6, 36, 109, 0.2);
        }

        .btn-submit:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 36, 109, 0.3);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-submit i {
            font-size: 16px;
        }

        /* ══ SEARCH BAR ══ */
        .search-wrap {
            padding: 14px 18px 10px;
            border-bottom: 1px solid var(--border);
            position: relative;
        }

        .search-wrap .search-icon {
            position: absolute;
            left: 30px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 14px;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 9px 14px 9px 40px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            font-size: 14px;
            font-family: inherit;
            color: var(--text);
            background: var(--bg);
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(79, 124, 255, 0.10);
            background: #fff;
        }

        .search-input::placeholder {
            color: var(--muted);
        }

        .search-clear {
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 13px;
            cursor: pointer;
            display: none;
            padding: 4px;
            border-radius: 50%;
            transition: color 0.2s;
        }

        .search-clear:hover {
            color: var(--text);
        }

        /* ══ TICKET LIST ══ */
        .ticket-scroll {
            max-height: 420px;
            overflow-y: auto;
            padding: 12px 16px 4px;
        }

        .ticket-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .ticket-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .ticket-scroll::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        .ticket-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: var(--text);
            background: #fff;
        }

        .ticket-item:hover {
            border-color: var(--accent);
            background: #f4f7ff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .ticket-item mark {
            background: rgba(79, 124, 255, 0.18);
            color: var(--brand);
            padding: 0 2px;
            border-radius: 3px;
        }

        .ti-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--brand-glow);
            color: var(--brand);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .ti-body {
            flex: 1;
            min-width: 0;
        }

        .ti-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            margin-bottom: 2px;
        }

        .ti-no {
            font-size: 11px;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .ti-subject {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ti-date {
            font-size: 11px;
            color: var(--muted);
            display: block;
            margin-top: 2px;
        }

        .badge-open {
            background: #dcfce7;
            color: #166534;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .badge-closed {
            background: #fee2e2;
            color: #991b1b;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .badge-open i,
        .badge-closed i {
            font-size: 6px;
        }

        .chevron-icon {
            color: var(--muted);
            font-size: 12px;
            flex-shrink: 0;
            margin-top: 4px;
        }

        /* no-results */
        .no-results {
            text-align: center;
            padding: 30px 20px;
            color: var(--muted);
            font-size: 13px;
        }

        .no-results i {
            font-size: 28px;
            color: var(--border);
            margin-bottom: 8px;
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 40px;
            margin-bottom: 10px;
            color: var(--border);
            display: block;
        }

        .empty-state strong {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
            display: block;
        }

        .empty-state p {
            font-size: 13px;
            margin: 4px 0 0;
        }

        /* ══ PAGINATION ══ */
        .pagination-wrap {
            padding: 12px 16px 14px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: center;
        }

        .pagination-wrap .pagination {
            margin: 0;
            gap: 4px;
        }

        .pagination-wrap .pagination .page-link {
            border-radius: 8px !important;
            font-size: 13px;
            color: var(--brand);
            border-color: var(--border);
            padding: 6px 14px;
        }

        .pagination-wrap .pagination .page-item.active .page-link {
            background: var(--brand);
            border-color: var(--brand);
            color: #fff;
        }

        .pagination-wrap .pagination .page-item.disabled .page-link {
            color: var(--muted);
        }

        /* ══ MODAL ══ */
        .modal-bg {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(6, 14, 40, 0.6);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 1050;
            justify-content: center;
            align-items: center;
            animation: modalFade 0.2s ease;
        }

        @keyframes modalFade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-box {
            width: 640px;
            max-width: 95vw;
            background: var(--surface);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 64px rgba(6, 36, 109, 0.25);
            display: flex;
            flex-direction: column;
            max-height: 88vh;
            animation: modalSlide 0.25s ease;
            margin: 128px auto;
        }

        @keyframes modalSlide {
            from {
                transform: scale(0.95) translateY(10px);
                opacity: 0;
            }

            to {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }

        .modal-top {
            background: linear-gradient(135deg, var(--brand), var(--brand-light));
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .modal-top-left {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .m-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            flex-shrink: 0;
        }

        .modal-top-left h6 {
            margin: 0;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .modal-top-left small {
            color: rgba(255, 255, 255, 0.7);
            font-size: 12px;
            display: block;
        }

        .close-btn {
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            transition: background 0.2s;
            flex-shrink: 0;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* CHAT */
        .chat-box {
            flex: 1;
            overflow-y: auto;
            padding: 18px;
            background: #f5f7fc;
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-height: 300px;
            max-height: 500px;
        }

        .chat-box::-webkit-scrollbar {
            width: 4px;
        }

        .chat-box::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        .message {
            display: flex;
            animation: messageIn 0.2s ease;
        }

        @keyframes messageIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.user {
            justify-content: flex-end;
        }

        .message.admin {
            justify-content: flex-start;
        }

        .bubble {
            max-width: 75%;
            padding: 10px 16px;
            border-radius: 14px;
            font-size: 14px;
            line-height: 1.6;
            word-wrap: break-word;
        }

        .user .bubble {
            background: linear-gradient(135deg, var(--brand), var(--brand-light));
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .admin .bubble {
            background: #fff;
            border: 1.5px solid var(--border);
            color: var(--text);
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .bubble small {
            display: block;
            font-size: 10.5px;
            margin-top: 6px;
            opacity: 0.65;
        }

        .chat-loader {
            text-align: center;
            color: var(--muted);
            padding: 30px 0;
            font-size: 13px;
        }

        .chat-loader i {
            font-size: 20px;
            margin-bottom: 8px;
            display: block;
        }

        .chat-empty {
            text-align: center;
            color: var(--muted);
            padding: 30px 0;
            font-size: 13px;
        }

        .chat-empty i {
            font-size: 28px;
            color: var(--border);
            margin-bottom: 8px;
            display: block;
        }

        /* REPLY BAR */
        .reply-bar {
            padding: 14px 16px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 10px;
            align-items: flex-end;
            background: #fff;
            flex-shrink: 0;
        }

        .reply-bar textarea {
            flex: 1;
            resize: none;
            border-radius: 12px;
            border: 1.5px solid var(--border);
            padding: 10px 14px;
            font-size: 14px;
            font-family: inherit;
            min-height: 44px;
            max-height: 100px;
            transition: border-color 0.2s;
            background: #fafafa;
        }

        .reply-bar textarea:focus {
            outline: none;
            border-color: var(--accent);
            background: #fff;
        }

        .reply-bar textarea:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-send {
            flex-shrink: 0;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand), var(--brand-light));
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.2s ease;
        }

        .btn-send:hover {
            opacity: 0.9;
            transform: scale(1.05);
            box-shadow: 0 4px 14px rgba(6, 36, 109, 0.3);
        }

        .btn-send:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .ticket-closed-box {
            padding: 12px 16px;
            background: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            color: #991b1b;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 10px 0;
        }

        .ticket-closed-box i {
            font-size: 18px;
        }

        /* TOAST */
        .toast-msg {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #1a1f36;
            color: #fff;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            z-index: 9999;
            opacity: 0;
            transform: translateY(12px);
            transition: all 0.3s ease;
            pointer-events: none;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .toast-msg.show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast-msg i {
            font-size: 18px;
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 992px) {
            .split-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .ticket-page {
                padding: 20px 0;
            }

            .ticket-container {
                padding: 0 12px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .stat-pills {
                width: 100%;
                justify-content: flex-start;
            }

            .ph-title {
                font-size: 20px;
            }

            .modal-box {
                max-height: 95vh;
            }

            .chat-box {
                max-height: 350px;
                min-height: 200px;
                padding: 14px;
            }

            .bubble {
                max-width: 85%;
                font-size: 13px;
                padding: 8px 12px;
            }

            .reply-bar {
                padding: 10px 12px;
            }

            .reply-bar textarea {
                font-size: 13px;
                padding: 8px 12px;
                min-height: 38px;
            }

            .btn-send {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .ph-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .ph-title {
                font-size: 18px;
            }

            .stat-pill {
                font-size: 11px;
                padding: 4px 12px;
            }

            .ticket-item {
                padding: 10px 12px;
            }

            .ti-avatar {
                width: 34px;
                height: 34px;
                font-size: 13px;
            }

            .ti-subject {
                font-size: 13px;
            }
        }
    </style>

    <div class="ticket-page">
        <div class="ticket-container">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div class="ph-left">
                    <div class="ph-icon"><i class="fas fa-headset"></i></div>
                    <div>
                        <h1 class="ph-title">Support Center</h1>
                        <p class="ph-sub">Submit a request or track your existing tickets</p>
                    </div>
                </div>
                <div class="stat-pills">
                    <div class="stat-pill">
                        <span class="dot dot-open"></span>
                        <span id="openCount">0</span> Open
                    </div>
                    <div class="stat-pill">
                        <span class="dot dot-closed"></span>
                        <span id="closedCount">0</span> Closed
                    </div>
                </div>
            </div>

            <!-- SPLIT GRID -->
            <div class="split-grid">

                <!-- LEFT: CREATE TICKET -->
                <div class="card-box">
                    <div class="card-head">
                        <div class="ch-icon"><i class="fas fa-plus"></i></div>
                        <div>
                            <h6>New Ticket</h6>
                            <span class="sub">Describe your issue below</span>
                        </div>
                    </div>
                    <div class="card-body-inner">
                        <form id="ticketForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label-sm">Subject <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="subject" class="form-control" id="subjectInput"
                                    placeholder="e.g. Payment not processed" required>
                                <div class="invalid-feedback" id="subjectError"></div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-sm">Message <span style="color:#ef4444;">*</span></label>
                                <textarea name="message" class="form-control" id="messageInput" placeholder="Describe your issue in detail…" required></textarea>
                                <div class="invalid-feedback" id="messageError"></div>
                            </div>

                            <button type="submit" class="btn-submit" id="submitBtn">
                                <i class="fas fa-paper-plane"></i>
                                Submit Ticket
                            </button>
                        </form>
                    </div>
                </div>

                <!-- RIGHT: MY TICKETS -->
                <div class="card-box">
                    <div class="card-head">
                        <div class="ch-icon"><i class="fas fa-ticket-alt"></i></div>
                        <div>
                            <h6>My Tickets</h6>
                            <span class="sub">Click a ticket to open the chat</span>
                        </div>
                    </div>

                    <!-- LIVE SEARCH -->
                    <div class="search-wrap">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="ticketSearch" class="search-input"
                            placeholder="Search by ticket ID or subject…" autocomplete="off">
                        <span class="search-clear" id="searchClear" title="Clear">
                            <i class="fas fa-times"></i>
                        </span>
                    </div>

                    <div id="ticketList">
                        <div class="ticket-scroll" id="ticketScrollInner">
                            @forelse($tickets as $ticket)
                                <a href="javascript:void(0)" class="ticket-item load-ticket" data-id="{{ $ticket->id }}"
                                    data-no="{{ strtolower($ticket->ticket_no) }}"
                                    data-subject="{{ strtolower($ticket->subject) }}">

                                    <div class="ti-avatar">
                                        <i class="fas fa-comment-dots"></i>
                                    </div>

                                    <div class="ti-body">
                                        <div class="ti-top-row">
                                            <span class="ti-no">{{ $ticket->ticket_no }}</span>
                                            @if ($ticket->status == 'open')
                                                <span class="badge-open">
                                                    <i class="fas fa-circle"></i> Open
                                                </span>
                                            @else
                                                <span class="badge-closed">
                                                    <i class="fas fa-circle"></i> Closed
                                                </span>
                                            @endif
                                        </div>
                                        <div class="ti-subject">{{ $ticket->subject }}</div>
                                        <span class="ti-date">{{ $ticket->created_at->format('d M Y') }}</span>
                                    </div>

                                    <i class="fas fa-chevron-right chevron-icon"></i>
                                </a>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <strong>No tickets yet</strong>
                                    <p>Create your first ticket using the form.</p>
                                </div>
                            @endforelse
                        </div>

                        @if ($tickets->hasPages())
                            <div class="pagination-wrap">
                                {{ $tickets->links() }}
                            </div>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- ══ CHAT MODAL ══ -->
    <div class="modal-bg" id="chatModal">
        <div class="modal-box">

            <div class="modal-top">
                <div class="modal-top-left">
                    <div class="m-icon"><i class="fas fa-comments"></i></div>
                    <div>
                        <h6 id="ticketTitle">Ticket</h6>
                        <small id="ticketStatus"></small>
                    </div>
                </div>
                <div class="close-btn" id="closeModalBtn">
                    <i class="fas fa-times"></i>
                </div>
            </div>

            <div class="chat-box" id="chatBox">
                <div class="chat-loader">
                    <i class="fas fa-spinner fa-spin"></i>
                    Loading conversation…
                </div>
            </div>

            <div class="reply-bar" id="replyBar">
                <textarea id="replyMessage" placeholder="Type your message…" rows="1"></textarea>
                <button class="btn-send" id="sendReply" title="Send">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- Toast -->
    <div class="toast-msg" id="toastMsg">
        <i class="fas fa-check-circle" id="toastIcon"></i>
        <span id="toastText"></span>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                let currentId = null;
                let lastMessageId = 0;
                let chatPolling = null;

                // ─── Toast ───
                function showToast(msg, isError = false) {
                    const t = $('#toastMsg');
                    $('#toastText').text(msg);
                    $('#toastIcon').attr('class', isError ? 'fas fa-exclamation-circle' : 'fas fa-check-circle');
                    t.css('background', isError ? '#dc2626' : '#1a1f36').addClass('show');
                    setTimeout(() => t.removeClass('show'), 3200);
                }

                // ─── Update Counts ───
                function updateCounts() {
                    const items = $('.ticket-item');
                    let open = 0,
                        closed = 0;
                    items.each(function() {
                        if ($(this).find('.badge-open').length) open++;
                        if ($(this).find('.badge-closed').length) closed++;
                    });
                    $('#openCount').text(open);
                    $('#closedCount').text(closed);
                }
                updateCounts();

                // ─── Search ───
                function highlight(text, query) {
                    if (!query) return text;
                    const safe = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                    return text.replace(new RegExp(`(${safe})`, 'gi'), '<mark>$1</mark>');
                }

                $('#ticketSearch').on('input', function() {
                    const q = $(this).val().trim().toLowerCase();
                    q.length ? $('#searchClear').show() : $('#searchClear').hide();
                    let found = 0;
                    $('.ticket-item').each(function() {
                        const no = $(this).data('no');
                        const subject = $(this).data('subject');
                        const match = !q || no.includes(q) || subject.includes(q);
                        if (match) {
                            $(this).show();
                            found++;
                            if (q) {
                                $(this).find('.ti-no').html(highlight($(this).data('no').toUpperCase(),
                                    q));
                                $(this).find('.ti-subject').html(highlight($(this).data('subject'), q));
                            } else {
                                $(this).find('.ti-no').text($(this).data('no').toUpperCase());
                                $(this).find('.ti-subject').text($(this).data('subject'));
                            }
                        } else {
                            $(this).hide();
                        }
                    });
                    $('#searchNoResults').remove();
                    if (found === 0 && q) {
                        $('#ticketScrollInner').append(`
                <div class="no-results" id="searchNoResults">
                    <i class="fas fa-search"></i>
                    No tickets match <strong>"${q}"</strong>
                </div>
            `);
                    }
                });

                $('#searchClear').on('click', function() {
                    $('#ticketSearch').val('').trigger('input').focus();
                });

                // ─── Load Ticket ───
                $(document).on('click', '.load-ticket', function() {
                    currentId = $(this).data('id');
                    $('#chatModal').fadeIn(200);
                    $('#chatBox').html(`
            <div class="chat-loader">
                <i class="fas fa-spinner fa-spin"></i>
                Loading conversation…
            </div>
        `);

                    $.get("/support/show/" + currentId, function(res) {
                        $('#ticketTitle').text('#' + res.ticket_no);
                        $('#ticketStatus').text(res.subject);

                        let html = '';
                        lastMessageId = 0;

                        if (!res.messages || res.messages.length === 0) {
                            html =
                                `<div class="chat-empty"><i class="fas fa-comment-slash"></i>No messages yet.</div>`;
                        } else {
                            res.messages.forEach(function(m) {
                                lastMessageId = m.id;
                                html += `
                        <div class="message ${m.sender_type}" data-message-id="${m.id}">
                            <div class="bubble">
                                ${m.message}
                                <small>${m.created_at}</small>
                            </div>
                        </div>
                    `;
                            });
                        }

                        $('#chatBox').html(html);

                        // Handle closed ticket
                        if (res.status === 'closed') {
                            $('#replyBar').html(`
                    <div class="ticket-closed-box">
                        <i class="fas fa-lock"></i>
                        This ticket is closed. Please create a new ticket for further assistance.
                    </div>
                `);
                        } else {
                            $('#replyBar').html(`
                    <textarea id="replyMessage" placeholder="Type your message…" rows="1"></textarea>
                    <button class="btn-send" id="sendReply" title="Send">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                `);
                        }

                        setTimeout(() => {
                            $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
                        }, 100);
                        startChatPolling();

                    }).fail(function() {
                        $('#chatBox').html(
                            `<div style="text-align:center;color:#dc2626;padding:30px;">Failed to load ticket.</div>`
                        );
                    });
                });

                // ─── Close Modal ───
                function closeModal() {
                    if (chatPolling) {
                        clearInterval(chatPolling);
                        chatPolling = null;
                    }
                    $('#chatModal').fadeOut(150);
                }

                $('#closeModalBtn').on('click', closeModal);
                $('#chatModal').on('click', function(e) {
                    if ($(e.target).is('#chatModal')) closeModal();
                });
                $(document).on('keydown', function(e) {
                    if (e.key === 'Escape') closeModal();
                });

                // ─── Send Reply ───
                $(document).on('click', '#sendReply', sendMessage);
                $(document).on('keydown', '#replyMessage', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        sendMessage();
                    }
                });

                function sendMessage() {
                    const msgField = $('#replyMessage');
                    if (!msgField.length) {
                        showToast('This ticket is closed.', true);
                        return;
                    }

                    const msg = msgField.val().trim();
                    if (!msg) return;

                    const btn = $('#sendReply');
                    btn.prop('disabled', true);

                    $.post("/support/reply/" + currentId, {
                        _token: "{{ csrf_token() }}",
                        message: msg
                    }, function(res) {
                        if (!res.success) {
                            showToast(res.message || 'Could not send message.', true);
                            return;
                        }

                        msgField.val('');
                        lastMessageId = res.messageData.id;

                        // Add message to chat
                        $('#chatBox').append(`
                <div class="message user" data-message-id="${res.messageData.id}">
                    <div class="bubble">
                        ${res.messageData.message}
                        <small>${res.messageData.created_at}</small>
                    </div>
                </div>
            `);
                        $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);

                        // Update ticket list status if needed
                        $('.load-ticket[data-id="' + currentId + '"]').find('.badge-closed').remove();
                        $('.load-ticket[data-id="' + currentId + '"]').find('.badge-open').remove();
                        $('.load-ticket[data-id="' + currentId + '"]').find('.ti-top-row').append(`
                <span class="badge-open"><i class="fas fa-circle"></i> Open</span>
            `);
                        updateCounts();

                    }).fail(function() {
                        showToast('Failed to send. Please try again.', true);
                    }).always(function() {
                        btn.prop('disabled', false);
                    });
                }

                // ─── Chat Polling ───
                function startChatPolling() {
                    if (chatPolling !== null) {
                        clearInterval(chatPolling);
                        chatPolling = null;
                    }

                    chatPolling = setInterval(function() {
                        if (!currentId) return;

                        $.get("/support/latest-messages/" + currentId + "?last_id=" + lastMessageId, function(
                            res) {
                            res.messages.forEach(function(m) {
                                if ($('#chatBox').find('[data-message-id="' + m.id + '"]')
                                    .length) return;
                                lastMessageId = m.id;
                                $('#chatBox').append(`
                        <div class="message ${m.sender_type}" data-message-id="${m.id}">
                            <div class="bubble">
                                ${m.message}
                                <small>${m.created_at}</small>
                            </div>
                        </div>
                    `);
                                $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
                            });
                        });
                    }, 2000);
                }

                // ─── Submit Ticket ───
                $('#ticketForm').on('submit', function(e) {
                    e.preventDefault();

                    const btn = $('#submitBtn');
                    const subject = $('#subjectInput').val().trim();
                    const message = $('#messageInput').val().trim();

                    // Clear previous errors
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').text('');

                    if (!subject) {
                        $('#subjectInput').addClass('is-invalid');
                        $('#subjectError').text('Please enter a subject.');
                        $('#subjectInput').focus();
                        return;
                    }

                    if (!message || message.length < 10) {
                        $('#messageInput').addClass('is-invalid');
                        $('#messageError').text('Message must be at least 10 characters.');
                        $('#messageInput').focus();
                        return;
                    }

                    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');

                    $.ajax({
                        url: "{{ route('ticket.store') }}",
                        method: 'POST',
                        data: $(this).serialize(),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        success: function(res) {
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Ticket Created!',
                                    text: 'Your ticket has been submitted successfully.',
                                    confirmButtonColor: '#06246d',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON?.errors;
                                if (errors) {
                                    if (errors.subject) {
                                        $('#subjectInput').addClass('is-invalid');
                                        $('#subjectError').text(errors.subject[0]);
                                    }
                                    if (errors.message) {
                                        $('#messageInput').addClass('is-invalid');
                                        $('#messageError').text(errors.message[0]);
                                    }
                                }
                            } else {
                                showToast('Failed to create ticket. Please try again.', true);
                            }
                        },
                        complete: function() {
                            btn.prop('disabled', false).html(
                                '<i class="fas fa-paper-plane"></i> Submit Ticket');
                        }
                    });
                });

                // ─── Pagination ───
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    $.get($(this).attr('href'), function(data) {
                        $('#ticketList').html($(data).find('#ticketList').html());
                        updateCounts();
                    });
                });
            });
        </script>
    @endpush

@endsection
