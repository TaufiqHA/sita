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
        Schema::create('seminar_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_id')->constrained('pengajuan_hasils')->cascadeOnDelete()->cascadeOnUpdate(); // Foreign key
            $table->enum('jenis_seminar', ['Proposal', 'Hasil'])->default('Hasil');
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
        Schema::dropIfExists('seminar_hasils');
    }
};
