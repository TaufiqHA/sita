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
        Schema::create('bimbingan_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('judul_id')->constrained('juduls')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('dospem1_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('dospem2_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status_dospem1', ['diterima', 'bimbingan']);
            $table->enum('status_dospem2', ['diterima', 'bimbingan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan_proposals');
    }
};
