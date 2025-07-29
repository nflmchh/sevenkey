@extends('layouts.dashboard-modern')

@section('dashboard-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Detail Produk: {{ $product->name }}</h3>
    <div>
        <a href="{{ route('superadmin.products.edit', $product) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('superadmin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <!-- Product Profile Card -->
        <div class="card">
            <div class="card-body text-center">
                <div class="product-icon mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text text-muted">
                    <code>{{ $product->code }}</code>
                </p>
                <span class="badge bg-secondary fs-6">{{ ucfirst($product->category) }}</span>
            </div>
        </div>

        <!-- Stock Status -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Status Stok</h6>
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-1 
                            @if($product->stock > $product->min_stock) text-success
                            @elseif($product->stock > 0) text-warning
                            @else text-danger
                            @endif">
                            {{ $product->stock }}
                        </h3>
                        <small class="text-muted">{{ $product->unit }}</small>
                    </div>
                    <div class="col-6">
                        <h5 class="mb-1">{{ $product->min_stock }}</h5>
                        <small class="text-muted">Min. Stok</small>
                    </div>
                </div>
                <hr>
                @if($product->stock > $product->min_stock)
                    <span class="badge bg-success fs-6">Stok Aman</span>
                @elseif($product->stock > 0)
                    <span class="badge bg-warning fs-6">Stok Menipis</span>
                @else
                    <span class="badge bg-danger fs-6">Stok Habis</span>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('superadmin.products.edit', $product) }}" class="btn btn-outline-warning">
                        <i class="fas fa-edit me-2"></i>Edit Produk
                    </a>
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#stockModal">
                        <i class="fas fa-warehouse me-2"></i>Update Stok
                    </button>
                    <form method="POST" action="{{ route('superadmin.products.destroy', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100" 
                                onclick="return confirm('Yakin ingin menghapus produk ini?')">
                            <i class="fas fa-trash me-2"></i>Hapus Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Product Information -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Informasi Produk</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Kode Produk:</strong></td>
                                <td><code>{{ $product->code }}</code></td>
                            </tr>
                            <tr>
                                <td><strong>Nama:</strong></td>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kategori:</strong></td>
                                <td>{{ ucfirst($product->category) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Satuan:</strong></td>
                                <td>{{ $product->unit }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Dibuat:</strong></td>
                                <td>{{ $product->created_at->format('d F Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Update:</strong></td>
                                <td>{{ $product->updated_at->format('d F Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Stok Saat Ini:</strong></td>
                                <td>{{ $product->stock }} {{ $product->unit }}</td>
                            </tr>
                            <tr>
                                <td><strong>Minimum Stok:</strong></td>
                                <td>{{ $product->min_stock }} {{ $product->unit }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($product->description)
                <hr>
                <div>
                    <strong>Deskripsi:</strong>
                    <p class="mt-2">{{ $product->description }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Pricing Information -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Informasi Harga</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <h5 class="text-danger">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</h5>
                            <small class="text-muted">Harga Beli</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h5 class="text-success">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</h5>
                            <small class="text-muted">Harga Jual</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h5 class="text-info">Rp {{ number_format($product->selling_price - $product->purchase_price, 0, ',', '.') }}</h5>
                            <small class="text-muted">Profit per Unit</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h5 class="text-warning">{{ $product->getProfitPercentage() }}%</h5>
                            <small class="text-muted">Margin Profit</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Analysis -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Analisis Stok</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="border rounded p-3 text-center">
                            <h4 class="text-primary">Rp {{ number_format($product->stock * $product->purchase_price, 0, ',', '.') }}</h4>
                            <small class="text-muted">Nilai Stok (Harga Beli)</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 text-center">
                            <h4 class="text-success">Rp {{ number_format($product->stock * $product->selling_price, 0, ',', '.') }}</h4>
                            <small class="text-muted">Nilai Stok (Harga Jual)</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 text-center">
                            <h4 class="text-info">Rp {{ number_format($product->stock * ($product->selling_price - $product->purchase_price), 0, ',', '.') }}</h4>
                            <small class="text-muted">Potensi Profit</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Movement History -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">Riwayat Pergerakan Stok</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Stok Sebelum</th>
                                <th>Stok Sesudah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                                <td><span class="badge bg-primary">Initial Stock</span></td>
                                <td>+{{ $product->stock }}</td>
                                <td>0</td>
                                <td>{{ $product->stock }}</td>
                                <td>Stok awal produk</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Riwayat lengkap akan tersedia setelah fitur log stok diimplementasi
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Stock Update Modal -->
<div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockModalLabel">Update Stok: {{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('superadmin.products.update-stock', $product) }}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_stock" class="form-label">Stok Saat Ini</label>
                        <input type="number" class="form-control" id="current_stock" value="{{ $product->stock }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock_type" class="form-label">Jenis Update</label>
                        <select class="form-select" id="stock_type" name="stock_type">
                            <option value="add">Tambah Stok (Pembelian/Produksi)</option>
                            <option value="subtract">Kurangi Stok (Penjualan/Rusak)</option>
                            <option value="set">Set Stok (Koreksi)</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Alasan update stok (opsional)"></textarea>
                    </div>
                    
                    <div class="alert alert-info">
                        <strong>Stok akan menjadi:</strong> <span id="new_stock">{{ $product->stock }}</span> {{ $product->unit }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Stok</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stockTypeSelect = document.getElementById('stock_type');
    const quantityInput = document.getElementById('quantity');
    const newStockSpan = document.getElementById('new_stock');
    const currentStock = {{ $product->stock }};

    function calculateNewStock() {
        const stockType = stockTypeSelect.value;
        const quantity = parseInt(quantityInput.value) || 0;
        let newStock = currentStock;

        switch(stockType) {
            case 'add':
                newStock = currentStock + quantity;
                break;
            case 'subtract':
                newStock = Math.max(0, currentStock - quantity);
                break;
            case 'set':
                newStock = quantity;
                break;
        }

        newStockSpan.textContent = newStock;
        
        // Change color based on stock level
        const minStock = {{ $product->min_stock }};
        if (newStock > minStock) {
            newStockSpan.className = 'text-success';
        } else if (newStock > 0) {
            newStockSpan.className = 'text-warning';
        } else {
            newStockSpan.className = 'text-danger';
        }
    }

    stockTypeSelect.addEventListener('change', calculateNewStock);
    quantityInput.addEventListener('input', calculateNewStock);
});
</script>
@endpush
@endsection
