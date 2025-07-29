<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('nama_barang');
            $table->string('kategori');
            $table->string('size');
            $table->string('warna');
            $table->integer('qty')->default(1);
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_keluar');
    }
};
