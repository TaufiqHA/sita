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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswas')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('pembimbing_id')
                ->constrained('pembimbings')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('transkrip_nilai');
            $table->string('lembar_konsul');
            $table->string('berita_acara_kompren');
            $table->string('lembar_nilai_kompren');
            $table->string('bukti_pembayaran_spp');
            $table->string('sertif_btq');
            $table->string('sertif_piba');
            $table->string('sertif_cbt');
            $table->string('sertif_kkn');
            $table->string('ijazah_sma');
            $table->string('ijazah_smp');
            $table->string('ijazah_sd');
            $table->string('sertif_toefl');
            $table->string('sk_bebas_pustaka');
            $table->string('lembar_hafalan');
            $table->enum('status_pengajuan', ['Pending', 'Diterima'])->default('Pending');
            $table->date('tanggal_pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujians');
    }
};
