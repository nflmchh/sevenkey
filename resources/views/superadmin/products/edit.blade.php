@extends('layouts.dashboard-modern')

@section('dashboard-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Edit Produk: {{ $product->name }}</h3>
    <div>
        <a href="{{ route('superadmin.products.show', $product) }}" class="btn btn-info">
            <i class="fas fa-eye me-2"></i>Detail
        </a>
        <a href="{{ route('superadmin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
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

<form method="POST" action="{{ route('superadmin.products.update', $product) }}">
    @csrf
    @method('PUT')
    
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
                                   id="code" name="code" value="{{ old('code', $product->code) }}" 
                                   placeholder="contoh: PR001">
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Kode unik untuk identifikasi produk</div>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Produk *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $product->name) }}" 
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
                                  placeholder="Deskripsi lengkap produk (opsional)">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Kategori *</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">Pilih Kategori</option>
                                <option value="elektronik" {{ old('category', $product->category) == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="fashion" {{ old('category', $product->category) == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="makanan" {{ old('category', $product->category) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="minuman" {{ old('category', $product->category) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="kesehatan" {{ old('category', $product->category) == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="olahraga" {{ old('category', $product->category) == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                <option value="otomotif" {{ old('category', $product->category) == 'otomotif' ? 'selected' : '' }}>Otomotif</option>
                                <option value="lainnya" {{ old('category', $product->category) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="unit" class="form-label">Satuan *</label>
                            <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                                   id="unit" name="unit" value="{{ old('unit', $product->unit) }}" 
                                   placeholder="contoh: pcs, kg, liter">
                            @error('unit')
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
                            <label for="purchase_price" class="form-label">Harga Beli *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('purchase_price') is-invalid @enderror" 
                                       id="purchase_price" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" 
                                       placeholder="0" min="0">
                                @error('purchase_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="selling_price" class="form-label">Harga Jual *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('selling_price') is-invalid @enderror" 
                                       id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" 
                                       placeholder="0" min="0">
                                @error('selling_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Profit per Unit:</strong>
                                <span id="profit-amount">Rp {{ number_format($product->selling_price - $product->purchase_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="col-md-6">
                                <strong>Margin Profit:</strong>
                                <span id="profit-percentage">{{ $product->getProfitPercentage() }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock History -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Riwayat Stok Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Stok Akhir</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                                    <td><span class="badge bg-info">Update</span></td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>Stok saat ini</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <small class="text-muted">* Riwayat lengkap akan tersedia setelah fitur log stok diimplementasi</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Current Stats -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Status Produk</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="mb-1">{{ $product->stock }}</h4>
                            <small class="text-muted">Stok Saat Ini</small>
                        </div>
                        <div class="col-6">
                            <h4 class="mb-1">{{ $product->min_stock }}</h4>
                            <small class="text-muted">Min. Stok</small>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        @if($product->stock > $product->min_stock)
                            <span class="badge bg-success fs-6">Stok Aman</span>
                        @elseif($product->stock > 0)
                            <span class="badge bg-warning fs-6">Stok Menipis</span>
                        @else
                            <span class="badge bg-danger fs-6">Stok Habis</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stock Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Informasi Stok</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok Saat Ini *</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" name="stock" value="{{ old('stock', $product->stock) }}" 
                               placeholder="0" min="0">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="min_stock" class="form-label">Minimum Stok *</label>
                        <input type="number" class="form-control @error('min_stock') is-invalid @enderror" 
                               id="min_stock" name="min_stock" value="{{ old('min_stock', $product->min_stock) }}" 
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
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-2"></i>Update Produk
                        </button>
                        <a href="{{ route('superadmin.products.show', $product) }}" class="btn btn-info">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                        <a href="{{ route('superadmin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <hr>
                        <form method="POST" action="{{ route('superadmin.products.destroy', $product) }}" 
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" 
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                <i class="fas fa-trash me-2"></i>Hapus Produk
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const purchasePriceInput = document.getElementById('purchase_price');
    const sellingPriceInput = document.getElementById('selling_price');
    const profitAmountSpan = document.getElementById('profit-amount');
    const profitPercentageSpan = document.getElementById('profit-percentage');

    function calculateProfit() {
        const purchasePrice = parseFloat(purchasePriceInput.value) || 0;
        const sellingPrice = parseFloat(sellingPriceInput.value) || 0;
        
        const profit = sellingPrice - purchasePrice;
        const profitPercentage = purchasePrice > 0 ? ((profit / purchasePrice) * 100) : 0;
        
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

    purchasePriceInput.addEventListener('input', calculateProfit);
    sellingPriceInput.addEventListener('input', calculateProfit);
});
</script>
@endpush
@endsection
