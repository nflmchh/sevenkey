@extends('layouts.dashboard-modern')

@section('page-title', 'Warehouse Operations')
@section('breadcrumb', 'Operator Gudang Dashboard')

@section('dashboard-content')
<div class="row">
    <!-- Operational Stats -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Barang Diterima</h6>
                        <h3 class="mb-0">89</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-truck-loading fa-2x"></i>
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
                        <h6 class="card-title">Barang Dikirim</h6>
                        <h3 class="mb-0">67</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-shipping-fast fa-2x"></i>
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
                        <h6 class="card-title">Pending Verifikasi</h6>
                        <h3 class="mb-0">12</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-clock fa-2x"></i>
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
                        <h3 class="mb-0">85%</h3>
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
    <!-- Quick Actions -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-tasks me-2"></i>Tugas Operasional
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-primary w-100 p-3">
                            <i class="fas fa-qrcode fa-2x mb-2 d-block"></i>
                            Scan Barang Masuk
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-success w-100 p-3">
                            <i class="fas fa-check-circle fa-2x mb-2 d-block"></i>
                            Verifikasi Penerimaan
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-warning w-100 p-3">
                            <i class="fas fa-dolly fa-2x mb-2 d-block"></i>
                            Proses Pengiriman
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-info w-100 p-3">
                            <i class="fas fa-clipboard-list fa-2x mb-2 d-block"></i>
                            Stock Opname
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Tasks -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list-ul me-2"></i>Tugas Pending
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Verifikasi DO-001</h6>
                            <small class="text-muted">50 item elektronik</small>
                        </div>
                        <span class="badge bg-warning rounded-pill">Urgent</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Packing SO-045</h6>
                            <small class="text-muted">25 item fashion</small>
                        </div>
                        <span class="badge bg-info rounded-pill">Normal</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Quality Check</h6>
                            <small class="text-muted">Batch #2024-001</small>
                        </div>
                        <span class="badge bg-success rounded-pill">Low</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Work Schedule -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>Jadwal Kerja Hari Ini
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Aktivitas</th>
                                <th>Lokasi</th>
                                <th>Detail</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>08:00 - 10:00</td>
                                <td>Penerimaan Barang</td>
                                <td>Loading Dock A</td>
                                <td>Supplier XYZ - 100 items</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>10:00 - 12:00</td>
                                <td>Stock Opname</td>
                                <td>Warehouse B2</td>
                                <td>Kategori Elektronik</td>
                                <td><span class="badge bg-primary">Sedang Berjalan</span></td>
                            </tr>
                            <tr>
                                <td>13:00 - 15:00</td>
                                <td>Pengiriman</td>
                                <td>Loading Dock B</td>
                                <td>5 delivery orders</td>
                                <td><span class="badge bg-secondary">Belum Mulai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-primary">
    <i class="fas fa-hard-hat me-2"></i>
    <strong>Operator Gudang:</strong> Fokus pada operasional harian dan pastikan semua proses berjalan lancar!
</div>
@endsection
