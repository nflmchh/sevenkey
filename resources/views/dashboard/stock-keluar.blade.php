@extends('layouts.dashboard-modern')

@section('page-title')
    Stock Keluar
@endsection

@section('breadcrumb')
    SevenKey / Admin Gudang / Stock Keluar
@endsection

@section('dashboard-content')
<div class="container mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold" style="font-size:1.6rem; margin-top: 30px;"><i class="fas fa-list-alt me-2"></i>Activity Stock Keluar</h3>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin-gudang.stock-keluar.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row align-items-end g-2">
                    <div class="col-md-5">
                        <label for="barcode" class="form-label">Scan/Isi Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" autofocus required placeholder="Scan barcode di sini...">
                    </div>
                    <div class="col-md-2">
                        <label for="qty" class="form-label">QTY</label>
                        <input type="number" class="form-control" id="qty" name="qty" min="1" value="1" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-out-alt me-1"></i>Proses Keluar</button>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                @endif
            </form>
        </div>
    </div>
    <!-- <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('admin-gudang.stock-keluar.export', ['type' => 'pdf']) }}" class="btn btn-outline-danger me-2"><i class="fas fa-file-pdf me-1"></i>Export PDF</a>
        <a href="{{ route('admin-gudang.stock-keluar.export', ['type' => 'excel']) }}" class="btn btn-outline-success"><i class="fas fa-file-excel me-1"></i>Export Excel</a>
    </div> -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Barcode</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Size</th>
                            <th>Warna</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $activities = \App\Models\StockKeluar::orderBy('created_at', 'desc')->get();
                    @endphp
                    @foreach($activities as $i => $act)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $act->created_at }}</td>
                            <td>{{ $act->barcode }}</td>
                            <td>{{ $act->nama_barang }}</td>
                            <td>{{ $act->kategori }}</td>
                            <td>{{ $act->size }}</td>
                            <td>{{ $act->warna }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var barcodeInput = document.getElementById('barcode');
    if (barcodeInput) {
        barcodeInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
    }
});
</script>
@endpush
