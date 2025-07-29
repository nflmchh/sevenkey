@extends('layouts.dashboard-modern')

@section('page-title', 'Sales Dashboard')
@section('breadcrumb', 'Kasir Dashboard')

@section('dashboard-content')
<div class="row">
    <!-- Sales Stats -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Transaksi Hari Ini</h6>
                        <h3 class="mb-0">127</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-cash-register fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Penjualan Hari Ini</h6>
                        <h3 class="mb-0">Rp 8.5M</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Rata-rata per Transaksi</h6>
                        <h3 class="mb-0">Rp 67K</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-line fa-2x"></i>
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
                        <h6 class="card-title">Target Harian</h6>
                        <h3 class="mb-0">92%</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-target fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- POS Actions -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>Point of Sale
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-success w-100 p-3">
                            <i class="fas fa-plus-circle fa-2x mb-2 d-block"></i>
                            Transaksi Baru
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-primary w-100 p-3">
                            <i class="fas fa-search fa-2x mb-2 d-block"></i>
                            Cari Produk
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-warning w-100 p-3">
                            <i class="fas fa-receipt fa-2x mb-2 d-block"></i>
                            Cetak Ulang Struk
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-info w-100 p-3">
                            <i class="fas fa-undo fa-2x mb-2 d-block"></i>
                            Retur/Refund
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-credit-card me-2"></i>Metode Pembayaran Hari Ini
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <h6 class="text-muted">Cash</h6>
                        <h4 class="text-success">Rp 4.2M</h4>
                        <small class="text-muted">49%</small>
                    </div>
                    <div class="col-6 mb-3">
                        <h6 class="text-muted">Debit Card</h6>
                        <h4 class="text-primary">Rp 2.8M</h4>
                        <small class="text-muted">33%</small>
                    </div>
                    <div class="col-6 mb-3">
                        <h6 class="text-muted">E-Wallet</h6>
                        <h4 class="text-warning">Rp 1.2M</h4>
                        <small class="text-muted">14%</small>
                    </div>
                    <div class="col-6 mb-3">
                        <h6 class="text-muted">Credit Card</h6>
                        <h4 class="text-info">Rp 0.3M</h4>
                        <small class="text-muted">4%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Transactions -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-history me-2"></i>Transaksi Terbaru
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>No. Transaksi</th>
                                <th>Customer</th>
                                <th>Item</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>14:30</td>
                                <td>TRX-001234</td>
                                <td>Andi Susanto</td>
                                <td>5 items</td>
                                <td>Rp 125,000</td>
                                <td>Cash</td>
                                <td><span class="badge bg-success">Berhasil</span></td>
                            </tr>
                            <tr>
                                <td>14:25</td>
                                <td>TRX-001233</td>
                                <td>Siti Nurhaliza</td>
                                <td>2 items</td>
                                <td>Rp 89,000</td>
                                <td>Debit</td>
                                <td><span class="badge bg-success">Berhasil</span></td>
                            </tr>
                            <tr>
                                <td>14:18</td>
                                <td>TRX-001232</td>
                                <td>Budi Santoso</td>
                                <td>8 items</td>
                                <td>Rp 340,000</td>
                                <td>E-Wallet</td>
                                <td><span class="badge bg-success">Berhasil</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-success">
    <i class="fas fa-cash-register me-2"></i>
    <strong>Kasir:</strong> Berikan pelayanan terbaik untuk setiap customer dan pastikan transaksi berjalan lancar!
</div>
@endsection
