<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            // Make siswa_id nullable
            $table->foreignId('siswa_id')->nullable()->change();
            
            // Add pengunjung_id
            $table->foreignId('pengunjung_id')->nullable()->after('siswa_id')->constrained('pengunjungs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropForeign(['pengunjung_id']);
            $table->dropColumn('pengunjung_id');
            // Reverting siswa_id to not null might fail if there are nulls, so skip for simplicity
        });
    }
};
