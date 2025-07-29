@extends('layouts.dashboard-modern')

@section('page-title', 'Business Overview')
@section('breadcrumb', 'Owner Dashboard')

@section('dashboard-content')
<!-- Top Statistics Row -->
<div class="row g-3 mb-4">
    <!-- Business Stats -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">Omzet Bulan Ini</div>
                        <div class="stats-value">Rp 125M</div>
                        <div class="stats-change positive">+12.5%</div>
                    </div>
                    <div class="stats-icon primary">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">Profit Margin</div>
                        <div class="stats-value">23.5%</div>
                        <div class="stats-change positive">+2.3%</div>
                    </div>
                    <div class="stats-icon success">
                        <i class="fas fa-percentage"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">Total Karyawan</div>
                        <div class="stats-value">47</div>
                        <div class="stats-change positive">+3</div>
                    </div>
                    <div class="stats-icon warning">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Cabang Aktif</h6>
                        <h3 class="mb-0">12</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-store fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Business Overview -->
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-area me-2"></i>Grafik Penjualan
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center p-5">
                    <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Grafik penjualan akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-trophy me-2"></i>KPI Utama
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Target Bulanan</span>
                        <span class="fw-bold">85%</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Customer Satisfaction</span>
                        <span class="fw-bold">92%</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-primary" style="width: 92%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Efisiensi Operasional</span>
                        <span class="fw-bold">78%</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-warning" style="width: 78%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Strategic Decisions -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chess-king me-2"></i>Keputusan Strategis
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-building me-2"></i>Ekspansi Cabang Baru
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-handshake me-2"></i>Partnership & Kolaborasi
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-rocket me-2"></i>Inovasi Produk
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-chart-pie me-2"></i>Analisis Kompetitor
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Summary -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-money-bill-wave me-2"></i>Ringkasan Keuangan
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <h6 class="text-muted">Pendapatan</h6>
                        <h4 class="text-success">Rp 125M</h4>
                    </div>
                    <div class="col-6 mb-3">
                        <h6 class="text-muted">Pengeluaran</h6>
                        <h4 class="text-danger">Rp 95M</h4>
                    </div>
                    <div class="col-12">
                        <h6 class="text-muted">Laba Bersih</h6>
                        <h3 class="text-primary">Rp 30M</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-success">
    <i class="fas fa-crown me-2"></i>
    <strong>Owner Dashboard:</strong> Pantau performa bisnis Anda secara real-time dan buat keputusan strategis!
</div>
@endsection
