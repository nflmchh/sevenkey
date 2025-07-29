<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockKeluar extends Model
{
    use HasFactory;
    protected $table = 'stock_keluar';
    protected $fillable = [
        'barcode', 'nama_barang', 'kategori', 'size', 'warna', 'qty', 'tanggal', 'produk_id', 'keterangan'
    ];
}
