<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — BIF News Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/fevi.png') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
</head>

<body class="admin-body">

    <div class="admin-shell">

        {{-- ===================== SIDEBAR ===================== --}}
        <aside class="admin-sidebar" id="adminSidebar">
            <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand">
                <div class="badge">
                    <img src="{{ asset('images/logo1.jpeg') }}" alt="BIF News Logo"
                        style="height: 70px;  object-fit: cover;">
                </div>
            </a>
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="ic">🏠</span> Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <span class="ic">👥</span> Users
                    @php($pendingUsers = \App\Models\User::where('status', 'pending')->count())
                    @if ($pendingUsers > 0)
                        <span class="badge-count">{{ $pendingUsers }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.success.payments') }}"
                    class="{{ request()->routeIs('admin.success.payments*') ? 'active' : '' }}">
                    <span class="ic">💳</span>Success Payments
                </a>

                <a href="{{ route('admin.payments') }}"
                    class="{{ request()->routeIs('admin.payments*') ? 'active' : '' }}">
                    <span class="ic">💳</span>Temp Payments
                    @php($pendingPayments = \App\Models\TempPayment::count())
                    @if ($pendingPayments > 0)
                        <span class="badge-count">{{ $pendingPayments }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.purchased-products') }}"
                    class="{{ request()->routeIs('admin.purchased-products*') ? 'active' : '' }}">
                    <span class="ic">📦</span> Purchased Products
                    @php($pendingProducts = \App\Models\PurchasedProduct::where('is_approved', false)->count())
                    @if ($pendingProducts > 0)
                        <span class="badge-count">{{ $pendingProducts }}</span>
                    @endif
                </a>

                <!-- In your admin layout sidebar -->
                <a href="{{ route('admin.contacts.index') }}"
                    class="{{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                    <span class="ic">📬</span> Contacts
                    @php($pendingContacts = \App\Models\Contact::pending()->count())
                    @if ($pendingContacts > 0)
                        <span class="badge-count">{{ $pendingContacts }}</span>
                    @endif
                </a>

                <a href="{{ url('/admin/tickets') }}"
                    class="nav-item {{ request()->is('admin/tickets') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.26h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 5.55 5.55l1.06-1.06a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="nav-label">Support</span>
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <form id="adminLogoutForm" action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="button" onclick="confirmAdminLogout()">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- ===================== MAIN COLUMN ===================== --}}
        <div class="admin-main">

            {{-- Separate admin header — intentionally distinct from the public site header --}}
            <header class="admin-header">
                {{-- <div class="tricolor-strip"></div> --}}
                <div class="admin-header-inner">
                    <div class="admin-header-left">
                        <button class="admin-burger" id="adminBurger">☰</button>
                        <div class="admin-header-title">
                            <h1>@yield('page-title', 'Dashboard')</h1>
                        </div>
                    </div>
                    <div class="admin-header-right">
                        <span class="admin-date-pill" id="adminDate"></span>
                        <div class="admin-user-chip">
                            <div class="av">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                            <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="admin-content">

                @if (session('success'))
                    <div class="alert alert-success">✅ {{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error">⚠️ {{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-error">
                        ⚠️ {{ $errors->first() }}
                    </div>
                @endif

                @yield('content')

            </main>
        </div>
    </div>

    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        var d = new Date();
        var el = document.getElementById('adminDate');
        if (el) {
            el.textContent = d.toLocaleDateString('en-IN', {
                weekday: 'short',
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });
        }
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: @json(session('success')),
                confirmButtonColor: '#198754',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: @json(session('error')),
                confirmButtonColor: '#dc3545'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: "{{ $errors->first() }}",
                confirmButtonColor: '#ffc107'
            });
        @endif
    </script>
    <script>
        function confirmAdminLogout() {
            Swal.fire({
                title: 'Logout?',
                text: 'Are you sure you want to logout from the admin panel?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Logout',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('adminLogoutForm').submit();
                }
            });
        }
    </script>
    @stack('scripts')
</body>

</html>
