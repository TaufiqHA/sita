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
        Schema::create('ujian_munaqasyas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('hasil_id')->constrained('pengajuan_hasils')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('ketua');
            $table->string('sekretaris');
            $table->string('munaqisy1');
            $table->string('munaqisy2');
            $table->foreignId('dospem1_id')->constrained('dosens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('dospem2_id')->constrained('dosens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_seminar');
            $table->time('waktu_seminar');
            $table->string('ruangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian_munaqasyas');
    }
};
