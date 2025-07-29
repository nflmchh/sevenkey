@extends('layouts.dashboard-modern')

@section('page-title', 'Marketing Analytics')
@section('breadcrumb', 'Marketing Dashboard')

@section('dashboard-content')
<div class="row">
    <!-- Marketing Stats -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Leads Bulan Ini</h6>
                        <h3 class="mb-0">1,247</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
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
                        <h6 class="card-title">Conversion Rate</h6>
                        <h3 class="mb-0">18.5%</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-chart-line fa-2x"></i>
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
                        <h6 class="card-title">Campaign Aktif</h6>
                        <h3 class="mb-0">12</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-bullhorn fa-2x"></i>
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
                        <h6 class="card-title">ROI Marketing</h6>
                        <h3 class="mb-0">245%</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-trophy fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Marketing Tools -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-tools me-2"></i>Marketing Tools
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-primary w-100 p-3">
                            <i class="fas fa-envelope fa-2x mb-2 d-block"></i>
                            Email Campaign
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-success w-100 p-3">
                            <i class="fab fa-whatsapp fa-2x mb-2 d-block"></i>
                            WhatsApp Blast
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-warning w-100 p-3">
                            <i class="fab fa-instagram fa-2x mb-2 d-block"></i>
                            Social Media
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="#" class="btn btn-outline-info w-100 p-3">
                            <i class="fas fa-ad fa-2x mb-2 d-block"></i>
                            Paid Ads
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaign Performance -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Campaign Performance
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Flash Sale Weekend</span>
                        <span class="fw-bold text-success">95% (Excellent)</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-success" style="width: 95%"></div>
                    </div>
                    <small class="text-muted">ROI: 320% | Leads: 847</small>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Back to School</span>
                        <span class="fw-bold text-primary">78% (Good)</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-primary" style="width: 78%"></div>
                    </div>
                    <small class="text-muted">ROI: 210% | Leads: 542</small>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>New Product Launch</span>
                        <span class="fw-bold text-warning">65% (Average)</span>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-warning" style="width: 65%"></div>
                    </div>
                    <small class="text-muted">ROI: 145% | Leads: 289</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Customer Analytics -->
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-users-cog me-2"></i>Customer Analytics
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Demographics -->
                    <div class="col-md-6">
                        <h6 class="mb-3">Demographics</h6>
                        <div class="mb-2">
                            <small class="text-muted">Age 18-25 (Gen Z)</small>
                            <div class="progress">
                                <div class="progress-bar bg-primary" style="width: 35%">35%</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Age 26-35 (Millennial)</small>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: 45%">45%</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Age 36+ (Gen X)</small>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: 20%">20%</div>
                            </div>
                        </div>
                    </div>
                    <!-- Channels -->
                    <div class="col-md-6">
                        <h6 class="mb-3">Traffic Sources</h6>
                        <div class="mb-2">
                            <small class="text-muted">Organic Search</small>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: 40%">40%</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Social Media</small>
                            <div class="progress">
                                <div class="progress-bar bg-primary" style="width: 30%">30%</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Paid Ads</small>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: 20%">20%</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Direct</small>
                            <div class="progress">
                                <div class="progress-bar bg-info" style="width: 10%">10%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-rocket me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Buat Campaign Baru
                    </button>
                    <button class="btn btn-success">
                        <i class="fas fa-chart-line me-2"></i>Analisis Kompetitor
                    </button>
                    <button class="btn btn-warning">
                        <i class="fas fa-bullseye me-2"></i>Set Target Baru
                    </button>
                    <button class="btn btn-info">
                        <i class="fas fa-file-alt me-2"></i>Export Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Upcoming Tasks -->
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-check me-2"></i>Upcoming Marketing Tasks
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Campaign</th>
                                <th>Platform</th>
                                <th>Target</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>25 Jul 2024</td>
                                <td>Summer Sale</td>
                                <td>Instagram & Facebook</td>
                                <td>10,000 reach</td>
                                <td><span class="badge bg-warning">Planning</span></td>
                                <td><button class="btn btn-sm btn-primary">Edit</button></td>
                            </tr>
                            <tr>
                                <td>28 Jul 2024</td>
                                <td>Product Review Video</td>
                                <td>YouTube & TikTok</td>
                                <td>50,000 views</td>
                                <td><span class="badge bg-info">In Progress</span></td>
                                <td><button class="btn btn-sm btn-success">View</button></td>
                            </tr>
                            <tr>
                                <td>01 Aug 2024</td>
                                <td>Email Newsletter</td>
                                <td>Email Marketing</td>
                                <td>5,000 subscribers</td>
                                <td><span class="badge bg-secondary">Scheduled</span></td>
                                <td><button class="btn btn-sm btn-warning">Modify</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-info">
    <i class="fas fa-bullhorn me-2"></i>
    <strong>Marketing:</strong> Kembangkan strategi kreatif untuk meningkatkan brand awareness dan customer acquisition!
</div>
@endsection
