<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (!Schema::hasColumn('produks', 'gambar')) {
                $table->string('gambar')->nullable()->after('warna');
            }
        });
    }
    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('produks', 'quantity')) {
                $table->integer('quantity')->default(1)->after('warna');
            }
            if (Schema::hasColumn('produks', 'gambar')) {
                $table->dropColumn('gambar');
            }
        });
    }
};
