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
        Schema::table('pengajuan_hasils', function (Blueprint $table) {
            $table->date('tanggal_pengajuan')->nullable(); // Bisa null
            $table->enum('status_pengajuan', ['Pending', 'Disetujui'])->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_hasils', function (Blueprint $table) {
            $table->dropColumn('tanggal_pengajuan');
            $table->dropColumn('status_pengajuan');
        });
    }
};
