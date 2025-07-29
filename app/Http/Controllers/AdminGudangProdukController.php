<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;


class AdminGudangProdukController extends Controller
{

    // Stock keluar: scan/input barcode unik, decrease qty, create StockKeluar
    public function stockKeluarStore(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);

        // Cari barcode unik di stock_masuk_barcodes
        $barcode = $request->barcode;
        $qtyKeluar = $request->qty;
        $barcodes = \App\Models\StockMasukBarcode::where('barcode', $barcode)->get();
        if ($barcodes->isEmpty()) {
            return back()->with('error', 'Barcode tidak ditemukan di stok masuk!');
        }
        $barcodeRow = $barcodes->first();
        $produk = $barcodeRow->produk;
        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan!');
        }
        // Cek stok cukup
        if ($produk->qty < $qtyKeluar) {
            return back()->with('error', 'Stok produk tidak mencukupi!');
        }

        // Catat stock keluar dan kurangi qty produk
        \App\Models\StockKeluar::create([
            'barcode' => $barcode,
            'nama_barang' => $produk->nama_barang,
            'kategori' => $produk->kategori,
            'size' => $produk->size,
            'warna' => $produk->warna,
            'qty' => $qtyKeluar,
            'tanggal' => now()->toDateString(),
        ]);
        $produk->decrement('qty', $qtyKeluar);

        // (Opsional) Hapus barcode dari stock_masuk_barcodes jika sudah keluar
        // $barcodeRow->delete();

        return back()->with('success', 'Barang keluar berhasil dicatat!');
    }
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $validated = $request->validate([
            'kode_barang' => 'required|unique:produks,kode_barang,' . $produk->id,
            'nama_barang' => 'required',
            'kategori' => 'required',
            'size' => 'nullable',
            'warna' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qty' => 'required|integer|min:1'
        ]);

        // Handle upload gambar jika ada file baru, pastikan folder ada
        if ($request->hasFile('gambar')) {
            $folder = public_path('storage/gambar-produk');
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $file = $request->file('gambar');
            $filename = $file->getClientOriginalName();
            $file->move($folder, $filename);
            if (!file_exists($folder . DIRECTORY_SEPARATOR . $filename)) {
                \Log::error('Gagal simpan file gambar (update): ' . $filename);
            }
            $validated['gambar'] = $filename;
        }

        // Barcode tetap, tidak diubah
        $produk->update($validated);
        return redirect()->back()->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:produks,kode_barang',
            'nama_barang' => 'required',
            'kategori' => 'required',
            'size' => 'nullable',
            'warna' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qty' => 'required|integer|min:1',
        ]);

        // Handle upload gambar, pastikan folder ada
        if ($request->hasFile('gambar')) {
            $folder = public_path('storage/gambar-produk');
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $file = $request->file('gambar');
            $filename = $file->getClientOriginalName();
            $file->move($folder, $filename);
            if (!file_exists($folder . DIRECTORY_SEPARATOR . $filename)) {
                \Log::error('Gagal simpan file gambar (store): ' . $filename);
            }
            $validated['gambar'] = $filename;
        }

        // Generate barcode utama (untuk field produk)
        $barcodeUtama = $validated['kode_barang'] . '-' . now()->format('YmdHis') . '-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
        $validated['barcode'] = $barcodeUtama;

        $produk = Produk::create($validated);

        // Generate dan simpan barcode unik sebanyak qty ke tabel stock_masuk_barcodes
        for ($i = 1; $i <= $validated['qty']; $i++) {
            $barcodeUnik = $validated['kode_barang'] . '-' . now()->format('YmdHis') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);
            \App\Models\StockMasukBarcode::create([
                'produk_id' => $produk->id,
                'barcode' => $barcodeUnik,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }
}
