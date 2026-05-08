<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

Schema::table('peminjamans', function (Blueprint $table) {
    try {
        $table->dropForeign(['user_id']);
    } catch (\Exception $e) {
        // Ignore if foreign key doesn't exist
    }
    
    try {
        $table->dropColumn('user_id');
    } catch (\Exception $e) {
        // Ignore if column doesn't exist
    }
});

echo "Dropped user_id successfully!\n";
