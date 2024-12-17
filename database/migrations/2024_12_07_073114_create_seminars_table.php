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
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('proposal_id')->constrained('pengajuan_proposals')->cascadeOnDelete()->cascadeOnUpdate(); // Foreign key
            $table->enum('jenis_seminar', ['Proposal', 'Hasil']);
            $table->string('ketua');
            $table->string('sekretaris');
            $table->string('penguji1');
            $table->string('penguji2');
            $table->foreignId('dospem1_id')->constrained('dosens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('dospem2_id')->constrained('dosens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_seminar');
            $table->time('waktu_seminar');
            $table->string('ruangan');
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminars');
    }
};
