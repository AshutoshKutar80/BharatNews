{{-- resources/views/user/partials/subnav.blade.php --}}
<div class="up-subnav">
    <a href="{{ route('dashboard') }}" class="up-subnav-item {{ $active === 'dashboard' ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="{{ route('profile') }}" class="up-subnav-item {{ $active === 'profile' ? 'active' : '' }}">
        <i class="fas fa-user"></i> Profile
    </a>
    <a href="{{ route('user.contacts') }}" class="up-subnav-item {{ $active === 'contacts' ? 'active' : '' }}">
        <i class="fas fa-envelope-open-text"></i> Contacts
    </a>
    <a href="{{ route('user.payments') }}" class="up-subnav-item {{ $active === 'payments' ? 'active' : '' }}">
        <i class="fas fa-credit-card"></i> Payments
    </a>
    <a href="{{ route('user.products') }}" class="up-subnav-item {{ $active === 'products' ? 'active' : '' }}">
        <i class="fas fa-box-open"></i> Products
    </a>
</div>
