@extends('layouts.app-modern')

@section('title', 'Dashboard - SevenKey')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar-modern d-none d-lg-block position-fixed top-0 start-0 h-100" style="width: 280px; z-index: 1000;">
        <div class="d-flex flex-column h-100" style="background: #ffffff; border-right: 1px solid #e5e7eb;">
            <!-- Logo Section -->
            <div class="p-6 border-bottom" style="border-color: #e5e7eb !important;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center rounded-lg me-3" style="width: 40px; height: 40px; background: #3b82f6;">
                        <i class="fas fa-key text-white fs-5"></i>
                    </div>
                    <div>
                        <h4 class="text-gray-900 fw-bold mb-0" style="font-size: 1.125rem; letter-spacing: -0.025em; color: #111827;">SevenKey</h4>
                        <small class="text-muted" style="font-size: 0.75rem; color: #6b7280;">Business System</small>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-4 border-bottom" style="border-color: #e5e7eb !important;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center rounded-lg me-3" style="width: 36px; height: 36px; background: #3b82f6;">
                        <span class="text-white fw-semibold" style="font-size: 0.875rem;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold" style="font-size: 0.875rem; color: #111827;">{{ Auth::user()->name }}</div>
                        <div class="text-muted" style="font-size: 0.75rem; color: #6b7280;">{{ Auth::user()->getRoleDisplayName() }}</div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-grow-1 px-4 py-6">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <div class="mb-3">
                        @if(Auth::user()->hasRole('superadmin'))
                            <a class="nav-link {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('superadmin.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::user()->hasRole('owner'))
                            <a class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}" 
                               href="{{ route('owner.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::user()->hasRole('admin_gudang'))
                            <a class="nav-link {{ request()->routeIs('admin-gudang.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin-gudang.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::user()->hasRole('operator_gudang'))
                            <a class="nav-link {{ request()->routeIs('operator-gudang.dashboard') ? 'active' : '' }}" 
                               href="{{ route('operator-gudang.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::user()->hasRole('kasir'))
                            <a class="nav-link {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}" 
                               href="{{ route('kasir.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::user()->hasRole('supervisor_keuangan'))
                            <a class="nav-link {{ request()->routeIs('supervisor-keuangan.dashboard') ? 'active' : '' }}" 
                               href="{{ route('supervisor-keuangan.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::user()->hasRole('marketing'))
                            <a class="nav-link {{ request()->routeIs('marketing.dashboard') ? 'active' : '' }}" 
                               href="{{ route('marketing.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @else
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                               href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @endif
                    </div>
                
                    @if(Auth::user()->hasAnyRole(['superadmin', 'owner']))
                    <!-- User Management -->
                    <div class="nav-group-title mt-4">Manajemen User</div>
                    <div class="mb-2">
                        <a class="nav-link {{ request()->routeIs('superadmin.users.*') ? 'active' : '' }}" 
                           href="{{ route('superadmin.users.index') }}">
                            <i class="fas fa-users"></i>
                            <span>Daftar User</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'admin_gudang', 'operator_gudang']))
                    <!-- Inventory -->
                    <div class="nav-group-title mt-4">Inventori</div>
                    <div class="mb-2">
                        <a class="nav-link {{ request()->routeIs('superadmin.products.*') ? 'active' : '' }}" 
                           href="{{ route('superadmin.products.index') }}">
                            <i class="fas fa-boxes"></i>
                            <span>Daftar Produk</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'kasir']))
                    <!-- Penjualan -->
                    <div class="nav-group-title mt-4">Penjualan</div>
                    <div class="mb-2">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cash-register"></i>
                            <span>Kasir</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'supervisor_keuangan']))
                    <!-- Keuangan -->
                    <div class="nav-group-title mt-4">Keuangan</div>
                    <div class="mb-2">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-line"></i>
                            <span>Laporan</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'marketing']))
                    <!-- Marketing -->
                    <div class="nav-group-title mt-4">Marketing</div>
                    <div class="mb-2">
                        <a class="nav-link" href="#">
                            <i class="fas fa-bullhorn"></i>
                            <span>Campaign</span>
                        </a>
                    </div>
                    @endif
                </nav>

                <!-- User Menu -->
                <div class="p-4 border-top" style="border-color: #e5e7eb !important;">
                    <div class="space-y-1">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user-cog"></i>
                            <span>Profile</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="btn-logout">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- Main Content -->
    <div class="main-content" style="margin-left: 280px; min-height: 100vh;">
        <!-- Top Bar -->
        <div class="top-bar px-6 py-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                    <div class="breadcrumb-nav">
                        <span class="breadcrumb-item">SevenKey</span>
                        <span class="breadcrumb-separator">/</span>
                        <span class="breadcrumb-item current">@yield('breadcrumb', 'Dashboard')</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area px-6 pb-6">
            @yield('content')
        </div>
    </div>
</div>

<!-- Mobile Bottom Navigation -->
<div class="d-lg-none mobile-nav">
    <div class="mobile-nav-container">
        <a href="{{ Auth::user()->hasRole('superadmin') ? route('superadmin.dashboard') : route('dashboard') }}" class="mobile-nav-item {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        @if(Auth::user()->hasAnyRole(['superadmin', 'owner']))
        <a href="{{ route('superadmin.users.index') }}" class="mobile-nav-item {{ request()->routeIs('superadmin.users.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        @endif
        @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'admin_gudang', 'operator_gudang']))
        <a href="{{ route('superadmin.products.index') }}" class="mobile-nav-item {{ request()->routeIs('superadmin.products.*') ? 'active' : '' }}">
            <i class="fas fa-boxes"></i>
            <span>Products</span>
        </a>
        @endif
        <a href="#" class="mobile-nav-item">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </div>
</div>

<style>
/* Metronic-inspired styling - White Sidebar Theme */
.sidebar-modern {
    background: #ffffff;
    border-right: 1px solid #e5e7eb;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
}

/* Navigation Group Titles */
.nav-group-title {
    color: #6b7280;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 8px;
    padding: 0 16px;
}

/* Navigation Links */
.nav-link {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    color: #6b7280;
    text-decoration: none;
    border-radius: 8px;
    margin-bottom: 2px;
    transition: all 0.2s ease;
    font-size: 0.875rem;
    font-weight: 500;
}

.nav-link:hover {
    background: #f3f4f6;
    color: #374151;
    transform: translateX(2px);
}

.nav-link.active {
    background: #f3f4f6;
    color: #1f2937;
    border-left: 3px solid #3b82f6;
    font-weight: 600;
}

.nav-link i {
    width: 20px;
    margin-right: 12px;
    font-size: 16px;
}

/* Logout Button */
.btn-logout {
    width: 100%;
    padding: 12px 16px;
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-logout:hover {
    background: #dc2626;
    color: white;
    border-color: #dc2626;
}

/* Top Bar */
.top-bar {
    background: white;
    border-bottom: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.page-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    letter-spacing: -0.025em;
}

.breadcrumb-nav {
    display: flex;
    align-items: center;
    margin-top: 4px;
}

.breadcrumb-item {
    color: #64748b;
    font-size: 0.875rem;
}

.breadcrumb-item.current {
    color: #3b82f6;
    font-weight: 500;
}

.breadcrumb-separator {
    margin: 0 8px;
    color: #cbd5e1;
}

/* Content Area */
.content-area {
    background: #f8fafc;
}

/* Mobile Navigation */
.mobile-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: white;
    border-top: 1px solid #e2e8f0;
    z-index: 1020;
    padding: 8px 0;
}

.mobile-nav-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.mobile-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px 12px;
    color: #64748b;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
    min-width: 60px;
}

.mobile-nav-item.active {
    color: #3b82f6;
    background: rgba(59, 130, 246, 0.1);
}

.mobile-nav-item i {
    font-size: 18px;
    margin-bottom: 4px;
}

.mobile-nav-item span {
    font-size: 0.75rem;
    font-weight: 500;
}

/* Responsive adjustments */
@media (min-width: 1024px) {
    .main-content {
        margin-left: 280px !important;
    }
}

@media (max-width: 1023px) {
    .main-content {
        margin-left: 0 !important;
        padding-bottom: 80px;
    }
    
    .sidebar-modern {
        display: none !important;
    }
}
</style>
@endsection
                        @if(Auth::user()->hasAnyRole(['superadmin', 'admin_gudang']))
                        <a class="dropdown-item text-white-50" href="{{ route('superadmin.products.create') }}">
                            <i class="fas fa-plus me-2"></i>Tambah Produk
                        </a>
                        @endif
                        <a class="dropdown-item text-white-50" href="#">
                            <i class="fas fa-exclamation-triangle me-2"></i>Stok Rendah
                        </a>
                    </div>
                </div>
                @endif

                @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'kasir']))
                <a href="#" class="nav-link mb-2">
                    <i class="fas fa-cash-register me-2"></i>Penjualan
                </a>
                @endif

                @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'supervisor_keuangan']))
                <a href="#" class="nav-link mb-2">
                    <i class="fas fa-chart-line me-2"></i>Keuangan
                </a>
                @endif

                @if(Auth::user()->hasAnyRole(['superadmin', 'owner', 'marketing']))
                <a href="#" class="nav-link mb-2">
                    <i class="fas fa-bullhorn me-2"></i>Marketing
                </a>
                @endif

                <hr class="text-white-50">
                
                <a href="#" class="nav-link mb-2">
                    <i class="fas fa-user-cog me-2"></i>Profile
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Dashboard</h2>
                    <p class="text-muted mb-0">Selamat datang, {{ Auth::user()->name }}!</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ now()->format('d F Y, H:i') }}</small>
                </div>
            </div>

            @yield('dashboard-content')
        </div>
    </div>
</div>
@endsection
