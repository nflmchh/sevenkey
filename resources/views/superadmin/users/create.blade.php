@extends('layouts.dashboard-modern')

@section('dashboard-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Tambah User Baru</h3>
    <a href="{{ route('superadmin.users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Form Tambah User</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('superadmin.users.store') }}">
                    @csrf
                    
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-2"></i>Nama Lengkap
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               placeholder="Masukkan nama lengkap">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="Masukkan email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label">
                            <i class="fas fa-user-tag me-2"></i>Role/Jabatan
                        </label>
                        <select class="form-select @error('role') is-invalid @enderror" 
                                id="role" 
                                name="role" 
                                required>
                            <option value="">Pilih Role</option>
                            <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>
                                Super Admin
                            </option>
                            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>
                                Owner
                            </option>
                            <option value="admin_gudang" {{ old('role') == 'admin_gudang' ? 'selected' : '' }}>
                                Admin Gudang
                            </option>
                            <option value="operator_gudang" {{ old('role') == 'operator_gudang' ? 'selected' : '' }}>
                                Operator Gudang
                            </option>
                            <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>
                                Kasir
                            </option>
                            <option value="supervisor_keuangan" {{ old('role') == 'supervisor_keuangan' ? 'selected' : '' }}>
                                Supervisor Keuangan
                            </option>
                            <option value="marketing" {{ old('role') == 'marketing' ? 'selected' : '' }}>
                                Marketing
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text" id="roleDescription">
                            Pilih role untuk melihat deskripsi tugas
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   placeholder="Masukkan password (min. 8 karakter)">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">
                            <i class="fas fa-lock me-2"></i>Konfirmasi Password
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required 
                                   placeholder="Ulangi password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('superadmin.users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Toggle password confirmation visibility
    document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
        const password = document.getElementById('password_confirmation');
        const icon = this.querySelector('i');
        
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Role selection feedback
    document.getElementById('role').addEventListener('change', function() {
        const selectedRole = this.value;
        const descriptionElement = document.getElementById('roleDescription');
        
        const descriptions = {
            'superadmin': '🔴 Akses penuh ke semua fitur sistem termasuk manajemen user',
            'owner': '🟢 Akses ke laporan bisnis dan monitoring keseluruhan perusahaan',
            'admin_gudang': '🔵 Mengelola inventori, stok barang, dan pengaturan gudang',
            'operator_gudang': '🟡 Operasional harian penerimaan dan pengiriman barang',
            'kasir': '🟠 Melayani transaksi penjualan dan pembayaran customer',
            'supervisor_keuangan': '🟣 Mengawasi dan mengelola keuangan perusahaan',
            'marketing': '🔶 Mengelola promosi dan strategi pemasaran'
        };
        
        if (selectedRole && descriptions[selectedRole]) {
            descriptionElement.innerHTML = descriptions[selectedRole];
            descriptionElement.className = 'form-text text-info';
        } else {
            descriptionElement.innerHTML = 'Pilih role untuk melihat deskripsi tugas';
            descriptionElement.className = 'form-text';
        }
    });
</script>
@endpush
@endsection
