@extends('layouts.auth')

@section('title', 'Register - SevenKey')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="auth-card p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">
                        <i class="fas fa-key me-2"></i>SevenKey
                    </h2>
                    <p class="text-muted">Buat akun baru</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            <i class="fas fa-user me-2"></i>Nama Lengkap
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autocomplete="name" 
                               autofocus
                               placeholder="Masukkan nama lengkap Anda">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               placeholder="Masukkan email Anda">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold">
                            <i class="fas fa-user-tag me-2"></i>Role/Jabatan
                        </label>
                        <select class="form-select @error('role') is-invalid @enderror" 
                                id="role" 
                                name="role" 
                                required>
                            <option value="">Pilih Role Anda</option>
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
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
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
                        <label for="password_confirmation" class="form-label fw-semibold">
                            <i class="fas fa-lock me-2"></i>Konfirmasi Password
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Ulangi password Anda">
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-user-plus me-2"></i>Daftar
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="mb-0">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                Masuk sekarang
                            </a>
                        </p>
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
        const descriptions = {
            'superadmin': 'Akses penuh ke semua fitur sistem',
            'owner': 'Akses ke laporan bisnis dan monitoring keseluruhan',
            'admin_gudang': 'Mengelola inventori dan stok barang',
            'operator_gudang': 'Operasional penerimaan dan pengiriman barang',
            'kasir': 'Melayani transaksi penjualan dan pembayaran',
            'supervisor_keuangan': 'Mengawasi dan mengelola keuangan',
            'marketing': 'Mengelola promosi dan strategi pemasaran'
        };
        
        // Remove existing description
        const existingDesc = document.querySelector('.role-description');
        if (existingDesc) {
            existingDesc.remove();
        }
        
        // Add new description
        if (selectedRole && descriptions[selectedRole]) {
            const desc = document.createElement('small');
            desc.className = 'text-muted role-description';
            desc.innerHTML = '<i class="fas fa-info-circle me-1"></i>' + descriptions[selectedRole];
            this.parentNode.appendChild(desc);
        }
    });
</script>
@endpush
@endsection
