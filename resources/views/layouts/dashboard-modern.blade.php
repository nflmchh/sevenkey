@extends('layouts.app-modern')

@section('title', 'Dashboard - SevenKey')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar-modern d-none d-lg-block position-fixed top-0 start-0 h-100" style="width: 240px; z-index: 1000;">
        <div class="d-flex flex-column h-100" style="background: #ffffff; border-right: 1px solid #e5e7eb;">
            <!-- Logo Section -->
            <div class="p-4 border-bottom" style="border-color: #e5e7eb !important;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center rounded me-3" style="width: 32px; height: 32px; background: #3b82f6;">
                        <i class="fas fa-key text-white" style="font-size: 14px;"></i>
                    </div>
                    <div>
                        <h5 class="text-gray-900 fw-bold mb-0" style="font-size: 1rem; letter-spacing: -0.025em; color: #111827;">SevenKey</h5>
                        <small class="text-muted" style="font-size: 0.7rem; color: #6b7280;">Business System</small>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-3 border-bottom" style="border-color: #e5e7eb !important;">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center rounded me-3" style="width: 32px; height: 32px; background: #3b82f6;">
                        <span class="text-white fw-semibold" style="font-size: 0.75rem;">
                            @if(Auth::check())
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold" style="font-size: 0.8rem; color: #111827;">
                            @if(Auth::check())
                                {{ Auth::user()->name }}
                            @else
                                Guest
                            @endif
                        </div>
                        <div class="text-muted" style="font-size: 0.7rem; color: #6b7280;">
                            @if(Auth::check())
                                {{ Auth::user()->getRoleDisplayName() }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-grow-1 px-3 py-4">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <div class="mb-2">
                        @if(Auth::check() && Auth::user()->hasRole('superadmin'))
                            <a class="nav-link {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('superadmin.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif(Auth::check() && Auth::user()->hasRole('admin_gudang'))
                            <a class="nav-link {{ request()->routeIs('admin-gudang.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin-gudang.dashboard') }}">
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

                    @if(Auth::check() && Auth::user()->hasAnyRole(['superadmin', 'owner']))
                    <!-- User Management -->
                    <div class="mb-3">
                        <div class="nav-group-title">
                            <span>User Management</span>
                        </div>
                        <a class="nav-link {{ request()->routeIs('superadmin.users.*') ? 'active' : '' }}" 
                           href="{{ route('superadmin.users.index') }}">
                            <i class="fas fa-users"></i>
                            <span>Manage Users</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::check() && Auth::user()->hasAnyRole(['superadmin', 'owner', 'admin_gudang', 'operator_gudang']))
                    <!-- Inventory Management -->
                    <div class="mb-3">
                        <div class="nav-group-title">
                            <span>Inventory</span>
                        </div>
                        <a class="nav-link {{ request()->routeIs('superadmin.products.*') ? 'active' : '' }}" 
                           href="#" id="productsSidebarDropdown" class="nav-link sidebar-dropdown-toggle" onclick="toggleSidebarDropdown(event)">
                            <i class="fas fa-boxes"></i>
                            <span class="flex-grow-1 ms-2">Products</span>
                            <span class="chevron-right" style="margin-left:auto;display:flex;align-items:center;"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <style>
                        #productsSidebarDropdown { margin-bottom: -4px !important; }
                        #stockProductSidebarDropdown { margin-top: -4px !important; }
                        </style>
                        <ul class="sidebar-dropdown-list" id="productsSidebarDropdownList" style="max-height:0;overflow:hidden;transition:max-height 0.3s cubic-bezier(.4,0,.2,1);background:#f8f9fa;border-radius:0.5rem;margin-top:4px;">
                            <li><a class="dropdown-item" href="/admin-gudang/products?kategori=T-Shirt">T-Shirt</a></li>
                            <li><a class="dropdown-item" href="/admin-gudang/products?kategori=Hoodie">Hoodie</a></li>
                            <li><a class="dropdown-item" href="/admin-gudang/products?kategori=Kemeja">Kemeja</a></li>
                            <li><a class="dropdown-item" href="/admin-gudang/products?kategori=Celana">Celana</a></li>
                            <li><a class="dropdown-item" href="/admin-gudang/products?kategori=Jaket">Jaket</a></li>
                            <li><a class="dropdown-item" href="/admin-gudang/products?kategori=Topi">Topi</a></li>
                            <li><a class="dropdown-item" href="/admin-gudang/catalog"><i class="fas fa-th-large me-2"></i>Catalog Produk</a></li>
                        </ul>
                        <a class="nav-link sidebar-dropdown-toggle" href="#" id="stockProductSidebarDropdown" onclick="toggleSidebarDropdownCustom(event, 'stockProductSidebarDropdownList', this)" style="margin-top:0px;">
                            <i class="fas fa-tasks"></i>
                            <span class="flex-grow-1 ms-2">Activity</span>
                            <span class="chevron-right" style="margin-left:auto;display:flex;align-items:center;"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <ul class="sidebar-dropdown-list" id="stockProductSidebarDropdownList" style="max-height:0;overflow:hidden;transition:max-height 0.3s cubic-bezier(.4,0,.2,1);background:#f8f9fa;border-radius:0.5rem;margin-top:0px;">
                            <li><a class="dropdown-item" href="/admin-gudang/stock-masuk">Stock Masuk</a></li>
                            <li><a class="dropdown-item" href="/admin-gudang/stock-keluar">Stock Keluar</a></li>
                        </ul>
                        <script>
                        function toggleSidebarDropdown(e) {
                            e.preventDefault();
                            var list = document.getElementById('productsSidebarDropdownList');
                            var link = document.getElementById('productsSidebarDropdown');
                            if (list.style.maxHeight === '0px' || list.style.maxHeight === '' ) {
                                list.style.maxHeight = list.scrollHeight + 'px';
                                link.classList.add('active');
                            } else {
                                list.style.maxHeight = '0px';
                                link.classList.remove('active');
                            }
                        }

                        function toggleSidebarDropdownCustom(e, listId, linkElem) {
                            e.preventDefault();
                            var list = document.getElementById(listId);
                            if (list.style.maxHeight === '0px' || list.style.maxHeight === '' ) {
                                list.style.maxHeight = list.scrollHeight + 'px';
                                linkElem.classList.add('active');
                            } else {
                                list.style.maxHeight = '0px';
                                linkElem.classList.remove('active');
                            }
                        }
                        </script>
                        <style>
                        .sidebar-dropdown-toggle.active {
                            background: #e9ecef;
                            color: #007bff;
                        }
                        .sidebar-dropdown-list {
                            padding: 0;
                        }
                        .sidebar-dropdown-list .dropdown-item {
                            padding: 8px 32px 8px 40px;
                            font-size: 0.8rem;
                            font-family: inherit;
                            font-weight: 500;
                            color: #6b7280;
                            border-radius: 0.3rem;
                            transition: background 0.2s, color 0.2s;
                            margin: 0;
                        }
                        .sidebar-dropdown-list .dropdown-item:hover {
                            background: #e2e6ea;
                            color: #007bff;
                        }
                        </style>
                    </div>
                    @endif

                    <!-- Additional Navigation Items -->

                    <div class="mb-3">
                        <div class="nav-group-title">
                            <span>Tools</span>
                        </div>
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" style="margin-left: 240px; min-height: 100vh;">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container-fluid px-4 py-3">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h1 class="page-title">@yield('page-title', 'Overview')</h1>
                                <nav class="breadcrumb-nav">
                                    <span class="breadcrumb-item">SevenKey</span>
                                    <span class="breadcrumb-separator">/</span>
                                    <span class="breadcrumb-item current">@yield('breadcrumb', 'Dashboard')</span>
                                </nav>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <!-- Export Button -->
                                <button class="btn-export">
                                    <i class="fas fa-download me-2"></i>Export
                        </button>
                        
                        <!-- Date Display -->
                        <div class="date-display">
                            <div class="date-label">{{ now()->format('F, Y') }}</div>
                        </div>
                        
                        <!-- User Avatar -->
                        <div class="user-avatar">
                            <div class="avatar-circle">
                                @if(Auth::check())
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @else
                                    -
                                @endif
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-area">
            <div class="container-fluid px-4 pb-4">
                <div class="row">
                    <div class="col-12">
                        @yield('dashboard-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Bottom Navigation -->
<div class="d-lg-none mobile-nav">
    <div class="mobile-nav-container">
        <a href="{{ Auth::check() && Auth::user()->hasRole('superadmin') ? route('superadmin.dashboard') : route('dashboard') }}" class="mobile-nav-item {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        @if(Auth::check() && Auth::user()->hasAnyRole(['superadmin', 'owner']))
        <a href="{{ route('superadmin.users.index') }}" class="mobile-nav-item {{ request()->routeIs('superadmin.users.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        @endif
        @if(Auth::check() && Auth::user()->hasAnyRole(['superadmin', 'owner', 'admin_gudang', 'operator_gudang']))
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
    margin-bottom: 0px !important;
}

/* Navigation Group Titles */
.nav-group-title {
    color: #6b7280;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 6px;
    padding: 0 12px;
}

/* Navigation Links */
.nav-link {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    color: #6b7280;
    text-decoration: none;
    border-radius: 6px;
    margin-bottom: 1px;
    transition: all 0.2s ease;
    font-size: 0.8rem;
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
    width: 16px;
    margin-right: 10px;
    font-size: 14px;
}

/* Logout Button */
.btn-logout {
    width: 100%;
    padding: 8px 12px;
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    border-radius: 6px;
    font-size: 0.8rem;
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
    font-size: 1.5rem;
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

/* Export Button */
.btn-export {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-export:hover {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

/* Date Display */
.date-display {
    padding: 8px 16px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
}

.date-label {
    color: #64748b;
    font-size: 0.875rem;
    font-weight: 500;
}

/* User Avatar */
.user-avatar .avatar-circle {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
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
        margin-left: 240px !important;
        width: calc(100% - 240px) !important;
    }
}

/* Bootstrap Grid Overrides for Full Width */
.row {
    margin-left: 0 !important;
    margin-right: 0 !important;
    width: 100% !important;
}

.col-12 {
    padding-left: 0 !important;
    padding-right: 0 !important;
    width: 100% !important;
}

/* Stats row specific */
.row.g-3 > * {
    padding-left: 8px !important;
    padding-right: 8px !important;
}

.row.g-3 {
    margin-left: -8px !important;
    margin-right: -8px !important;
}

/* Modern Cards Full Width */
.modern-card {
    width: 100%;
    margin: 0;
}

/* Content Area Full Width */
.content-area {
    background: #f8fafc;
    width: 100%;
    padding: 0;
}

/* Top Bar Full Width */
.top-bar {
    background: white;
    border-bottom: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    width: 100%;
}

/* Base Mobile Settings */
@media (max-width: 768px) {
    html, body {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    
    * {
        box-sizing: border-box !important;
    }
    
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: hidden !important;
        position: relative !important;
    }
    
    .container-fluid {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: none !important;
    }
    
    .content-area {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }
    
    .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
    }
    
    .col-12 {
        padding-left: 12px !important;
        padding-right: 12px !important;
        width: 100% !important;
    }
    
    .row.g-3 > * {
        padding-left: 6px !important;
        padding-right: 6px !important;
        margin-bottom: 12px !important;
    }
    
    .row.g-3 {
        margin-left: -6px !important;
        margin-right: -6px !important;
    }
    
    .top-bar {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .top-bar .container-fluid {
        padding-left: 12px !important;
        padding-right: 12px !important;
    }
}

@media (max-width: 576px) {
    html, body {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    
    * {
        box-sizing: border-box !important;
    }
    
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: hidden !important;
        position: relative !important;
    }
    
    .container-fluid {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: none !important;
    }
    
    .content-area {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }
    
    .col-12 {
        padding-left: 8px !important;
        padding-right: 8px !important;
        width: 100% !important;
    }
    
    .row.g-3 > * {
        padding-left: 4px !important;
        padding-right: 4px !important;
        margin-bottom: 8px !important;
    }
    
    .row.g-3 {
        margin-left: -4px !important;
        margin-right: -4px !important;
    }
    
    .col-xl-3, .col-md-6, .col-sm-6 {
        flex: 0 0 auto;
        width: 100% !important;
        margin-bottom: 8px !important;
    }
    
    .top-bar .container-fluid {
        padding-left: 8px !important;
        padding-right: 8px !important;
    }
    
    .page-title {
        font-size: 1.25rem !important;
    }
    
    .breadcrumb-nav {
        font-size: 0.75rem !important;
    }
    
    .btn-export {
        padding: 6px 12px !important;
        font-size: 0.75rem !important;
    }
}

/* Ensure full width content */
.main-content {
    min-height: 100vh;
    width: 100%;
    box-sizing: border-box;
}

.container-fluid {
    width: 100% !important;
    max-width: none !important;
    padding-left: 16px !important;
    padding-right: 16px !important;
}

/* Full width for all viewports */
@media (min-width: 576px) {
    .container-fluid {
        padding-left: 16px !important;
        padding-right: 16px !important;
    }
}

@media (min-width: 768px) {
    .container-fluid {
        padding-left: 16px !important;
        padding-right: 16px !important;
    }
}

@media (min-width: 992px) {
    .container-fluid {
        padding-left: 16px !important;
        padding-right: 16px !important;
    }
}

@media (min-width: 1200px) {
    .container-fluid {
        padding-left: 16px !important;
        padding-right: 16px !important;
    }
}

@media (min-width: 1400px) {
    .container-fluid {
        padding-left: 16px !important;
        padding-right: 16px !important;
    }
}

/* Card improvements for dashboard content */
.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

/* Modern Cards */
.modern-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: none;
    transition: all 0.3s ease;
}

.modern-card:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

.modern-card-header {
    padding: 24px 24px 0 24px;
    border-bottom: none;
    display: flex;
    align-items: center;
    justify-content: between;
}

.modern-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    flex-grow: 1;
}

.modern-card-toolbar {
    display: flex;
    gap: 8px;
}

.modern-card-body {
    padding: 24px;
}

/* Stats Cards */
.stats-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

.stats-card.compact {
    border-radius: 8px;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.stats-card-body {
    padding: 20px;
}

.stats-card.compact .stats-card-body {
    padding: 16px;
}

.stats-label {
    color: #6b7280;
    font-size: 0.8rem;
    font-weight: 500;
    margin-bottom: 6px;
}

.stats-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 6px;
}

.stats-card.compact .stats-value {
    font-size: 1.5rem;
}

.stats-change {
    font-size: 0.75rem;
    font-weight: 600;
}

.stats-change.positive {
    color: #10b981;
}

.stats-change.negative {
    color: #ef4444;
}

.stats-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.stats-card.compact .stats-icon {
    width: 36px;
    height: 36px;
    font-size: 14px;
}

.stats-icon.primary {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.stats-icon.success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.stats-icon.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.stats-icon.info {
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
}

/* Action Items */
.action-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.action-item {
    display: flex;
    align-items: center;
    padding: 16px;
    background: #f8fafc;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.action-item:hover {
    background: #f1f5f9;
    transform: translateX(4px);
}

.action-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
}

.action-icon.primary {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.action-icon.success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.action-icon.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.action-content {
    flex-grow: 1;
}

.action-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 4px;
}

.action-desc {
    font-size: 0.875rem;
    color: #64748b;
}

.action-arrow {
    color: #cbd5e1;
}

/* Buttons */
.btn-modern-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}

.btn-modern-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    color: white;
}

.btn-modern-outline {
    background: transparent;
    color: #64748b;
    border: 1px solid #e2e8f0;
    padding: 8px 16px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}

.btn-modern-outline:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
}

/* Modern Table */
.modern-table {
    width: 100%;
    margin-bottom: 0;
}

.modern-table th {
    border: none;
    background: none;
    color: #64748b;
    font-weight: 600;
    font-size: 0.875rem;
    padding: 16px 12px;
    border-bottom: 1px solid #f1f5f9;
}

.modern-table td {
    border: none;
    padding: 16px 12px;
    border-bottom: 1px solid #f8fafc;
}

.team-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

.team-name {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 4px;
}

.team-type {
    font-size: 0.875rem;
    color: #64748b;
}

.member-count {
    background: #f1f5f9;
    color: #64748b;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
}

.btn-action {
    background: none;
    border: none;
    color: #cbd5e1;
    padding: 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.btn-action:hover {
    background: #f8fafc;
    color: #64748b;
}

.table-footer {
    margin-top: 24px;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
}

.table-info {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #64748b;
    font-size: 0.875rem;
}

.pagination-btn {
    background: #3b82f6;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Admin Tools */
.admin-tool {
    display: flex;
    align-items: center;
    padding: 20px;
    background: #f8fafc;
    border-radius: 12px;
    transition: all 0.2s ease;
}

.admin-tool:hover {
    background: #f1f5f9;
    transform: translateY(-2px);
}

.admin-tool-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    font-size: 18px;
}

.admin-tool-icon.primary {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.admin-tool-icon.success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.admin-tool-icon.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.admin-tool-icon.info {
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
}

.admin-tool-title {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 4px;
}

.admin-tool-desc {
    font-size: 0.875rem;
    color: #64748b;
}

/* Stats cards improvements */
.card.bg-primary,
.card.bg-success,
.card.bg-warning,
.card.bg-info,
.card.bg-danger {
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary-active) 100%) !important;
}

.card.bg-success {
    background: linear-gradient(135deg, var(--bs-success) 0%, #0ea95c 100%) !important;
}

.card.bg-warning {
    background: linear-gradient(135deg, var(--bs-warning) 0%, #d19c00 100%) !important;
}

.card.bg-info {
    background: linear-gradient(135deg, var(--bs-info) 0%, #5b21b6 100%) !important;
}

.list-group-item {
    border: none;
    border-radius: 8px !important;
    margin-bottom: 2px;
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background: #f1f5f9;
    transform: translateX(4px);
}

/* Modern Components */
.modern-card {
    background: white;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}

.modern-card.compact {
    border-radius: 8px;
}

.modern-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transform: translateY(-1px);
}

.modern-card-header {
    padding: 16px 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: between;
}

.modern-card.compact .modern-card-header {
    padding: 12px 16px;
}

.modern-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    flex: 1;
}

.modern-card.compact .modern-card-title {
    font-size: 1rem;
}

.modern-card-toolbar {
    display: flex;
    gap: 12px;
}

.modern-card-body {
    padding: 20px;
}

.modern-card.compact .modern-card-body {
    padding: 16px;
}

/* Modern Buttons */
.btn-modern-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
}

.btn-modern-primary.compact {
    padding: 8px 16px;
    font-size: 0.8rem;
    border-radius: 6px;
}

.btn-modern-primary:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    color: white;
}

/* Search Components */
.search-section {
    background: #f8fafc;
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #e2e8f0;
}

.search-form {
    max-width: 350px;
}

.search-input-group {
    position: relative;
    display: flex;
    align-items: center;
    background: white;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}

.search-input-group:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
}

.search-icon {
    position: absolute;
    left: 12px;
    color: #64748b;
    z-index: 2;
    font-size: 14px;
}

.search-input {
    border: none;
    outline: none;
    padding: 8px 12px 8px 36px;
    font-size: 0.85rem;
    background: transparent;
    flex: 1;
    border-radius: 6px;
}

.search-btn {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 0 6px 6px 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-btn:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
}

/* Modern Table */
.modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    margin: 0;
}

.modern-table thead th {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    color: #475569;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 12px 16px;
    border: none;
    position: relative;
    white-space: nowrap;
}

.modern-table tbody tr {
    background: white;
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.2s ease;
}

.modern-table tbody tr:hover {
    background: #f8fafc;
    transform: scale(1.005);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.modern-table tbody td {
    padding: 12px 16px;
    border: none;
    vertical-align: middle;
    font-size: 0.85rem;
}

/* Table responsive */
.table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

/* Stats Cards Mobile */
@media (max-width: 768px) {
    .stats-card.compact .stats-card-body {
        padding: 12px !important;
    }
    
    .stats-card.compact .stats-value {
        font-size: 1.25rem !important;
    }
    
    .stats-card.compact .stats-label {
        font-size: 0.75rem !important;
    }
    
    .stats-card.compact .stats-icon {
        width: 32px !important;
        height: 32px !important;
        font-size: 12px !important;
    }
}

/* Modern Card Mobile */
@media (max-width: 768px) {
    .modern-card.compact {
        margin: 0 !important;
        width: 100% !important;
        border-radius: 6px !important;
    }
    
    .modern-card.compact .modern-card-header {
        padding: 10px 12px !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 10px !important;
    }
    
    .modern-card.compact .modern-card-title {
        font-size: 0.9rem !important;
    }
    
    .modern-card.compact .modern-card-body {
        padding: 12px !important;
    }
    
    .btn-modern-primary.compact {
        padding: 6px 12px !important;
        font-size: 0.75rem !important;
        width: 100% !important;
        justify-content: center !important;
    }
}

/* Search Section Mobile */
@media (max-width: 768px) {
    .search-section {
        padding: 8px !important;
        margin: 0 !important;
        border-radius: 6px !important;
    }
    
    .search-form {
        max-width: none !important;
        width: 100% !important;
    }
    
    .search-input-group {
        border-radius: 4px !important;
    }
    
    .search-input {
        padding: 6px 8px 6px 28px !important;
        font-size: 0.8rem !important;
    }
    
    .search-icon {
        left: 8px !important;
        font-size: 12px !important;
    }
    
/* Table Mobile Responsive */
@media (max-width: 768px) {
    .table-responsive {
        width: 100% !important;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        margin: 0 !important;
        border-radius: 6px !important;
    }
    
    .modern-table {
        min-width: 600px !important;
        width: 100% !important;
        border-radius: 6px !important;
        font-size: 0.75rem !important;
    }
    
    .modern-table thead th {
        padding: 8px 10px !important;
        font-size: 0.7rem !important;
        white-space: nowrap !important;
    }
    
    .modern-table tbody td {
        padding: 8px 10px !important;
        font-size: 0.75rem !important;
        white-space: nowrap !important;
    }
    
    .user-info {
        gap: 8px !important;
    }
    
    .user-avatar {
        width: 28px !important;
        height: 28px !important;
        font-size: 0.7rem !important;
        border-radius: 6px !important;
    }
    
    .user-name {
        font-size: 0.75rem !important;
    }
    
    .badge-modern {
        padding: 3px 6px !important;
        font-size: 0.65rem !important;
        border-radius: 4px !important;
    }
    
    .action-buttons {
        gap: 4px !important;
    }
    
    .btn-action {
        width: 28px !important;
        height: 28px !important;
        font-size: 0.7rem !important;
        border-radius: 4px !important;
    }
}

/* Mobile Navigation Improvements */
@media (max-width: 768px) {
    .mobile-nav {
        padding: 6px 0 !important;
        background: white !important;
        border-top: 1px solid #e2e8f0 !important;
        box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1) !important;
    }
    
    .mobile-nav-container {
        padding: 0 8px !important;
    }
    
    .mobile-nav-item {
        padding: 6px 8px !important;
        min-width: auto !important;
        flex: 1 !important;
        border-radius: 6px !important;
    }
    
    .mobile-nav-item i {
        font-size: 16px !important;
        margin-bottom: 2px !important;
    }
    
    .mobile-nav-item span {
        font-size: 0.65rem !important;
    }
}

/* Alert Mobile */
@media (max-width: 768px) {
    .alert {
        margin: 0 8px 12px 8px !important;
        padding: 8px 12px !important;
        border-radius: 6px !important;
        font-size: 0.8rem !important;
    }
}

/* User Info Components */
.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.user-details {
    flex: 1;
}

.user-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 0.9rem;
}

/* Modern Badges */
.badge-modern {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.badge-modern.primary {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #1d4ed8;
    border: 1px solid #93c5fd;
}

.badge-modern.success {
    background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
    color: #166534;
    border: 1px solid #86efac;
}

.badge-modern.warning {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    color: #92400e;
    border: 1px solid #fcd34d;
}

.badge-modern.danger {
    background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
    color: #991b1b;
    border: 1px solid #f87171;
}

.badge-modern.info {
    background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
    color: #3730a3;
    border: 1px solid #a5b4fc;
}

.badge-modern.secondary {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    color: #475569;
    border: 1px solid #cbd5e1;
}

.badge-modern.dark {
    background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
    color: #f9fafb;
    border: 1px solid #4b5563;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-action.info {
    background: linear-gradient(135deg, #e0f2fe 0%, #b3e5fc 100%);
    color: #0277bd;
    border: 1px solid #81d4fa;
}

.btn-action.info:hover {
    background: linear-gradient(135deg, #b3e5fc 0%, #81d4fa 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(2, 119, 189, 0.3);
}

.btn-action.warning {
    background: linear-gradient(135deg, #fff3e0 0%, #ffcc02 100%);
    color: #f57c00;
    border: 1px solid #ffb74d;
}

.btn-action.warning:hover {
    background: linear-gradient(135deg, #ffcc02 0%, #ff9800 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(245, 124, 0, 0.3);
}

.btn-action.danger {
    background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
    color: #d32f2f;
    border: 1px solid #ef5350;
}

.btn-action.danger:hover {
    background: linear-gradient(135deg, #ffcdd2 0%, #ef5350 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-state-content {
    max-width: 300px;
    margin: 0 auto;
}

/* Pagination */
.pagination-wrapper {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
}

/* Alert Improvements */
.alert {
    border: none;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
}

.alert-success {
    background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
    color: #065f46;
    border-left: 4px solid #10b981;
}

.alert-danger {
    background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
    color: #991b1b;
    border-left: 4px solid #ef4444;
}

/* Mobile Optimization Final */
@media (max-width: 768px) {
    /* Prevent all horizontal scroll */
    * {
        box-sizing: border-box !important;
    }
    
    html, body {
        overflow-x: hidden !important;
        position: relative !important;
        width: 100vw !important;
        max-width: 100vw !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    /* Main container full width */
    .container, .container-fluid {
        width: 100vw !important;
        max-width: 100vw !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        box-sizing: border-box !important;
    }
    
    /* Sidebar adjustments */
    .sidebar {
        width: 100% !important;
        max-width: 100% !important;
        position: fixed !important;
        top: 0 !important;
        left: -100% !important;
        z-index: 1050 !important;
        transition: left 0.3s ease !important;
    }
    
    .sidebar.show {
        left: 0 !important;
    }
    
    /* Main content area */
    .main-content {
        margin-left: 0 !important;
        width: 100vw !important;
        max-width: 100vw !important;
        padding: 10px !important;
        box-sizing: border-box !important;
    }
    
    /* Row and columns full width */
    .row {
        width: 100% !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        box-sizing: border-box !important;
    }
    
    .col, .col-12, .col-md-12, .col-lg-12, 
    [class*="col-"] {
        width: 100% !important;
        max-width: 100% !important;
        padding-left: 8px !important;
        padding-right: 8px !important;
        flex: 0 0 100% !important;
        box-sizing: border-box !important;
    }
    
    /* Prevent any div from overflowing */
    div, section, article, header, footer, nav, main {
        max-width: 100% !important;
        box-sizing: border-box !important;
    }
    
    /* Table responsive container */
    .table-responsive {
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        border: none !important;
        margin: 0 !important;
        box-sizing: border-box !important;
    }
    
    /* Table full width */
    .table, .modern-table {
        width: 100% !important;
        max-width: 100% !important;
        min-width: auto !important;
        font-size: 13px !important;
        margin: 0 !important;
        box-sizing: border-box !important;
    }
    
    .table th, .table td,
    .modern-table th, .modern-table td {
        padding: 6px 4px !important;
        font-size: 12px !important;
        white-space: nowrap !important;
        box-sizing: border-box !important;
    }
    
    /* Forms and inputs */
    .form-control, .form-select, input, select, textarea {
        width: 100% !important;
        max-width: 100% !important;
        font-size: 14px !important;
        box-sizing: border-box !important;
    }
    
    /* Cards and components */
    .card, .modern-card {
        width: 100% !important;
        max-width: 100% !important;
        margin-bottom: 1rem !important;
        box-sizing: border-box !important;
    }
    
    /* Buttons */
    .btn {
        margin-bottom: 8px !important;
        font-size: 13px !important;
        padding: 8px 12px !important;
        box-sizing: border-box !important;
    }
    
    /* Navigation adjustments */
    .navbar-brand {
        font-size: 16px !important;
        padding: 8px 12px !important;
    }
    
    /* Mobile menu toggle */
    .navbar-toggler {
        border: none !important;
        padding: 4px 8px !important;
        font-size: 14px !important;
    }
}

/* Extra small devices optimization */
@media (max-width: 576px) {
    .main-content {
        padding: 5px !important;
    }
    
    .container, .container-fluid {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }
    
    .col, [class*="col-"] {
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
    
    .btn {
        font-size: 12px !important;
        padding: 6px 10px !important;
    }
    
    .table th, .table td,
    .modern-table th, .modern-table td {
        padding: 4px 2px !important;
        font-size: 11px !important;
    }
}

/* Legacy Card Mobile Support */
@media (max-width: 768px) {
    .card {
        width: 100% !important;
        max-width: 100% !important;
        margin-bottom: 1rem !important;
        box-sizing: border-box !important;
    }
    
    .card-body {
        padding: 1rem !important;
        box-sizing: border-box !important;
    }
    
    .card-title {
        font-size: 0.9rem !important;
        margin-bottom: 0.5rem !important;
    }
    
    .card h3 {
        font-size: 1.5rem !important;
    }
    
    .card .fa-2x {
        font-size: 1.5em !important;
    }
    
    /* Chart containers */
    .chart-container {
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: auto !important;
        padding: 0 !important;
    }
    
    canvas {
        max-width: 100% !important;
        height: auto !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add any additional JavaScript functionality here
    console.log('SevenKey Dashboard loaded successfully');
});
</script>
@endsection
