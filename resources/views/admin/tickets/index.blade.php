@extends('admin.layout')

@section('title', 'Support')
@section('page-title', 'Support')
@section('page-subtitle', 'Overview of users, payments and orders')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --green: #25a244;
            --green-dk: #1a7a32;
            --green-lt: #eaf3e0;
            --red: #e53935;
            --red-lt: #fdecea;
            --border: #e4e8ec;
            --card-bg: #ffffff;
            --txt: #1a1a2e;
            --txt-mute: #6b7280;
            --radius: 12px;
            --shadow: 0 2px 12px rgba(0, 0, 0, .07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .page-wrap {
            padding: 24px 80px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--txt);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 12px;
        }

        .badge-count {
            background: var(--green);
            color: #fff;
            border-radius: 8px;
            padding: 3px 11px;
            font-size: 12px;
            font-weight: 600;
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            flex-wrap: wrap;
            padding: 14px 18px;
        }

        .search-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .search-wrap svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--txt-mute);
            pointer-events: none;
        }

        #searchInput {
            width: 100%;
            border: 1.5px solid var(--border);
            border-radius: 22px;
            padding: 9px 16px 9px 38px;
            font-size: 13px;
            color: var(--txt);
            background: #fff;
            outline: none;
            transition: border-color .2s;
            font-family: inherit;
        }

        .footer-input-row {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .footer-textarea {
            flex: 1;
            resize: none;
            min-height: 48px;
            max-height: 120px;
            border: 1px solid #dcdfe4;
            border-radius: 25px;
            padding: 12px 18px;
            font-size: 14px;
            outline: none;
            background: #fff;
            transition: all .3s ease;
        }

        .footer-textarea:focus {
            border-color: #25a244;
            box-shadow: 0 0 0 3px rgba(37, 162, 68, .15);
        }

        .btn-reply,
        .btn-reply-close {
            width: 48px;
            height: 48px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .25s ease;
            flex-shrink: 0;
        }

        .btn-reply {
            background: linear-gradient(135deg, #25a244, #1a7a32);
            color: #fff;
            box-shadow: 0 4px 15px rgba(37, 162, 68, .35);
        }

        .btn-reply:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(37, 162, 68, .45);
        }

        .btn-reply-close {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            box-shadow: 0 4px 15px rgba(239, 68, 68, .35);
        }

        .btn-reply-close:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 20px rgba(239, 68, 68, .45);
        }

        .btn-reply i,
        .btn-reply-close i {
            font-size: 16px;
        }

        #searchInput:focus {
            border-color: var(--green);
        }

        .filter-btns {
            display: flex;
            gap: 6px;
        }

        .filter-btn {
            padding: 8px 18px;
            border: 1.5px solid var(--border);
            border-radius: 22px;
            background: #fff;
            font-size: 12px;
            font-weight: 600;
            color: var(--txt-mute);
            cursor: pointer;
            transition: .15s;
            font-family: inherit;
        }

        .filter-btn:hover {
            border-color: var(--green);
            color: var(--green);
        }

        .filter-btn.active {
            background: var(--green);
            color: #fff;
            border-color: var(--green);
        }

        mark.hl {
            background: #fff3cd;
            color: #856404;
            border-radius: 2px;
            padding: 0 1px;
        }

        #ticketList {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 62vh;
            overflow-y: auto;
            padding: 1px 23px;
            scrollbar-width: none;
        }

        .ticket-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            border-left: 4px solid var(--green);
            cursor: pointer;
            transition: transform .18s, box-shadow .18s;
        }

        .ticket-card.closed {
            border-left-color: var(--red);
        }

        .ticket-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .11);
        }

        .tc-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--green-lt);
            color: var(--green-dk);
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .ticket-card.closed .tc-avatar {
            background: var(--red-lt);
            color: var(--red);
        }

        .tc-info {
            flex: 1;
            min-width: 0;
        }

        .tc-no {
            font-size: 11px;
            color: var(--txt-mute);
            font-weight: 600;
            letter-spacing: .4px;
            margin-bottom: 3px;
        }

        .tc-subject {
            font-size: 14px;
            font-weight: 600;
            color: var(--txt);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tc-user {
            font-size: 12px;
            color: var(--txt-mute);
            margin-top: 2px;
        }

        .tc-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .badge-open {
            background: var(--green-lt);
            color: var(--green);
        }

        .badge-closed {
            background: var(--red-lt);
            color: var(--red);
        }

        .no-results {
            text-align: center;
            padding: 48px;
            color: var(--txt-mute);
            font-size: 14px;
        }

        .skeleton-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 18px;
            box-shadow: var(--shadow);
            border-left: 4px solid #e4e8ec;
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 10px;
        }

        .skel {
            background: linear-gradient(90deg, #eee 25%, #f5f5f5 50%, #eee 75%);
            background-size: 200%;
            animation: shimmer 1.2s infinite;
            border-radius: 6px;
        }

        .skel-sm {
            height: 11px;
            width: 80px;
        }

        .skel-md {
            height: 14px;
            width: 55%;
        }

        .skel-xs {
            height: 10px;
            width: 110px;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0
            }

            100% {
                background-position: -200% 0
            }
        }

        #pagination {
            margin-top: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .pg-btn {
            min-width: 34px;
            height: 34px;
            padding: 0 10px;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            color: var(--txt);
            transition: .15s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: inherit;
        }

        .pg-btn:hover,
        .pg-btn.active {
            background: var(--green);
            color: #fff;
            border-color: var(--green);
        }

        .pg-btn:disabled {
            opacity: .4;
            cursor: default;
            pointer-events: none;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            backdrop-filter: blur(4px);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            padding: 16px;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-box {
            width: 680px;
            max-width: 100%;
            height: 88vh;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .22);
            display: flex;
            flex-direction: column;
            animation: popIn .22s cubic-bezier(.34, 1.56, .64, 1);
        }

        @keyframes popIn {
            from {
                transform: scale(.88);
                opacity: 0
            }

            to {
                transform: scale(1);
                opacity: 1
            }
        }

        .modal-header {
            background: linear-gradient(135deg, var(--green-dk), var(--green));
            color: #fff;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            border-radius: 18px 18px 0 0;
        }

        .mh-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .mh-info {
            flex: 1;
            min-width: 0;
        }

        .mh-name {
            font-weight: 700;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mh-subject {
            font-size: 11px;
            opacity: .85;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mh-status {
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            flex-shrink: 0;
        }

        .mh-status.open {
            background: rgba(255, 255, 255, .25);
            color: #fff;
        }

        .mh-status.closed {
            background: var(--red);
            color: #fff;
        }

        .mh-close {
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            line-height: 1;
            padding: 4px;
            margin-left: 8px;
        }

        .chat-box {
            flex: 1;
            overflow-y: auto;
            padding: 16px 14px;
            background: #ece5dd;
            display: flex;
            flex-direction: column;
            gap: 8px;
            scrollbar-width: none;
        }

        .chat-box::-webkit-scrollbar {
            width: 4px;
        }

        .chat-box::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        .msg-row {
            display: flex;
        }

        .msg-row.user {
            justify-content: flex-start;
        }

        .msg-row.admin {
            justify-content: flex-end;
        }

        .bubble {
            max-width: 72%;
            padding: 9px 13px 7px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.5;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
            word-break: break-word;
        }

        .msg-row.user .bubble {
            background: #fff;
            border-radius: 0 12px 12px 12px;
            color: var(--txt);
        }

        .msg-row.admin .bubble {
            background: #d9fdd3;
            border-radius: 12px 0 12px 12px;
            color: var(--txt);
        }

        .bubble-time {
            font-size: 10px;
            color: var(--txt-mute);
            text-align: right;
            margin-top: 3px;
        }

        .date-divider {
            text-align: center;
        }

        .date-divider span {
            background: rgba(0, 0, 0, .1);
            color: #555;
            font-size: 10px;
            padding: 2px 10px;
            border-radius: 20px;
        }

        .chat-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--txt-mute);
            gap: 8px;
        }

        .chat-loading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--txt-mute);
            font-size: 13px;
            padding: 30px;
        }

        .spinner {
            width: 18px;
            height: 18px;
            border: 2px solid var(--border);
            border-top-color: var(--green);
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg)
            }
        }

        .chat-footer {
            padding: 10px 12px;
            border-top: 1px solid var(--border);
            background: #f0f2f5;
            flex-shrink: 0;
            border-radius: 0 0 18px 18px;
        }

        .closed-notice {
            background: var(--red-lt);
            color: var(--red);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        .footer-actions {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .btn-reply,
        .btn-reply-close {
            border: none;
            border-radius: 18px;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
            transition: .15s;
            font-family: inherit;
        }

        .btn-reply {
            background: var(--green);
            color: #fff;
        }

        .btn-reply:hover {
            background: var(--green-dk);
        }

        .btn-reply-close {
            background: var(--red);
            color: #fff;
        }

        .btn-reply-close:hover {
            background: #c62828;
        }

        .btn-reply:disabled,
        .btn-reply-close:disabled {
            opacity: .5;
            cursor: default;
        }

        #tk-toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(60px);
            background: #323232;
            color: #fff;
            padding: 10px 22px;
            border-radius: 24px;
            font-size: 13px;
            z-index: 99999;
            transition: transform .3s;
            pointer-events: none;
        }

        #tk-toast.show {
            transform: translateX(-50%) translateY(0);
        }

        @media(max-width:768px) {

            html,
            body {
                height: 100%;
                overflow-y: auto;
            }

            .main-area {
                height: 100vh;
                overflow-y: auto;
            }

            .app-shell {
                height: auto !important;
                overflow: visible !important;
            }

            .page-wrap {
                padding: 15px 12px;
                overflow-y: auto;
                scrollbar-width: none;
            }

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-btns {
                flex-wrap: wrap;
            }

            .modal-box {
                height: 95vh;
                border-radius: 12px;
            }

            .bubble {
                max-width: 85%;
            }

            .footer-actions {
                flex-direction: row;
            }
        }
    </style>

    {{-- CSRF hidden field --}}
    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">



    <div class="page-wrap">
        <div class="page-title">
            🎫 Support Tickets
            <span class="badge-count" id="totalCount">–</span>
        </div>

        <div class="toolbar">
            <div class="search-wrap">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.2" aria-hidden="true">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                <input type="text" id="searchInput" placeholder="Search by subject, user or ticket no…"
                    autocomplete="off">
            </div>
            <div class="filter-btns">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="open">Open</button>
                <button class="filter-btn" data-filter="closed">Closed</button>
            </div>
        </div>

        <div id="skeletonWrap">
            @for ($i = 0; $i < 5; $i++)
                <div class="skeleton-card">
                    <div class="skel skel-sm"></div>
                    <div class="skel skel-md"></div>
                    <div class="skel skel-xs"></div>
                </div>
            @endfor
        </div>

        <div id="ticketList"></div>
        <div id="pagination"></div>
    </div>


    <div class="modal-overlay" id="chatModal">
        <div class="modal-box">
            <div class="modal-header">
                <div class="mh-avatar" id="mhAvatar">👤</div>
                <div class="mh-info">
                    <div class="mh-name" id="mhName">–</div>
                    <div class="mh-subject" id="mhSubject">–</div>
                </div>
                <div class="mh-status" id="mhStatus">–</div>
                <button class="mh-close" onclick="closeModal()">✕</button>
            </div>
            <div class="chat-box" id="chatBox">
                <div class="chat-loading">
                    <div class="spinner"></div>&nbsp;Loading…
                </div>
            </div>
            <div class="chat-footer" id="chatFooter"></div>
        </div>
    </div>

    <div id="tk-toast"></div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            (function() {
                'use strict';

                var CSRF = document.getElementById('csrf_token').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': CSRF
                    }
                });

                var TICKET_LIST_URL = '{{ route('admin.tickets') }}';

                function msgUrl(id) {
                    return '/admin/ticket/messages/' + id;
                }

                function replyUrl(id) {
                    return '/admin/tickets/reply/' + id;
                }

                function closeUrl(id) {
                    return '/admin/tickets/reply-close/' + id;
                }

                var PER_PAGE = 5;
                var currentPage = 1;
                var currentId = null;
                var pollTimer = null; // chat message polling (modal khula ho tab)
                var ticketListTimer = null; // ticket list polling (modal band ho tab)
                var lastTotalTickets = 0;
                var searchTimer = null;
                var activeFilter = 'all';
                var searchQuery = '';
                var lastMsgCount = 0;
                var footerRendered = false;
                var lastTicketStatus = '';

                /* ── TOAST ── */
                function toast(msg, dur) {
                    dur = dur || 2600;
                    var $t = $('#tk-toast').text(msg).addClass('show');
                    setTimeout(function() {
                        $t.removeClass('show');
                    }, dur);
                }

                /* ── HELPERS ── */
                function esc(str) {
                    if (str === null || str === undefined) return '';
                    return String(str)
                        .replace(/&/g, '&amp;').replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                }

                function cap(s) {
                    return s ? s.charAt(0).toUpperCase() + s.slice(1) : '';
                }

                function getInitials(name) {
                    if (!name) return '?';
                    var p = String(name).trim().split(/\s+/);
                    return (p[0][0] + (p[1] ? p[1][0] : '')).toUpperCase();
                }

                function hlText(raw, q) {
                    var e = esc(raw);
                    if (!q) return e;
                    var re = new RegExp('(' + q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
                    return e.replace(re, '<mark class="hl">$1</mark>');
                }

                /* ── TICKET LIST ── */
                function loadTickets(page) {
                    page = page || 1;
                    currentPage = page;
                    $.ajax({
                        url: TICKET_LIST_URL,
                        type: 'GET',
                        data: {
                            page: page,
                            per_page: PER_PAGE,
                            ajax: 1,
                            search: searchQuery,
                            status: activeFilter
                        },
                        success: function(res) {
                            $('#skeletonWrap').hide();
                            renderList(res);
                        },
                        error: function() {
                            $('#skeletonWrap').hide();
                            $('#ticketList').html(
                                '<p style="color:#e53935;text-align:center;padding:40px">Failed to load tickets.</p>'
                            );
                        }
                    });
                }

                function renderList(res) {
                    lastTotalTickets = parseInt(res.total || 0);
                    var data = res.data || [];
                    $('#totalCount').text(res.total || 0);
                    if (!data.length) {
                        $('#ticketList').html('<div class="no-results">🔍 No tickets match your search.</div>');
                        $('#pagination').html('');
                        return;
                    }
                    var html = '';
                    $.each(data, function(i, t) {
                        var isOpen = (t.status === 'open');
                        var uName = (t.user && t.user.name) ? t.user.name : '–';
                        html +=
                            '<div class="ticket-card ' + (isOpen ? '' : 'closed') + '" data-id="' + t.id + '">' +
                            '<div class="tc-avatar">' + esc(getInitials(uName)) + '</div>' +
                            '<div class="tc-info">' +
                            '<div class="tc-no">#' + hlText(t.ticket_no, searchQuery) + '</div>' +
                            '<div class="tc-subject">' + hlText(t.subject, searchQuery) + '</div>' +
                            '<div class="tc-user">👤 ' + hlText(uName, searchQuery) + '</div>' +
                            '</div>' +
                            '<div class="tc-badge ' + (isOpen ? 'badge-open' : 'badge-closed') + '">' + cap(t
                                .status) + '</div>' +
                            '</div>';
                    });
                    $('#ticketList').html(html);
                    buildPagination(res.current_page, res.last_page);
                }

                function buildPagination(cur, last) {
                    if (!last || last <= 1) {
                        $('#pagination').html('');
                        return;
                    }
                    var h = '<button class="pg-btn" onclick="tkLoadPage(' + (cur - 1) + ')" ' + (cur === 1 ? 'disabled' :
                        '') + '>&#8249;</button>';
                    for (var p = 1; p <= last; p++) {
                        h += '<button class="pg-btn' + (p === cur ? ' active' : '') + '" onclick="tkLoadPage(' + p + ')">' +
                            p + '</button>';
                    }
                    h += '<button class="pg-btn" onclick="tkLoadPage(' + (cur + 1) + ')" ' + (cur === last ? 'disabled' :
                        '') + '>&#8250;</button>';
                    $('#pagination').html(h);
                }
                window.tkLoadPage = loadTickets;

                /* ── SEARCH ── */
                $('#searchInput').on('input', function() {
                    clearTimeout(searchTimer);
                    var val = $(this).val().trim();
                    searchTimer = setTimeout(function() {
                        searchQuery = val;
                        loadTickets(1);
                    }, 300);
                });

                /* ── FILTER ── */
                $(document).on('click', '.filter-btn', function() {
                    $('.filter-btn').removeClass('active');
                    $(this).addClass('active');
                    activeFilter = $(this).data('filter');
                    loadTickets(1);
                });

                /* ── OPEN MODAL ── */
                $(document).on('click', '.ticket-card', function() {
                    currentId = $(this).data('id');
                    lastMsgCount = 0;
                    footerRendered = false;
                    lastTicketStatus = '';
                    $('#chatBox').html('<div class="chat-loading"><div class="spinner"></div>&nbsp;Loading…</div>');
                    $('#chatFooter').html('');
                    $('#chatModal').addClass('show');
                    fetchMessages(currentId, true);
                    startPolling(currentId);
                });

                /* ── CLOSE MODAL ── */
                window.closeModal = function() {
                    $('#chatModal').removeClass('show');
                    stopPolling();
                    currentId = null;
                    footerRendered = false;
                    lastMsgCount = 0;
                    lastTicketStatus = '';
                };

                $('#chatModal').on('click', function(e) {
                    if ($(e.target).is('#chatModal')) window.closeModal();
                });

                $(document).on('keydown', function(e) {
                    if (e.key === 'Escape' && currentId) window.closeModal();
                });

                /* ── FETCH MESSAGES (chat polling) ── */
                function fetchMessages(id, forceScroll) {
                    $.ajax({
                        url: msgUrl(id),
                        type: 'GET',
                        success: function(res) {
                            var t = res.ticket;
                            var isOpen = (t.status === 'open');
                            var msgs = res.messages || [];

                            $('#mhAvatar').text(getInitials(t.user.name));
                            $('#mhName').text(t.user.name + '  ·  #' + t.ticket_no);
                            $('#mhSubject').text(t.subject);
                            $('#mhStatus').text(cap(t.status)).removeClass('open closed').addClass(t.status);

                            var newCount = msgs.length;
                            if (newCount !== lastMsgCount) {
                                renderMessages(msgs);
                                lastMsgCount = newCount;
                                var chatBox = document.getElementById('chatBox');
                                if (chatBox) setTimeout(function() {
                                    chatBox.scrollTop = chatBox.scrollHeight;
                                }, 50);
                            }

                            if (!footerRendered || t.status !== lastTicketStatus) {
                                renderFooter(t.id, isOpen);
                                footerRendered = true;
                                lastTicketStatus = t.status;
                            }

                            if (forceScroll) {
                                var b = document.getElementById('chatBox');
                                if (b) setTimeout(function() {
                                    b.scrollTop = b.scrollHeight;
                                }, 60);
                            }
                        },
                        error: function(xhr) {
                            var errMsg = 'Could not load messages.';
                            if (xhr.status === 404) errMsg = 'Ticket not found (404).';
                            if (xhr.status === 419) errMsg = 'Session expired. Please refresh the page.';
                            if (xhr.status === 500) errMsg = 'Server error (500).';
                            $('#chatBox').html('<div class="chat-empty"><p>' + errMsg + '</p></div>');
                            $('#chatFooter').html('');
                        }
                    });
                }

                /* ── RENDER MESSAGES ── */
                function renderMessages(msgs) {
                    if (!msgs || msgs.length === 0) {
                        $('#chatBox').html(
                            '<div class="chat-empty">' +
                            '<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">' +
                            '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>' +
                            '<p>No messages yet.</p></div>'
                        );
                        return;
                    }
                    var html = '',
                        lastDate = '';
                    $.each(msgs, function(i, m) {
                        var parts = (m.created_at || '').split(', ');
                        var day = parts[0] || '';
                        var time = parts[1] || m.created_at || '';
                        if (day !== lastDate) {
                            html += '<div class="date-divider"><span>' + esc(day) + '</span></div>';
                            lastDate = day;
                        }
                        html +=
                            '<div class="msg-row ' + m.sender_type + '">' +
                            '<div class="bubble">' +
                            esc(m.message) +
                            '<div class="bubble-time">' + esc(time) + '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $('#chatBox').html(html);
                }

                /* ── RENDER FOOTER ── */
                function renderFooter(ticketId, isOpen) {
                    if (!isOpen) {
                        $('#chatFooter').html(
                            '<div class="closed-notice">🔒 This ticket is closed. No further replies can be sent.</div>'
                        );
                        return;
                    }
                    $('#chatFooter').html(
                        '<div class="footer-input-row">' +
                        '<textarea class="footer-textarea" id="msgInput" rows="1" placeholder="Type your message..."></textarea>' +
                        '<button class="btn-reply" id="btnReply" data-id="' + ticketId +
                        '"><i class="fas fa-paper-plane"></i></button>' +
                        '<button class="btn-reply-close" id="btnReplyClose" data-id="' + ticketId +
                        '"><i class="fas fa-lock"></i></button>' +
                        '</div>'
                    );
                    $(document).off('keydown.chat').on('keydown.chat', '#msgInput', function(e) {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            doReply(false);
                        }
                    });
                }

                /* ── SEND REPLY ── */
                $(document).on('click', '#btnReply', function() {
                    doReply(false);
                });
                $(document).on('click', '#btnReplyClose', function() {
                    doReply(true);
                });

                function doReply(andClose) {
                    var id = andClose ? $('#btnReplyClose').data('id') : $('#btnReply').data('id');
                    var msg = $('#msgInput').val().trim();
                    if (!msg) {
                        toast('Please type a message first.');
                        $('#msgInput').focus();
                        return;
                    }

                    var url = andClose ? closeUrl(id) : replyUrl(id);
                    $('#btnReply, #btnReplyClose').prop('disabled', true);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            message: msg,
                            _token: CSRF
                        },
                        success: function() {
                            $('#msgInput').val('');
                            lastMsgCount = 0;
                            fetchMessages(id, true);
                            if (andClose) {
                                toast('Ticket closed successfully.');
                                footerRendered = false;
                                loadTickets(currentPage);
                            }
                        },
                        error: function(xhr) {
                            var errMsg = 'Something went wrong.';
                            if (xhr.status === 419) errMsg = 'Session expired. Please refresh.';
                            if (xhr.responseJSON && xhr.responseJSON.message) errMsg = xhr.responseJSON.message;
                            toast(errMsg);
                        },
                        complete: function() {
                            $('#btnReply, #btnReplyClose').prop('disabled', false);
                        }
                    });
                }

                function startPolling(id) {

                    stopChatPolling();
                    pollTimer = setInterval(function() {
                        if (currentId) fetchMessages(currentId, false);
                    }, 3000);


                    stopTicketListPolling();
                }

                function stopPolling() {
                    stopChatPolling();
                    startTicketListPolling();
                }

                function stopChatPolling() {
                    if (pollTimer) {
                        clearInterval(pollTimer);
                        pollTimer = null;
                    }
                }

                function stopTicketListPolling() {
                    if (ticketListTimer) {
                        clearInterval(ticketListTimer);
                        ticketListTimer = null;
                    }
                }

                function startTicketListPolling() {
                    stopTicketListPolling();
                    ticketListTimer = setInterval(function() {
                        $.ajax({
                            url: TICKET_LIST_URL,
                            type: 'GET',
                            data: {
                                page: currentPage,
                                per_page: PER_PAGE,
                                ajax: 1,
                                search: searchQuery,
                                status: activeFilter
                            },
                            success: function(res) {
                                var newTotal = parseInt(res.total || 0);
                                if (newTotal !== lastTotalTickets) {
                                    renderList(res);
                                    toast('New ticket received');
                                }
                            }
                        });
                    }, 5000);
                }

                /* ── AUTO-GROW TEXTAREA ── */
                $(document).on('input', '#msgInput', function() {
                    this.style.height = '48px';
                    this.style.height = this.scrollHeight + 'px';
                });

                /* ── BOOT ── */
                $(function() {
                    loadTickets(1);
                    startTicketListPolling();
                });

                /* ── CLEANUP ── */
                $(window).on('beforeunload', function() {
                    stopTicketListPolling();
                    stopChatPolling();
                });

            }());
        </script>
    @endpush
@endsection
