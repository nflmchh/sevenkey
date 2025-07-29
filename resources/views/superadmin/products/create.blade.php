@extends('layouts.dashboard-modern')

@section('dashboard-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Tambah Produk Baru</h3>
    <a href="{{ route('superadmin.products.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('superadmin.products.store') }}">
    @csrf
    
    <div class="row">
        <div class="col-md-8">
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Informasi Dasar</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="code" class="form-label">Kode Produk *</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                   id="code" name="code" value="{{ old('code') }}" 
                                   placeholder="contoh: PR001">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Kode unik untuk identifikasi produk</div>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Produk *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Masukkan nama produk">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Deskripsi lengkap produk (opsional)">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Kategori *</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">Pilih Kategori</option>
                                <option value="elektronik" {{ old('category') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="fashion" {{ old('category') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="makanan" {{ old('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="minuman" {{ old('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="kesehatan" {{ old('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="olahraga" {{ old('category') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                <option value="otomotif" {{ old('category') == 'otomotif' ? 'selected' : '' }}>Otomotif</option>
                                <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="unit" class="form-label">Satuan *</label>
                            <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                                   id="unit" name="unit" value="{{ old('unit') }}" 
                                   placeholder="contoh: pcs, kg, liter">
                            @error('unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="supplier" class="form-label">Supplier</label>
                            <input type="text" class="form-control @error('supplier') is-invalid @enderror" 
                                   id="supplier" name="supplier" value="{{ old('supplier') }}" 
                                   placeholder="Nama supplier (opsional)">
                            @error('supplier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Informasi Harga</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="cost_price" class="form-label">Harga Beli *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('cost_price') is-invalid @enderror" 
                                       id="cost_price" name="cost_price" value="{{ old('cost_price') }}" 
                                       placeholder="0" min="0">
                                @error('cost_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Harga Jual *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price') }}" 
                                       placeholder="0" min="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Profit per Unit:</strong>
                                <span id="profit-amount">Rp 0</span>
                            </div>
                            <div class="col-md-6">
                                <strong>Margin Profit:</strong>
                                <span id="profit-percentage">0%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Stock Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Informasi Stok</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok Awal *</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" value="{{ old('stock', 0) }}" 
                               placeholder="0" min="0">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="min_stock" class="form-label">Minimum Stok *</label>
                        <input type="number" class="form-control @error('min_stock') is-invalid @enderror" 
                               id="min_stock" name="min_stock" value="{{ old('min_stock', 5) }}" 
                               placeholder="5" min="0">
                        @error('min_stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Batas minimum stok untuk notifikasi</div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Produk
                        </button>
                        <a href="{{ route('superadmin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const costPriceInput = document.getElementById('cost_price');
    const priceInput = document.getElementById('price');
    const profitAmountSpan = document.getElementById('profit-amount');
    const profitPercentageSpan = document.getElementById('profit-percentage');

    function calculateProfit() {
        const costPrice = parseFloat(costPriceInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        
        const profit = price - costPrice;
        const profitPercentage = costPrice > 0 ? ((profit / costPrice) * 100) : 0;
        
        profitAmountSpan.textContent = 'Rp ' + profit.toLocaleString('id-ID');
        profitPercentageSpan.textContent = profitPercentage.toFixed(1) + '%';
        
        // Change color based on profit
        if (profit > 0) {
            profitAmountSpan.className = 'text-success';
            profitPercentageSpan.className = 'text-success';
        } else if (profit < 0) {
            profitAmountSpan.className = 'text-danger';
            profitPercentageSpan.className = 'text-danger';
        } else {
            profitAmountSpan.className = '';
            profitPercentageSpan.className = '';
        }
    }

    costPriceInput.addEventListener('input', calculateProfit);
    priceInput.addEventListener('input', calculateProfit);
    
    // Calculate on page load if values exist
    calculateProfit();
});
</script>
@endpush
@endsection
