@extends('layouts.dashboard-modern')

@section('page-title')
    @if(request()->routeIs('admin-gudang.stock-masuk'))
        Stock Masuk
    @else
        Warehouse Management
    @endif
@endsection

@section('breadcrumb')
    SevenKey / 
    @if(request()->routeIs('admin-gudang.stock-masuk'))
        Admin Gudang / Stock Masuk
    @else
        Admin Gudang Dashboard
    @endif
@endsection

@section('dashboard-content')
@php
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');
@endphp

    @if(request()->routeIs('admin-gudang.stock-masuk'))
    <!-- Activity Menu & Table for Stock Masuk -->
    <div class="container mb-2">
        <h3 class="fw-bold mb-4" style="font-size:1.6rem; margin-top: 50px;"><i class="fas fa-file-alt me-2"></i>Dashboard Gudang - Laporan Barang</h3>
        {{-- <button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalStockKeluar"><i class="fas fa-arrow-up me-1"></i>Stock Keluar</button> --}}
<!-- Modal Stock Keluar -->
<div class="modal fade" id="modalStockKeluar" tabindex="-1" aria-labelledby="modalStockKeluarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin-gudang.stock-keluar.store') }}" method="POST" id="formStockKeluar">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalStockKeluarLabel">Input/Scan Barcode Barang Keluar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="barcode_keluar" class="form-label">Scan/Isi Barcode</label>
            <input type="text" class="form-control" id="barcode_keluar" name="barcode" required autofocus autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="qty_keluar" class="form-label">QTY (Jumlah Keluar)</label>
            <input type="number" class="form-control" id="qty_keluar" name="qty" min="1" value="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Proses Keluar</button>
        </div>
      </form>
    </div>
  </div>
</div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBarang"><i class="fas fa-plus me-1"></i>Tambah Barang</button>
        </div>
        <!-- Modal Tambah Barang -->
        <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ route('admin-gudang.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Barang Baru</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                  <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori" required>
                      <option value="">-- Pilih Kategori --</option>
                      <option value="T-Shirt Panjang">T-Shirt Panjang</option>
                      <option value="T-Shirt Pendek">T-Shirt Pendek</option>
                      <option value="Kemeja Lengan Panjang">Kemeja Lengan Panjang</option>
                      <option value="Kemeja Lengan Pendek">Kemeja Lengan Pendek</option>
                      <option value="Jaket">Jaket</option>
                      <option value="Hoodie">Hoodie</option>
                      <option value="Celana Panjang">Celana Panjang</option>
                      <option value="Celana Pendek">Celana Pendek</option>
                      <option value="Topi">Topi</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="kode_barang" class="form-label">Kode Barang</label>
                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" readonly required>
                  </div>
                  <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                  </div>
                  <div class="mb-3">
                    <label for="size" class="form-label">Size</label>
                    <select class="form-select" id="size" name="size" required>
                      <option value="">-- Pilih Size --</option>
                      <option value="S">S</option>
                      <option value="M">M</option>
                      <option value="L">L</option>
                      <option value="XL">XL</option>
                      <option value="2XL">2XL</option>
                      <option value="3XL">3XL</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="qty" class="form-label">QTY (Quantity)</label>
                    <input type="number" class="form-control" id="qty" name="qty" min="1" value="1" required>
                  </div>
                  <div class="mb-3">
                    <label for="warna" class="form-label">Warna</label>
                    <input type="text" class="form-control" id="warna" name="warna" required>
                  </div>
                  <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar (Foto Baju)</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                    @if ($errors->has('gambar'))
                        <div class="text-danger small mt-1">{{ $errors->first('gambar') }}</div>
                    @endif
                  </div>
@push('scripts')
<script>
// Kode prefix per kategori
const kategoriPrefix = {
  'T-Shirt Panjang': '101',
  'T-Shirt Pendek': '102',
  'Kemeja Lengan Panjang': '103',
  'Kemeja Lengan Pendek': '104',
  'Jaket': '105',
  'Hoodie': '106',
  'Celana Panjang': '107',
  'Celana Pendek': '108',
  'Topi': '109',
};

function randomNum(n) {
  let str = '';
  for (let i = 0; i < n; i++) str += Math.floor(Math.random() * 10);
  return str;
}

document.addEventListener('DOMContentLoaded', function() {
  // Kode barang otomatis pada tambah barang
  const kategoriSelect = document.getElementById('kategori');
  const kodeBarangInput = document.getElementById('kode_barang');
  const namaBarangInput = document.getElementById('nama_barang');
  const sizeInput = document.getElementById('size');
  const warnaInput = document.getElementById('warna');

  function updateKodeBarang() {
    const prefix = kategoriPrefix[kategoriSelect.value] || '';
    if (prefix) {
      kodeBarangInput.value = prefix + '-' + randomNum(6);
    } else {
      kodeBarangInput.value = '';
    }
  }

  if (kategoriSelect && kodeBarangInput) {
    kategoriSelect.addEventListener('change', updateKodeBarang);
  }

  // Modal edit barang (sudah ada di bawah, biar tidak double event)
});
</script>
@endpush
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-middle mb-0" style="min-width:900px;">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Size</th>
                                <th scope="col">Warna</th>
                               <th scope="col">QTY</th>
                                <th scope="col">Barcode</th>
                                <th scope="col">Barcode Print</th>
                                <th scope="col">Preview</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $activities = \App\Models\Produk::orderBy('created_at', 'desc')->get();
                            // Ambil barcode unik untuk setiap produk
                            $barcodeMap = [];
                            $barcodeBase64Map = [];
                            foreach($activities as $prod) {
                                $barcodes = \App\Models\StockMasukBarcode::where('produk_id', $prod->id)->pluck('barcode')->toArray();
                                $barcodeMap[$prod->id] = $barcodes;
                                $barcodeBase64Map[$prod->id] = [];
                                foreach($barcodes as $b) {
                                    $barcodeBase64Map[$prod->id][] = (new \Milon\Barcode\DNS1D)->getBarcodePNG($b, 'C128', 2, 60);
                                }
                            }
                        @endphp
                        @foreach($activities as $i => $act)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $act->created_at }}</td>
                                <td>{{ $act->kode_barang }}</td>
                                <td>{{ $act->nama_barang }}</td>
                                <td>{{ $act->kategori }}</td>
                                <td>{{ $act->size }}</td>
                                <td>{{ $act->warna }}</td>
                               <td>{{ $act->qty ?? '-' }}</td>
                                <td>
                                    <div style="text-align:center;">
                                        <img src="data:image/png;base64,{{ (new \Milon\Barcode\DNS1D)->getBarcodePNG($act->barcode, 'C128', 2, 60) }}" alt="barcode" style="display:block; margin:0 auto; max-width:200px;">
                                        <div style="font-size:0.9rem; margin-top:2px;">{{ $act->barcode }}</div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary btn-print-barcode"
                                        data-nama_barang="{{ $act->nama_barang }}"
                                        data-kode_barang="{{ $act->kode_barang }}"
                                        data-kategori="{{ $act->kategori }}"
                                        data-barcode-list='@json($barcodeMap[$act->id] ?? [])'
                                        data-barcode-base64-list='@json($barcodeBase64Map[$act->id] ?? [])'
                                        title="Print Barcode" data-bs-toggle="modal" data-bs-target="#modalPrintBarcode">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </td>
                                <td>
                                  @if($act->gambar)
                                    <button type="button" class="btn btn-sm btn-info btn-preview-gambar" 
                                      data-gambar="{{ $act->gambar }}" 
                                      data-nama="{{ $act->nama_barang }}"
                                      title="Preview" data-bs-toggle="modal" data-bs-target="#modalPreviewGambarGlobal">
                                      <i class="fas fa-eye"></i>
                                    </button>
                                  @else
                                    <span class="text-muted">-</span>
                                  @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning me-1 btn-edit-barang"
                                        data-id="{{ $act->id }}"
                                        data-kode_barang="{{ $act->kode_barang }}"
                                        data-nama_barang="{{ $act->nama_barang }}"
                                        data-kategori="{{ $act->kategori }}"
                                        data-size="{{ $act->size }}"
                                        data-warna="{{ $act->warna }}"
                                       data-qty="{{ $act->qty }}"
                                        data-gambar="{{ $act->gambar }}"
                                        data-bs-toggle="modal" data-bs-target="#modalEditBarang">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin-gudang.produk.destroy', $act->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
        <!-- Modal Edit Barang (hanya satu, di luar tabel, diisi dinamis dengan JS) -->
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!-- Modal Preview Gambar Global (hanya satu, di luar table) -->
    <!-- Modal Print Barcode -->
    <div class="modal fade" id="modalPrintBarcode" tabindex="-1" aria-labelledby="modalPrintBarcodeLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalPrintBarcodeLabel">Print Barcode</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="print-barcode-area" style="background:#fff; padding:10px;">
              <div id="barcode-labels-container" style="display: flex; flex-wrap: wrap; gap: 12px; justify-content: flex-start;"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" onclick="printBarcodeArea()">Print</button>
          </div>
        </div>
      </div>
    </div>
<script>
// Print Barcode Modal Handler
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-print-barcode').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const nama = btn.getAttribute('data-nama_barang') || '';
            const kode = btn.getAttribute('data-kode_barang') || '';
            const kategori = btn.getAttribute('data-kategori') || '';
            const barcodeList = JSON.parse(btn.getAttribute('data-barcode-list') || '[]');
            const container = document.getElementById('barcode-labels-container');
            container.innerHTML = '';
            const barcodeBase64List = JSON.parse(btn.getAttribute('data-barcode-base64-list') || '[]');
            barcodeList.forEach(function(barcode, idx) {
                const img = document.createElement('img');
                img.src = 'data:image/png;base64,' + (barcodeBase64List[idx] || '');
                img.alt = 'barcode';
                img.style.display = 'block';
                img.style.margin = '0 auto';
                img.style.maxWidth = '180px';
                img.style.height = '48px';
                const label = document.createElement('div');
                label.style.width = '48%';
                label.style.minWidth = '340px';
                label.style.maxWidth = '420px';
                label.style.border = '2px solid #222';
                label.style.borderRadius = '12px';
                label.style.padding = '12px 18px 8px 18px';
                label.style.marginBottom = '8px';
                label.style.display = 'inline-block';
                label.style.boxSizing = 'border-box';
                label.innerHTML = `
                  <div style="font-size:1.1rem; font-family:sans-serif; margin-bottom:2px;">${nama}</div>
                  <div style="font-size:1rem; font-family:sans-serif; margin-bottom:2px;">${kode}</div>
                  <div style=\"font-size:1rem; font-family:sans-serif; margin-bottom:6px;\"><u>${kategori}</u></div>
                  <div style=\"display:flex; align-items:center; gap:10px;\">${img.outerHTML}</div>
                  <div style=\"font-size:0.95rem; margin-top:2px; text-align:center;\">(00)${barcode}</div>
                `;
                container.appendChild(label);
            });
        });
    });
});
function printBarcodeArea() {
    // Ambil semua label
    const container = document.getElementById('barcode-labels-container');
    const labels = Array.from(container.children);
    let pages = [];
    for (let i = 0; i < labels.length; i += 8) {
        pages.push(labels.slice(i, i + 8));
    }
    const win = window.open('', '', 'width=1200,height=900');
    win.document.write('<html><head><title>Print Barcode</title>');
    win.document.write('<style>@media print { @page { size: A4 landscape; margin: 0.5cm; } body{margin:0;} .barcode-labels-container{display:flex;flex-wrap:wrap;gap:12px;justify-content:flex-start;} .barcode-label{width:48%;min-width:340px;max-width:420px;border:2px solid #222;border-radius:12px;padding:12px 18px 8px 18px;margin-bottom:8px;display:inline-block;box-sizing:border-box;} .page-break{page-break-after:always;} }</style>');
    win.document.write('</head><body>');
    pages.forEach(function(page, idx) {
        win.document.write('<div class="barcode-labels-container">');
        page.forEach(function(label) {
            win.document.write('<div class="barcode-label">' + label.innerHTML + '</div>');
        });
        win.document.write('</div>');
        if (idx < pages.length - 1) {
            win.document.write('<div class="page-break"></div>');
        }
    });
    win.document.write('</body></html>');
    win.document.close();
    setTimeout(() => { win.print(); win.close(); }, 300);
}
</script>
    <div class="modal fade" id="modalPreviewGambarGlobal" tabindex="-1" aria-labelledby="modalPreviewGambarGlobalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalPreviewGambarGlobalLabel">Preview Gambar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center" id="modalPreviewGambarGlobalBody">
            <!-- Gambar akan diisi via JS -->
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Edit Barang -->
    <div class="modal fade" id="modalEditBarang" tabindex="-1" aria-labelledby="modalEditBarangLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="formEditBarang" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditBarangLabel">Edit Barang</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="edit_kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="edit_kode_barang" name="kode_barang" required>
              </div>
              <div class="mb-3">
                <label for="edit_nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang" required>
              </div>
              <div class="mb-3">
                <label for="edit_kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="edit_kategori" name="kategori" required>
              </div>
              <div class="mb-3">
                <label for="edit_size" class="form-label">Size</label>
                <input type="text" class="form-control" id="edit_size" name="size" required>
              </div>
              <div class="mb-3">
                <label for="edit_qty" class="form-label">QTY (Quantity)</label>
                <input type="number" class="form-control" id="edit_qty" name="qty" min="1" required>
              </div>
              <div class="mb-3">
                <label for="edit_warna" class="form-label">Warna</label>
                <input type="text" class="form-control" id="edit_warna" name="warna" required>
              </div>
              <div class="mb-3">
                <label for="edit_gambar" class="form-label">Gambar (Foto Baju)</label>
                <input type="file" class="form-control" id="edit_gambar" name="gambar" accept="image/*">
                <div class="mt-2" id="edit_gambar_preview"></div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal Edit Barang
    const modalEdit = document.getElementById('modalEditBarang');
    const formEdit = document.getElementById('formEditBarang');
    const gambarPreview = document.getElementById('edit_gambar_preview');
    document.querySelectorAll('.btn-edit-barang').forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Set value ke input modal
            document.getElementById('edit_kode_barang').value = btn.getAttribute('data-kode_barang');
            document.getElementById('edit_nama_barang').value = btn.getAttribute('data-nama_barang');
            document.getElementById('edit_kategori').value = btn.getAttribute('data-kategori');
            document.getElementById('edit_size').value = btn.getAttribute('data-size');
            document.getElementById('edit_warna').value = btn.getAttribute('data-warna');
           document.getElementById('edit_qty').value = btn.getAttribute('data-qty') || 1;
            // Set action form
            formEdit.action = '/admin-gudang/produk/update/' + btn.getAttribute('data-id');
            // Preview gambar lama jika ada
            if (btn.getAttribute('data-gambar')) {
                gambarPreview.innerHTML = '<img src="/storage/gambar-produk/' + btn.getAttribute('data-gambar') + '" alt="Gambar Produk" class="img-fluid" style="max-height:120px;">';
            } else {
                gambarPreview.innerHTML = '';
            }
        });
    });

    // Modal Preview Gambar Global
    const modalPreview = document.getElementById('modalPreviewGambarGlobal');
    const modalPreviewBody = document.getElementById('modalPreviewGambarGlobalBody');
    const modalPreviewLabel = document.getElementById('modalPreviewGambarGlobalLabel');
    document.querySelectorAll('.btn-preview-gambar').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const gambar = btn.getAttribute('data-gambar');
            const nama = btn.getAttribute('data-nama') || 'Preview Gambar';
            modalPreviewLabel.textContent = nama;
            if (gambar) {
                // Cek gambar via fetch, jika gagal tampilkan pesan error
                const imgUrl = '/storage/gambar-produk/' + gambar;
                fetch(imgUrl, {method: 'HEAD'}).then(function(resp) {
                    if (resp.ok) {
                        modalPreviewBody.innerHTML = '<img src="' + imgUrl + '" alt="Gambar Produk" class="img-fluid" style="max-height:400px;">';
                    } else {
                        modalPreviewBody.innerHTML = '<div class="text-danger">Gambar tidak ditemukan.<br><small>Pastikan file <b>' + gambar + '</b> ada di <b>storage/app/public/gambar-produk/</b> dan sudah menjalankan <code>php artisan storage:link</code>.</small></div>';
                    }
                }).catch(function() {
                    modalPreviewBody.innerHTML = '<div class="text-danger">Gambar tidak ditemukan.<br><small>Pastikan file <b>' + gambar + '</b> ada di <b>storage/app/public/gambar-produk/</b> dan sudah menjalankan <code>php artisan storage:link</code>.</small></div>';
                });
            } else {
                modalPreviewBody.innerHTML = '<div class="text-muted">Tidak ada gambar.</div>';
            }
        });
    });
});
</script>
@endpush
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container mb-2">
        <h3 class="fw-bold mb-4" style="font-size:1.6rem; margin-top: 50px;"><i class="fas fa-file-alt me-2"></i>Dashboard Gudang - Laporan Barang</h3>
        <!-- Filter Form -->
        <form class="report-filter-form mb-4" method="GET" action="">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="filter_dari" class="form-label mb-1">Dari:</label>
                    <input type="date" class="form-control" id="filter_dari" name="dari" value="{{ request('dari', date('Y-m-01')) }}">
                </div>
                <div class="filter-group">
                    <label for="filter_sampai" class="form-label mb-1">Sampai:</label>
                    <input type="date" class="form-control" id="filter_sampai" name="sampai" value="{{ request('sampai', date('Y-m-d')) }}">
                </div>
                <div class="filter-group">
                    <label for="filter_sku" class="form-label mb-1">Pilih: SKU</label>
                    <input type="text" class="form-control" id="filter_sku" name="sku" placeholder="SKU (opsional)" value="{{ request('sku') }}">
                </div>
                <div class="filter-group">
                    <label for="filter_gudang" class="form-label mb-1">Pilih Gudang/Tujuan:</label>
                    <select class="form-select" id="filter_gudang" name="gudang">
                        <option value="">Pilih Gudang/Tujuan:</option>
                        <option value="Gudang A" {{ request('gudang')=='Gudang A' ? 'selected' : '' }}>Gudang A</option>
                        <option value="Gudang B" {{ request('gudang')=='Gudang B' ? 'selected' : '' }}>Gudang B</option>
                        <option value="Toko" {{ request('gudang')=='Toko' ? 'selected' : '' }}>Toko</option>
                        <!-- Tambah opsi lain sesuai kebutuhan -->
                    </select>
                </div>
                <div class="filter-group align-end">
                    <button type="submit" class="btn btn-primary w-100" style="margin-top:1.7rem;">Filter</button>
                </div>
            </div>
        </form>
        <!-- End Filter Form -->
    </div>
    @php
        // Ambil semua kategori unik dari produk
        // Daftar kategori default jika tidak ada produk sama sekali
        $kategoriDefault = [
            'T-Shirt Panjang', 'T-Shirt Pendek', 'Kemeja Lengan Panjang', 'Kemeja Lengan Pendek',
            'Jaket', 'Hoodie', 'Celana Panjang', 'Celana Pendek', 'Topi'
        ];
        $kategoriListDB = \App\Models\Produk::select('kategori')->distinct()->pluck('kategori')->toArray();
        $kategoriList = array_unique(array_merge($kategoriDefault, $kategoriListDB));
        $kategoriIcons = [
            'T-Shirt Panjang' => 'fa-tshirt',
            'T-Shirt Pendek' => 'fa-tshirt',
            'Kemeja Lengan Panjang' => 'fa-shirt',
            'Kemeja Lengan Pendek' => 'fa-shirt',
            'Jaket' => 'fa-user-tie',
            'Hoodie' => 'fa-user-astronaut',
            'Celana Panjang' => 'fa-socks',
            'Celana Pendek' => 'fa-socks',
            'Topi' => 'fa-hat-cowboy',
        ];
        $quantities = [];
        foreach($kategoriList as $kategori) {
            // Ambil semua produk di kategori ini
            $produkIds = \App\Models\Produk::where('kategori', $kategori)->pluck('id');
            // Hitung barcode masuk yang belum keluar (belum ada di stock_keluar)
            $jumlah = \App\Models\StockMasukBarcode::whereIn('produk_id', $produkIds)
                ->whereNotIn('barcode', \App\Models\StockKeluar::pluck('barcode'))
                ->count();
            $quantities[$kategori] = $jumlah;
        }
        // Filter tanggal jika ada
        $dari = request('dari');
        $sampai = request('sampai');
        $produkQuery = \App\Models\Produk::query();
        $keluarQuery = \App\Models\StockKeluar::query();
        if ($dari && $sampai) {
            $produkQuery->whereBetween('created_at', [$dari, $sampai]);
            $keluarQuery->whereBetween('tanggal', [$dari, $sampai]);
        }
        // Total Barang Masuk = jumlah seluruh barcode masuk (tidak pernah berkurang)
        $totalMasuk = \App\Models\StockMasukBarcode::count();
        // Total Barang Keluar = SUM qty stock_keluar pada periode
        $totalKeluar = $keluarQuery->sum('qty');
        // Stock Saat Ini = SUM qty seluruh produk (real-time stok)
        $stockSaatIni = \App\Models\Produk::sum('qty');
        // Low Stock Produk: kategori yang quantity barcode belum keluar < 5
        $lowStock = 0;
        foreach($kategoriList as $kategori) {
            if ($quantities[$kategori] < 5) {
                $lowStock++;
            }
        }
    @endphp
    @php
    // Data grafik masuk & keluar 30 hari terakhir
    $tanggalLabels = [];
    $dataMasuk = [];
    $dataKeluar = [];
    for ($i = 29; $i >= 0; $i--) {
        $tgl = now()->subDays($i)->format('Y-m-d');
        $tanggalLabels[] = now()->subDays($i)->format('d M');
        $dataMasuk[] = \App\Models\Produk::whereDate('created_at', $tgl)->count();
        $dataKeluar[] = \App\Models\StockKeluar::whereDate('tanggal', $tgl)->sum('qty');
    }
    $tanggalLabels = json_encode($tanggalLabels);
    $dataMasuk = json_encode($dataMasuk);
    $dataKeluar = json_encode($dataKeluar);
    @endphp
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grafik Barang Masuk & Keluar
        var ctx = document.getElementById('grafikMasukKeluar').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $tanggalLabels !!},
                datasets: [
                    {
                        label: 'Barang Masuk',
                        data: {!! $dataMasuk !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    },
                    {
                        label: 'Barang Keluar',
                        data: {!! $dataKeluar !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: false }
                },
                scales: {
                    x: { stacked: true },
                    y: { stacked: true, beginAtZero: true }
                }
            }
        });
    });
    </script>
    @endpush
    <div class="container mb-2">
        <h3 class="fw-bold mb-4" style="font-size:1.6rem; margin-top: 50px;"><i class="fas fa-file-alt me-2"></i>Dashboard Gudang - Laporan Barang</h3>
        {{-- <button class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#modalStockKeluar"><i class="fas fa-arrow-up me-1"></i>Stock Keluar</button> --}}
        <div class="mb-3">
            <a href="{{ route('admin-gudang.stock-keluar.export', ['type' => 'pdf']) }}" class="btn btn-outline-danger me-2"><i class="fas fa-file-pdf me-1"></i>Export PDF</a>
            <a href="{{ route('admin-gudang.stock-keluar.export', ['type' => 'excel']) }}" class="btn btn-outline-success"><i class="fas fa-file-excel me-1"></i>Export Excel</a>
        </div>
            <div class="col-12">
                <div class="stat-cards-grid-custom" style="margin:0;">
                    <div>
                        <div class="card bg-primary text-white stat-card">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title mb-1">Total Barang Masuk</h6>
                                        <h3 class="mb-0">{{ $totalMasuk }}</h3>
                                    </div>
                                    <i class="fas fa-arrow-down fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card bg-primary text-white stat-card">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title mb-1">Total Barang Keluar</h6>
                                        <h3 class="mb-0">{{ $totalKeluar }}</h3>
                                    </div>
                                    <i class="fas fa-arrow-up fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card bg-success text-white stat-card">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title mb-1">Stock Saat Ini</h6>
                                        <h3 class="mb-0">{{ $stockSaatIni }}</h3>
                                    </div>
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card bg-warning text-white stat-card">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title mb-1">Low Stock Produk</h6>
                                        <h3 class="mb-0">{{ $lowStock }}</h3>
                                    </div>
                                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Grafik di-hide agar sesuai layout contoh --}}
            @if(false)
            <div class="col-12 mt-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="fas fa-chart-bar me-2"></i>Grafik Barang Masuk & Keluar (30 Hari Terakhir)</h6>
                        <canvas id="grafikMasukKeluar" height="80"></canvas>
                    </div>
                </div>
            </div>
            @endif
            <!-- Kategori Cards (Full Width) -->
            <div class="col-12 mt-4">
                <div class="category-cards-grid-custom">
                    @foreach($kategoriList as $kategori)
                    @php $isLow = $quantities[$kategori] < 5; @endphp
                    <div class="category-card-custom">
                        <div class="card text-center shadow-sm category-prop-card{{ $isLow ? ' low-stock-card' : '' }}">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 w-100">
                                <div class="mb-2">
                                    <i class="fas {{ $kategoriIcons[$kategori] ?? 'fa-box' }} fa-3x"></i>
                                </div>
                                <div class="fs-6 fw-bold mb-1" style="min-height:32px;">{{ $kategori }}</div>
                                <div class="fs-5">{{ $quantities[$kategori] }} pcs</div>
                                @if($isLow)
                                <div class="text-danger fw-bold mt-2" style="font-size:0.98rem;"><i class="fas fa-exclamation-triangle me-1"></i>Low Stock!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Responsive table stock-masuk */
        @media (max-width: 1200px) {
            .table-responsive {
                overflow-x: auto;
            }
            table.table {
                min-width: 900px;
            }
        }
        table.table td, table.table th {
            vertical-align: middle;
            word-break: break-word;
            white-space: pre-line;
        }
        /* Agar cell barcode tidak overflow */
        td > div[style*="width:420px"] {
            max-width: 420px;
            overflow-x: auto;
        }
        /* --- DASHBOARD LAYOUT IMPROVEMENT --- */
        .stat-cards-grid-custom {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 32px;
            width: 100%;
            margin-bottom: 0;
        }
        .stat-card {
            width: 100%;
            min-height: 120px;
            height: 100%;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.08);
            display: flex;
            align-items: stretch;
        }
        .stat-card .card-body {
            padding: 18px 20px 12px 20px;
        }
        .category-cards-grid-custom {
            display: grid;
            grid-template-columns: repeat(4, minmax(220px, 1fr));
            gap: 28px 24px;
            justify-content: center;
            width: 100%;
            margin: 0 auto;
        }
        .category-card-custom {
            width: 100%;
        }
        .category-prop-card {
            width: 100%;
            min-height: 150px;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(44,62,80,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
            background: #fff;
            transition: background 0.2s, border 0.2s;
        }
        .category-prop-card.low-stock-card {
            background: #ffeaea;
            border: 2px solid #e74c3c;
        }
        .category-prop-card i {
            color: #2d3a4a;
        }
        .category-prop-card .fw-bold {
            font-size: 1.08rem;
        }
        .report-filter-form {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(44,62,80,0.06);
            padding: 18px 18px 10px 18px;
            margin-bottom: 24px;
        }
        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            align-items: flex-end;
        }
        .filter-group {
            display: flex;
            flex-direction: column;
            min-width: 170px;
            flex: 1 1 0;
        }
        .filter-group.align-end {
            min-width: 110px;
            flex: 0 0 110px;
        }
        /* Desktop: grid lebih proporsional, gap lebih besar, padding container */
        @media (max-width: 1200px) {
            .category-cards-grid-custom {
                grid-template-columns: repeat(2, minmax(220px, 1fr));
            }
        }
        @media (max-width: 700px) {
            .category-cards-grid-custom {
                grid-template-columns: 1fr;
            }
        }
        /* Perlebar container di desktop, tapi hanya untuk dashboard utama warehouse */
        @media (min-width: 1500px) {
            #dashboard-warehouse-main-container.container {
                max-width: 1600px;
                padding-left: 48px;
                padding-right: 48px;
            }
        }
        @media (max-width: 900px) {
            .stat-cards-grid-custom, .category-cards-grid-custom {
                width: 100%;
                gap: 14px;
            }
            .stat-card {
                min-height: 90px;
            }
            .category-prop-card {
                min-height: 90px;
            }
        }
        @media (max-width: 600px) {
            .stat-cards-grid-custom {
                grid-template-columns: 1fr;
                grid-template-rows: unset;
            }
            .category-cards-grid-custom {
                grid-template-columns: 1fr;
                grid-template-rows: unset;
            }
            .category-prop-card {
                min-height: 70px;
            }
        }
    </style>
    @endif

@endsection
