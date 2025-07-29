@extends('layouts.dashboard-modern')

@section('page-title', 'Welcome')
@section('breadcrumb', 'Dashboard')

@section('dashboard-content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-primary mb-3">
                    <i class="fas fa-user-circle me-2"></i>Selamat Datang, {{ $user->name }}!
                </h3>
                <p class="text-muted mb-4">
                    Anda login sebagai <strong>{{ $user->getRoleDisplayName() }}</strong>
                </p>
                
                @switch($user->role)
                    @case('superadmin')
                        <a href="{{ route('superadmin.dashboard') }}" class="btn btn-custom">
                            <i class="fas fa-crown me-2"></i>Masuk ke Dashboard Superadmin
                        </a>
                        @break
                    @case('owner')
                        <a href="{{ route('owner.dashboard') }}" class="btn btn-custom">
                            <i class="fas fa-building me-2"></i>Masuk ke Dashboard Owner
                        </a>
                        @break
                    @case('admin_gudang')
                        <a href="{{ route('admin-gudang.dashboard') }}" class="btn btn-custom">
                            <i class="fas fa-warehouse me-2"></i>Masuk ke Dashboard Admin Gudang
                        </a>
                        @break
                    @case('operator_gudang')
                        <a href="{{ route('operator-gudang.dashboard') }}" class="btn btn-custom">
                            <i class="fas fa-hard-hat me-2"></i>Masuk ke Dashboard Operator Gudang
                        </a>
                        @break
                    @case('kasir')
                        <a href="{{ route('kasir.dashboard') }}" class="btn btn-custom">
                            <i class="fas fa-cash-register me-2"></i>Masuk ke Dashboard Kasir
                        </a>
                        @break
                    @case('supervisor_keuangan')
                        <a href="{{ route('supervisor-keuangan.dashboard') }}" class="btn btn-custom">
                            <i class="fas fa-chart-pie me-2"></i>Masuk ke Dashboard Supervisor Keuangan
                        </a>
                        @break
                    @case('marketing')
                        <a href="{{ route('marketing.dashboard') }}" class="btn btn-custom">
                            <i class="fas fa-bullhorn me-2"></i>Masuk ke Dashboard Marketing
                        </a>
                        @break
                @endswitch
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Role Information -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informasi Role
                </h5>
            </div>
            <div class="card-body">
                @switch($user->role)
                    @case('superadmin')
                        <p>Sebagai <strong>Superadmin</strong>, Anda memiliki akses penuh ke semua fitur sistem:</p>
                        <ul>
                            <li>Manajemen user dan role</li>
                            <li>Konfigurasi sistem</li>
                            <li>Backup dan restore database</li>
                            <li>Monitoring sistem</li>
                            <li>Akses ke semua modul</li>
                        </ul>
                        @break
                    @case('owner')
                        <p>Sebagai <strong>Owner</strong>, Anda dapat memonitor bisnis secara menyeluruh:</p>
                        <ul>
                            <li>Dashboard bisnis dan analitik</li>
                            <li>Laporan keuangan lengkap</li>
                            <li>KPI dan performa bisnis</li>
                            <li>Strategi dan planning</li>
                        </ul>
                        @break
                    @case('admin_gudang')
                        <p>Sebagai <strong>Admin Gudang</strong>, Anda bertanggung jawab atas:</p>
                        <ul>
                            <li>Manajemen inventori</li>
                            <li>Stock opname</li>
                            <li>Laporan stok dan pergerakan barang</li>
                            <li>Koordinasi dengan supplier</li>
                        </ul>
                        @break
                    @case('operator_gudang')
                        <p>Sebagai <strong>Operator Gudang</strong>, tugas Anda meliputi:</p>
                        <ul>
                            <li>Penerimaan dan pengiriman barang</li>
                            <li>Scanning dan labeling</li>
                            <li>Pemindahan dan penyimpanan</li>
                            <li>Quality control</li>
                        </ul>
                        @break
                    @case('kasir')
                        <p>Sebagai <strong>Kasir</strong>, Anda menangani:</p>
                        <ul>
                            <li>Transaksi penjualan</li>
                            <li>Pembayaran dan kembalian</li>
                            <li>Customer service</li>
                            <li>Laporan penjualan harian</li>
                        </ul>
                        @break
                    @case('supervisor_keuangan')
                        <p>Sebagai <strong>Supervisor Keuangan</strong>, Anda mengawasi:</p>
                        <ul>
                            <li>Cash flow dan budget</li>
                            <li>Approval pembayaran</li>
                            <li>Analisis keuangan</li>
                            <li>Compliance dan audit</li>
                        </ul>
                        @break
                    @case('marketing')
                        <p>Sebagai <strong>Marketing</strong>, fokus Anda pada:</p>
                        <ul>
                            <li>Strategi pemasaran</li>
                            <li>Campaign dan promosi</li>
                            <li>Analisis customer</li>
                            <li>Brand development</li>
                        </ul>
                        @break
                @endswitch
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Quick Stats
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <h6 class="text-muted">Hari Aktif</h6>
                        <h4 class="text-primary">{{ rand(1, 30) }}</h4>
                    </div>
                    <div class="col-6 mb-3">
                        <h6 class="text-muted">Login Terakhir</h6>
                        <h6 class="text-success">{{ now()->subDays(rand(0, 7))->diffForHumans() }}</h6>
                    </div>
                    <div class="col-12">
                        <h6 class="text-muted">Status Akun</h6>
                        <span class="badge bg-success fs-6">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-info">
    <i class="fas fa-lightbulb me-2"></i>
    <strong>Tips:</strong> Klik tombol di atas untuk masuk ke dashboard khusus sesuai role Anda dan akses fitur-fitur yang tersedia.
</div>
@endsection
