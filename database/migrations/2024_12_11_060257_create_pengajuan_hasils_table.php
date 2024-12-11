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
        Schema::create('pengajuan_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('judul_id')->constrained('juduls')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('transkrip_nilai');
            $table->string('lembar_konsul');
            $table->string('lembar_seminar');
            $table->string('lembar_hafalan');
            $table->string('keterangan_plagiasi');
            $table->string('keterangan_pengumpulan_proposal');
            $table->date('tanggal_pengajuan')->nullable(); // Bisa null
            $table->enum('status_pengajuan', ['Pending', 'Disetujui'])->default('Pending');
            $table->timestamps();
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
