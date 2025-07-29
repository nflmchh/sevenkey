<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('produks', 'qty')) {
                $table->integer('qty')->default(1)->after('warna');
            }
        });
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'qty')) {
                $table->dropColumn('qty');
            }
        });
    }
};
