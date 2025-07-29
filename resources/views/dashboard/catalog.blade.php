@extends('layouts.dashboard-modern')

@section('dashboard-content')
<div class="container mb-4">
    <h3 class="fw-bold mb-4">Catalog Produk</h3>
    <!-- Filter Kategori -->
    <form method="GET" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    <!-- Grid Produk -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($produks as $produk)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="/storage/gambar-produk/{{ $produk->gambar }}" class="card-img-top" alt="{{ $produk->nama_barang }}" style="object-fit:cover; height:180px;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <div class="fw-bold mb-1">{{ $produk->nama_barang }}</div>
                        <div class="text-muted mb-2" style="font-size:0.98rem;">Kode: <code>{{ $produk->kode_barang }}</code></div>
                        <div class="mb-2"><span class="badge bg-secondary">{{ $produk->kategori }}</span></div>
                    </div>
                    <div class="mt-auto">
                        <span class="fw-bold">Stok: {{ $produk->qty }} pcs</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="fas fa-box-open fa-2x mb-2"></i><br>
            Tidak ada produk pada kategori ini.
        </div>
        @endforelse
    </div>
</div>
@endsection
