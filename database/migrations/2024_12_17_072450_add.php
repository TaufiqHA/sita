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
        Schema::table('seminars', function (Blueprint $table) {
            $table->renameColumn('munaqisy1', 'penguji1');
            $table->renameColumn('munaqisy2', 'penguji2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seminars', function (Blueprint $table) {
            $table->renameColumn('penguji1', 'munaqisy1');
            $table->renameColumn('penguji2', 'munaqisy2');
        });
    }
};
