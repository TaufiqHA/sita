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
        Schema::create('pembimbing_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('judul_id')->constrained('juduls')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('dospem1_id')->constrained('dosens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('dospem2_id')->constrained('dosens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status_dospem1', ['diterima', 'bimbingan', 'ditolak'])->default('bimbingan');
            $table->enum('status_dospem2', ['diterima', 'bimbingan', 'ditolak'])->default('bimbingan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_hasils');
    }
};
