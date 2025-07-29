@extends('layouts.dashboard-modern')

@section('page-title', 'User Management')
@section('breadcrumb', 'Users')

@section('dashboard-content')
<div class="w-100">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius: 8px; border: none; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="border-radius: 8px; border: none; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.15);">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Cards Row -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="stats-card compact">
                <div class="stats-card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="stats-label">Total User</div>
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

    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">Superadmin</div>
                        <div class="stats-value">{{ \App\Models\User::where('role', 'superadmin')->count() }}</div>
                        <div class="stats-change positive">+3.9%</div>
                    </div>
                    <div class="stats-icon success">
                        <i class="fas fa-crown"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">Kasir</div>
                        <div class="stats-value">{{ \App\Models\User::where('role', 'kasir')->count() }}</div>
                        <div class="stats-change positive">+8.2%</div>
                    </div>
                    <div class="stats-icon warning">
                        <i class="fas fa-cash-register"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="stats-card compact">
            <div class="stats-card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stats-label">User Baru Hari Ini</div>
                        <div class="stats-value">{{ \App\Models\User::whereDate('created_at', today())->count() }}</div>
                        <div class="stats-change positive">+100%</div>
                    </div>
                    <div class="stats-icon info">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Card -->
<div class="modern-card compact">
    <div class="modern-card-header">
        <h3 class="modern-card-title">
            <i class="fas fa-users text-primary me-2"></i>
            Manajemen User
        </h3>
        <div class="modern-card-toolbar">
            <a href="{{ route('superadmin.users.create') }}" class="btn-modern-primary compact">
                <i class="fas fa-plus me-2"></i>Tambah User
            </a>
        </div>
    </div>
    <div class="modern-card-body">
        <!-- Search Bar -->
        <div class="search-section mb-3">
            <form method="GET" class="search-form">
                <div class="search-input-group">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" class="search-input" placeholder="Cari user..." value="{{ request('search') }}">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <span class="badge-modern secondary">{{ $user->id }}</span>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted">{{ $user->email }}</span>
                        </td>
                        <td>
                            <span class="badge-modern 
                                @if($user->role == 'superadmin') danger
                                @elseif($user->role == 'owner') success
                                @elseif($user->role == 'admin_gudang') primary
                                @elseif($user->role == 'operator_gudang') info
                                @elseif($user->role == 'kasir') warning
                                @elseif($user->role == 'supervisor_keuangan') secondary
                                @else dark
                                @endif">
                                <i class="fas fa-user-tag me-1"></i>{{ $user->getRoleDisplayName() }}
                            </span>
                        </td>
                        <td>
                            <span class="text-muted small">{{ $user->created_at->format('d M Y') }}</span>
                            <div class="text-muted small">{{ $user->created_at->format('H:i') }}</div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('superadmin.users.show', $user) }}" class="btn-action info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('superadmin.users.edit', $user) }}" class="btn-action warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->id !== Auth::id())
                                <form method="POST" action="{{ route('superadmin.users.destroy', $user) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action danger" title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <div class="empty-state-content">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted mb-2">Tidak ada user yang ditemukan</h5>
                                <p class="text-muted small">Silakan tambah user baru atau ubah kata kunci pencarian</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
</div>
@endsection
