@extends('layouts.dashboard-modern')

@section('page-title', 'Overview')
@section('breadcrumb', 'Dashboard')

@section('dashboard-content')
<!-- Top Statistics Row -->
<div class="row g-3 mb-4">
    <!-- Total Users Card -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">All time sales</div>
                        <div class="stats-value">{{ \App\Models\User::count() }}</div>
                        <div class="stats-change positive">+2.7%</div>
                    </div>
                    <div class="stats-icon primary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Products Card -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">Total Products</div>
                        <div class="stats-value">{{ \App\Models\Product::count() }}</div>
                        <div class="stats-change positive">+3.9%</div>
                    </div>
                    <div class="stats-icon success">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Card -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">Low Stock Items</div>
                        <div class="stats-value">{{ \App\Models\Product::whereRaw('stock <= min_stock')->count() }}</div>
                        <div class="stats-change negative">-0.7%</div>
                    </div>
                    <div class="stats-icon warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Value Card -->
    <div class="col-xl-3 col-md-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">Inventory Value</div>
                        <div class="stats-value">${{ number_format(\App\Models\Product::sum(\Illuminate\Support\Facades\DB::raw('stock * cost_price')), 0, ',', '.') }}</div>
                        <div class="stats-change positive">+8.2%</div>
                    </div>
                    <div class="stats-icon info">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<div class="row g-4">
    <!-- Quick Actions Card -->
    <div class="col-xl-4">
        <div class="modern-card compact">
            <div class="modern-card-header">
                <h3 class="modern-card-title">
                    <i class="fas fa-bolt text-primary me-2"></i>
                    Swift Setup for New Teams
                </h3>
            </div>
            <div class="modern-card-body">
                <p class="text-muted mb-3" style="font-size: 0.85rem;">
                    Enhance team formation and management with easy-to-use tools for communication, task organization, and progress tracking.
                </p>
                
                <div class="action-list">
                    <a href="{{ route('superadmin.users.create') }}" class="action-item">
                        <div class="action-icon primary">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="action-content">
                            <div class="action-title">Create New User</div>
                            <div class="action-desc">Add team members to your workspace</div>
                        </div>
                        <div class="action-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('superadmin.products.create') }}" class="action-item">
                        <div class="action-icon success">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="action-content">
                            <div class="action-title">Add Product</div>
                            <div class="action-desc">Expand your inventory catalog</div>
                        </div>
                        <div class="action-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('superadmin.users.index') }}" class="action-item">
                        <div class="action-icon warning">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="action-content">
                            <div class="action-title">Manage Users</div>
                            <div class="action-desc">Control user access and roles</div>
                        </div>
                        <div class="action-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>
                </div>

                <div class="mt-4">
                    <a href="{{ route('superadmin.users.create') }}" class="btn-modern-primary">
                        <i class="fas fa-rocket me-2"></i>Create Team
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Teams Management -->
    <div class="col-xl-8">
        <div class="modern-card">
            <div class="modern-card-header">
                <h3 class="modern-card-title">Teams</h3>
                <div class="modern-card-toolbar">
                    <button class="btn-modern-outline">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
            </div>
            <div class="modern-card-body">
                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Team</th>
                                <th>Description</th>
                                <th>Members</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="team-avatar bg-primary">PM</div>
                                        <div class="ms-3">
                                            <div class="team-name">Product Management</div>
                                            <div class="team-type">Product development & lifecycle</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted">Product development & lifecycle</td>
                                <td>
                                    <div class="team-members">
                                        <span class="member-count">+10</span>
                                    </div>
                                </td>
                                <td class="text-muted">21 Oct, 2024</td>
                                <td>
                                    <button class="btn-action">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="team-avatar bg-success">MT</div>
                                        <div class="ms-3">
                                            <div class="team-name">Marketing Team</div>
                                            <div class="team-type">Campaigns & market analysis</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted">Campaigns & market analysis</td>
                                <td>
                                    <div class="team-members">
                                        <span class="member-count">G</span>
                                    </div>
                                </td>
                                <td class="text-muted">15 Oct, 2024</td>
                                <td>
                                    <button class="btn-action">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="team-avatar bg-warning">HR</div>
                                        <div class="ms-3">
                                            <div class="team-name">HR Department</div>
                                            <div class="team-type">Talent acquisition, employee welfare</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted">Talent acquisition, employee welfare</td>
                                <td>
                                    <div class="team-members">
                                        <span class="member-count">+A</span>
                                    </div>
                                </td>
                                <td class="text-muted">10 Oct, 2024</td>
                                <td>
                                    <button class="btn-action">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="table-info">
                            Show <select class="form-select form-select-sm d-inline-block w-auto">
                                <option>5</option>
                                <option>10</option>
                                <option>25</option>
                            </select> per page
                        </div>
                        <div class="table-pagination">
                            <span class="text-muted">1-4 of 4</span>
                            <div class="pagination-controls ms-3">
                                <button class="pagination-btn">1</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Row -->
<div class="row g-6 mt-2">
    <!-- System Overview -->
    <div class="col-xl-12">
        <div class="modern-card">
            <div class="modern-card-header">
                <h3 class="modern-card-title">
                    <i class="fas fa-crown text-warning me-2"></i>
                    System Administration
                </h3>
            </div>
            <div class="modern-card-body">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="admin-tool">
                            <div class="admin-tool-icon primary">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="admin-tool-content">
                                <div class="admin-tool-title">Database</div>
                                <div class="admin-tool-desc">Backup & manage data</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="admin-tool">
                            <div class="admin-tool-icon success">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="admin-tool-content">
                                <div class="admin-tool-title">Analytics</div>
                                <div class="admin-tool-desc">Performance insights</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="admin-tool">
                            <div class="admin-tool-icon warning">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="admin-tool-content">
                                <div class="admin-tool-title">Settings</div>
                                <div class="admin-tool-desc">System configuration</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="admin-tool">
                            <div class="admin-tool-icon info">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="admin-tool-content">
                                <div class="admin-tool-title">Security</div>
                                <div class="admin-tool-desc">Access control</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
