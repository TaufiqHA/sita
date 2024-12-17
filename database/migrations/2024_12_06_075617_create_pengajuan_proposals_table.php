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
        Schema::create('pengajuan_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id'); // Foreign key ke Mahasiswa
            $table->unsignedBigInteger('judul_id'); // Foreign key ke Judul
            $table->string('lembar_persetujuan')->nullable(); // Bisa null
            $table->string('katrol')->nullable(); // Bisa null
            $table->string('hasil_turnitin')->nullable(); // Bisa null
            $table->date('tanggal_pengajuan')->nullable(); // Bisa null
            $table->enum('status_pengajuan', ['Pending', 'Disetujui'])->default('Pending'); // Status
            $table->boolean('verifikasi')->default(false);
            $table->enum('status_jadwal', ['Tidak Terjadwal', 'Terjadwal'])->default('Tidak Terjadwal');

            // Foreign key constraints
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('judul_id')->references('id')->on('juduls')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_proposals');
    }
};
