@extends('layouts.dashboard-modern')

@section('page-title', 'Financial Management')
@section('breadcrumb', 'Supervisor Keuangan Dashboard')

@section('dashboard-content')
<div class="row">
    <!-- Financial Stats -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Cash Flow Hari Ini</h6>
                        <h3 class="mb-0">Rp 15.2M</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-line fa-2x"></i>
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
                        <h6 class="card-title">Piutang</h6>
                        <h3 class="mb-0">Rp 2.8M</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-hand-holding-usd fa-2x"></i>
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
                        <h6 class="card-title">Hutang</h6>
                        <h3 class="mb-0">Rp 4.5M</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-file-invoice-dollar fa-2x"></i>
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
                        <h6 class="card-title">Profit Margin</h6>
                        <h3 class="mb-0">23.8%</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-percentage fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Financial Management -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calculator me-2"></i>Manajemen Keuangan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-primary w-100 p-3">
                            <i class="fas fa-file-invoice fa-2x mb-2 d-block"></i>
                            Buat Invoice
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-success w-100 p-3">
                            <i class="fas fa-money-check-alt fa-2x mb-2 d-block"></i>
                            Pembayaran
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-warning w-100 p-3">
                            <i class="fas fa-chart-pie fa-2x mb-2 d-block"></i>
                            Budget Planning
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-info w-100 p-3">
                            <i class="fas fa-file-excel fa-2x mb-2 d-block"></i>
                            Laporan Keuangan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Health -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-heartbeat me-2"></i>Kesehatan Keuangan
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Likuiditas</span>
                        <span class="fw-bold text-success">Baik (85%)</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Profitabilitas</span>
                        <span class="fw-bold text-primary">Sangat Baik (92%)</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-primary" style="width: 92%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Solvabilitas</span>
                        <span class="fw-bold text-warning">Perlu Perhatian (68%)</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-warning" style="width: 68%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Efisiensi Operasional</span>
                        <span class="fw-bold text-info">Baik (78%)</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-info" style="width: 78%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pending Approvals -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clipboard-check me-2"></i>Pending Approval
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Purchase Order #PO-2024-001</h6>
                            <small class="text-muted">Rp 15,000,000</small>
                        </div>
                        <div>
                            <span class="badge bg-warning rounded-pill me-2">Urgent</span>
                            <button class="btn btn-sm btn-success">Approve</button>
                        </div>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Expense Request #EXP-2024-045</h6>
                            <small class="text-muted">Rp 2,500,000</small>
                        </div>
                        <div>
                            <span class="badge bg-info rounded-pill me-2">Normal</span>
                            <button class="btn btn-sm btn-success">Approve</button>
                        </div>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Budget Revision Q2</h6>
                            <small class="text-muted">Department Marketing</small>
                        </div>
                        <div>
                            <span class="badge bg-primary rounded-pill me-2">Review</span>
                            <button class="btn btn-sm btn-success">Approve</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cash Flow Chart -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-area me-2"></i>Cash Flow Trend
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center p-4">
                    <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Cash flow chart akan ditampilkan di sini</p>
                    <div class="row text-center">
                        <div class="col-4">
                            <small class="text-muted">Pemasukan</small>
                            <h6 class="text-success">↑ 15.2M</h6>
                        </div>
                        <div class="col-4">
                            <small class="text-muted">Pengeluaran</small>
                            <h6 class="text-danger">↓ 12.8M</h6>
                        </div>
                        <div class="col-4">
                            <small class="text-muted">Net Flow</small>
                            <h6 class="text-primary">+ 2.4M</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-warning">
    <i class="fas fa-chart-pie me-2"></i>
    <strong>Supervisor Keuangan:</strong> Monitor kesehatan keuangan perusahaan dan pastikan cash flow tetap stabil!
</div>
@endsection
