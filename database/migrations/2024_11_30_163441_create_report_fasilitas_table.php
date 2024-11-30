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
        Schema::create('report_fasilitas', function (Blueprint $table) {
            $table->foreignId('report_id')->constrained('reports')->onDelete('restrict');
            $table->foreignId('fasilitas_id')->constrained('fasilitas')->onDelete('restrict');
            $table->primary(['report_id', 'fasilitas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_fasilitas');
    }
};
