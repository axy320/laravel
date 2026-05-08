<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Rebuild siswas table with complete fields for library system
     */
    public function up(): void
    {
        Schema::dropIfExists('peminjamans');
        Schema::dropIfExists('pengunjungs');
        Schema::dropIfExists('bukus');
        Schema::dropIfExists('kategoris');
        Schema::dropIfExists('siswas');

        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nis')->unique();
            $table->string('kelas');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
