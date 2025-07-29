@extends('layouts.app-modern')

@section('title', 'Dashboard - SevenKey')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar-modern d-none d-lg-block position-fixed top-0 start-0 h-100" style="width: 280px; z-index: 1000; background-color: #1e2129;">
        <div class="d-flex flex-column h-100 p-0">
            <!-- Logo Section -->
            <div class="p-4 border-bottom border-secondary">
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded p-2 me-3">
                        <i class="fas fa-key text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-white fw-bold mb-0">SevenKey</h4>
                        <small class="text-muted">Business System</small>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-3 border-bottom border-secondary">
                <div class="d-flex align-items-center">
                    <div class="bg-light rounded-circle p-2 me-3">
                        <span class="text-primary fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <div class="text-white fw-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-muted small">{{ Auth::user()->getRoleDisplayName() }}</div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-grow-1 p-3">
                <!-- Dashboard -->
                <a href="{{ route('superadmin.dashboard') }}" class="d-flex align-items-center p-3 text-decoration-none rounded mb-2 {{ request()->routeIs('superadmin.dashboard') ? 'bg-primary text-white' : 'text-muted' }}">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    <span>Dashboard</span>
                </a>

                @if(Auth::user()->hasAnyRole(['superadmin', 'owner']))
                <!-- User Management -->
                <a href="{{ route('superadmin.users.index') }}" class="d-flex align-items-center p-3 text-decoration-none rounded mb-2 {{ request()->routeIs('superadmin.users.*') ? 'bg-primary text-white' : 'text-muted' }}">
                    <i class="fas fa-users me-3"></i>
                    <span>Manajemen User</span>
                </a>
                @endif

                @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'admin_gudang', 'operator_gudang']))
                <!-- Inventory Management -->
                <a href="{{ route('superadmin.products.index') }}" class="d-flex align-items-center p-3 text-decoration-none rounded mb-2 {{ request()->routeIs('superadmin.products.*') ? 'bg-primary text-white' : 'text-muted' }}">
                    <i class="fas fa-boxes me-3"></i>
                    <span>Inventori</span>
                </a>
                @endif
            </nav>

            <!-- Logout Button -->
            <div class="p-3 border-top border-secondary">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" style="margin-left: 280px; min-height: 100vh;">
        <!-- Top Bar -->
        <div class="bg-white border-bottom px-4 py-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="h3 mb-0">Dashboard</h1>
                    <small class="text-muted">SevenKey / Dashboard</small>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-end me-3">
                        <div class="small text-muted">{{ now()->format('l, d F Y') }}</div>
                        <div class="fw-bold">{{ now()->format('H:i') }} WIB</div>
                    </div>
                    <div class="bg-light rounded-circle p-2">
                        <span class="text-primary fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-4">
            @yield('dashboard-content')
        </div>
    </div>
</div>

<!-- Mobile responsive -->
<style>
@media (max-width: 991.98px) {
    .sidebar-modern {
        display: none !important;
    }
    
    .main-content {
        margin-left: 0 !important;
    }
}
</style>
@endsection
