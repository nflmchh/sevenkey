@extends('layouts.dashboard-modern')

@section('dashboard-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Manajemen Produk</h3>
    <a href="{{ route('superadmin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Filter dan Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('superadmin.products.index') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Pencarian</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Nama produk, kode, atau kategori...">
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Semua Kategori</option>
                        <option value="elektronik" {{ request('category') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="fashion" {{ request('category') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="makanan" {{ request('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="minuman" {{ request('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="kesehatan" {{ request('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="olahraga" {{ request('category') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="otomotif" {{ request('category') == 'otomotif' ? 'selected' : '' }}>Otomotif</option>
                        <option value="lainnya" {{ request('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status Stok</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="in_stock" {{ request('status') == 'in_stock' ? 'selected' : '' }}>Stok Tersedia</option>
                        <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>Stok Menipis</option>
                        <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>Stok Habis</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-search me-1"></i>Filter
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body text-center">
                <h5 class="text-primary">{{ $totalProducts ?? 0 }}</h5>
                <small class="text-muted">Total Produk</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body text-center">
                <h5 class="text-success">{{ $inStockProducts ?? 0 }}</h5>
                <small class="text-muted">Stok Tersedia</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body text-center">
                <h5 class="text-warning">{{ $lowStockProducts ?? 0 }}</h5>
                <small class="text-muted">Stok Menipis</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-danger">
            <div class="card-body text-center">
                <h5 class="text-danger">{{ $outOfStockProducts ?? 0 }}</h5>
                <small class="text-muted">Stok Habis</small>
            </div>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="card">
    <div class="card-body">
        @if($products->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Profit (%)</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            <code>{{ $product->code }}</code>
                        </td>
                        <td>
                            <div>
                                <strong>{{ $product->name }}</strong>
                                @if($product->description)
                                <br><small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($product->category) }}</span>
                        </td>
                        <td>Rp {{ number_format($product->cost_price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-success">{{ $product->getProfitPercentage() }}%</span>
                        </td>
                        <td>
                            <span class="badge 
                                @if($product->stock > $product->min_stock) bg-success
                                @elseif($product->stock > 0) bg-warning
                                @else bg-danger
                                @endif">
                                {{ $product->stock }} {{ $product->unit }}
                            </span>
                        </td>
                        <td>
                            @if($product->stock > $product->min_stock)
                                <span class="badge bg-success">Stok Aman</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning">Stok Menipis</span>
                            @else
                                <span class="badge bg-danger">Stok Habis</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('superadmin.products.show', $product) }}" 
                                   class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('superadmin.products.edit', $product) }}" 
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('superadmin.products.destroy', $product) }}" 
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->all())->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h5>Belum ada produk</h5>
            <p class="text-muted">Mulai tambahkan produk untuk mengelola inventori Anda.</p>
            <a href="{{ route('superadmin.products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Produk Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
