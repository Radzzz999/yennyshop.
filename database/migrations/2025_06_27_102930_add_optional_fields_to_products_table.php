<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('products', function (Blueprint $table) {
        // Tambah hanya jika kolom belum ada
        if (!Schema::hasColumn('products', 'foto2')) {
            $table->string('foto2')->nullable()->after('foto1');
        }
        if (!Schema::hasColumn('products', 'foto3')) {
            $table->string('foto3')->nullable()->after('foto2');
        }
    });
}


};
