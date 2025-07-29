@extends('layouts.dashboard-modern')

@section('dashboard-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Detail User</h3>
    <div>
        <a href="{{ route('superadmin.users.edit', $user) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('superadmin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <!-- User Profile Card -->
        <div class="card">
            <div class="card-body text-center">
                <div class="avatar mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text text-muted">{{ $user->email }}</p>
                <span class="badge 
                    @if($user->role == 'superadmin') bg-danger
                    @elseif($user->role == 'owner') bg-success
                    @elseif($user->role == 'admin_gudang') bg-primary
                    @elseif($user->role == 'operator_gudang') bg-info
                    @elseif($user->role == 'kasir') bg-warning
                    @elseif($user->role == 'supervisor_keuangan') bg-secondary
                    @else bg-dark
                    @endif fs-6">
                    {{ $user->getRoleDisplayName() }}
                </span>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('superadmin.users.edit', $user) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Edit User
                    </a>
                    @if($user->id !== Auth::id())
                    <form method="POST" action="{{ route('superadmin.users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100" 
                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                            <i class="fas fa-trash me-2"></i>Hapus User
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- User Information -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Informasi User</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>ID User:</strong></td>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap:</strong></td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td>{{ $user->getRoleDisplayName() }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Terdaftar:</strong></td>
                                <td>{{ $user->created_at->format('d F Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Update:</strong></td>
                                <td>{{ $user->updated_at->format('d F Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td><span class="badge bg-success">Aktif</span></td>
                            </tr>
                            <tr>
                                <td><strong>Login Terakhir:</strong></td>
                                <td>-</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Permissions -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Hak Akses Role: {{ $user->getRoleDisplayName() }}</h6>
            </div>
            <div class="card-body">
                @php
                    $permissions = [
                        'superadmin' => [
                            'Akses penuh ke semua fitur sistem',
                            'Manajemen user dan role',
                            'Backup dan restore database',
                            'Konfigurasi sistem',
                            'Laporan dan analytics lengkap'
                        ],
                        'owner' => [
                            'Dashboard owner dan laporan bisnis',
                            'Monitoring performa perusahaan',
                            'Analisis keuangan dan profit',
                            'Laporan strategis',
                            'Akses read-only ke semua modul'
                        ],
                        'admin_gudang' => [
                            'Manajemen inventori lengkap',
                            'Tambah, edit, hapus produk',
                            'Kelola supplier dan kategori',
                            'Laporan stok dan movement',
                            'Setting gudang dan lokasi'
                        ],
                        'operator_gudang' => [
                            'Penerimaan dan pengiriman barang',
                            'Update stok produk',
                            'Scan barcode dan tracking',
                            'Laporan operasional harian',
                            'Quality control'
                        ],
                        'kasir' => [
                            'Transaksi penjualan',
                            'Pembayaran dan refund',
                            'Cetak receipt',
                            'Laporan shift kasir',
                            'Manajemen customer'
                        ],
                        'supervisor_keuangan' => [
                            'Laporan keuangan lengkap',
                            'Approval transaksi besar',
                            'Budget planning dan monitoring',
                            'Cash flow management',
                            'Audit dan reconciliation'
                        ],
                        'marketing' => [
                            'Campaign management',
                            'Customer analytics',
                            'Promosi dan discount',
                            'Social media integration',
                            'Lead tracking dan conversion'
                        ]
                    ];
                @endphp

                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group list-group-flush">
                            @foreach($permissions[$user->role] ?? [] as $permission)
                            <li class="list-group-item">
                                <i class="fas fa-check-circle text-success me-2"></i>{{ $permission }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
