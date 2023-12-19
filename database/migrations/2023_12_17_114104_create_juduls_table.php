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
        Schema::create('juduls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id');
            $table->string('konsentrasi');
            $table->string('judul_skripsi');
            $table->string('metode');
            $table->string('teknik');
            $table->string('bentuk_data');
            $table->string('tempat');
            $table->string('nama_dosen1')->nullable();
            $table->string('nama_dosen2')->nullable();
            $table->string('nama_dosen3')->nullable();
            $table->string('nama_dosen4')->nullable();
            $table->string('jumlah_sks');
            $table->string('bukti')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juduls');
    }
};
