<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMasukBarcode extends Model
{
    protected $table = 'stock_masuk_barcodes';
    protected $fillable = [
        'produk_id', 'barcode'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
