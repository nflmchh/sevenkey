@extends('layouts.app-modern')

@section('title', 'SevenKey - Business Management System')

@section('content')
<!-- Hero Section -->
<div class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #1b84ff 0%, #7239ea 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content text-white">
                    <div class="mb-4">
                        <span class="badge bg-white bg-opacity-20 text-white fw-semibold px-3 py-2 rounded-pill">
                            <i class="fas fa-key me-2"></i>Business Management System
                        </span>
                    </div>
                    <h1 class="display-4 fw-bolder mb-4">
                        Kelola Bisnis Anda dengan <span class="text-warning">SevenKey</span>
                    </h1>
                    <p class="fs-4 mb-5 text-white-50">
                        Sistem manajemen bisnis modern yang dirancang khusus untuk membantu Anda mengelola 
                        inventori, penjualan, keuangan, dan tim dengan mudah dan efisien.
                    </p>
                    
                    <div class="d-flex flex-wrap gap-3 mb-5">
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-5 py-3 fw-semibold">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg px-5 py-3 fw-semibold">
                            <i class="fas fa-play me-2"></i>Lihat Fitur
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="row g-4">
                        <div class="col-4">
                            <div class="text-center">
                                <h3 class="fw-bold mb-0">7+</h3>
                                <small class="text-white-50">Role Management</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <h3 class="fw-bold mb-0">100%</h3>
                                <small class="text-white-50">Responsive</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-center">
                                <h3 class="fw-bold mb-0">24/7</h3>
                                <small class="text-white-50">Support</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image text-center">
                    <div class="position-relative">
                        <!-- Dashboard Preview Card -->
                        <div class="card border-0 shadow-lg" style="transform: rotate(5deg); max-width: 500px; margin: 0 auto;">
                            <div class="card-header bg-primary text-white">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-30px me-2">
                                        <div class="symbol-label bg-warning rounded">
                                            <i class="fas fa-key text-dark fs-6"></i>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">SevenKey Dashboard</h6>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="bg-light-success rounded p-3 text-center">
                                            <i class="fas fa-users text-success fs-3 mb-2"></i>
                                            <h6 class="fw-bold mb-0">User Management</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-light-primary rounded p-3 text-center">
                                            <i class="fas fa-boxes text-primary fs-3 mb-2"></i>
                                            <h6 class="fw-bold mb-0">Inventory</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-light-warning rounded p-3 text-center">
                                            <i class="fas fa-cash-register text-warning fs-3 mb-2"></i>
                                            <h6 class="fw-bold mb-0">Sales</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-light-info rounded p-3 text-center">
                                            <i class="fas fa-chart-line text-info fs-3 mb-2"></i>
                                            <h6 class="fw-bold mb-0">Analytics</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 85%"></div>
                                </div>
                                <small class="text-muted">System Performance: 85%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Fitur Unggulan</h2>
            <p class="fs-5 text-muted">Kelola semua aspek bisnis Anda dalam satu platform yang terintegrasi</p>
        </div>

        <div class="row g-4">
            <!-- User Management -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <div class="symbol symbol-60px mx-auto">
                                <div class="symbol-label bg-light-primary rounded">
                                    <i class="fas fa-users text-primary fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-3">User Management</h4>
                        <p class="text-muted mb-4">
                            Kelola 7 role berbeda dengan sistem otorisasi yang fleksibel. 
                            Dari Superadmin hingga Marketing, setiap role memiliki akses yang tepat.
                        </p>
                        <ul class="list-unstyled text-start">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Role-based Access Control</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>User Registration Control</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Activity Monitoring</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Inventory Management -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <div class="symbol symbol-60px mx-auto">
                                <div class="symbol-label bg-light-warning rounded">
                                    <i class="fas fa-boxes text-warning fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-3">Inventory Control</h4>
                        <p class="text-muted mb-4">
                            Sistem inventori lengkap dengan tracking stok real-time, 
                            notifikasi stok rendah, dan manajemen supplier.
                        </p>
                        <ul class="list-unstyled text-start">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Real-time Stock Tracking</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Low Stock Alerts</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Profit Margin Calculator</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sales & Finance -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <div class="symbol symbol-60px mx-auto">
                                <div class="symbol-label bg-light-success rounded">
                                    <i class="fas fa-chart-line text-success fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-3">Sales & Finance</h4>
                        <p class="text-muted mb-4">
                            Kelola penjualan dan keuangan dengan laporan detail, 
                            analytics mendalam, dan dashboard yang informatif.
                        </p>
                        <ul class="list-unstyled text-start">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Sales Dashboard</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Financial Reports</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Performance Analytics</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background-color: var(--bs-light);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Siap untuk memulai?</h3>
                <p class="fs-5 text-muted mb-0">
                    Bergabunglah dengan ribuan bisnis yang telah mempercayai SevenKey 
                    untuk mengelola operasional mereka.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 fw-semibold">
                    <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-4 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-30px me-2">
                        <div class="symbol-label bg-primary rounded">
                            <i class="fas fa-key text-white fs-6"></i>
                        </div>
                    </div>
                    <span class="fw-semibold">SevenKey Business System</span>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <small class="text-muted">
                    © {{ date('Y') }} SevenKey. All rights reserved.
                </small>
            </div>
        </div>
    </div>
</footer>

<style>
.bg-light-success {
    background-color: rgba(var(--bs-success-rgb), 0.1);
}

.bg-light-primary {
    background-color: rgba(var(--bs-primary-rgb), 0.1);
}

.bg-light-warning {
    background-color: rgba(var(--bs-warning-rgb), 0.1);
}

.bg-light-info {
    background-color: rgba(var(--bs-info-rgb), 0.1);
}

.hero-content {
    animation: fadeInUp 1s ease-out;
}

.hero-image {
    animation: fadeInRight 1s ease-out 0.3s both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.card:hover {
    transform: translateY(-5px);
}

@media (max-width: 768px) {
    .hero-image .card {
        transform: rotate(0deg) !important;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
}
</style>
@endsection
