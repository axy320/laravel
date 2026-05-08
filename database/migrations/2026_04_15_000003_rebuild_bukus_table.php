<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rebuild bukus table with complete fields for library system
     */
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku')->unique();
            $table->string('judul_buku');
            $table->string('penulis');
            $table->string('penerbit')->nullable();
            $table->string('tahun_terbit', 4);
            $table->string('kategori');
            $table->integer('stok_buku')->default(0);
            $table->string('rak_buku')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
