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
            $table->boolean('verifikasi')->default(false);
            $table->enum('status_jadwal', ['Tidak Terjadwal', 'Terjadwal'])->default('Tidak Terjadwal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_hasils');
    }
};
