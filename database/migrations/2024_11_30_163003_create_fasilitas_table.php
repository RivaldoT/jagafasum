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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('dinas_id')->constrained('dinas')->onDelete('restrict');
            $table->enum('fund_source', ['APBN', 'APBD', 'Swasta']);
            $table->double('latitude');
            $table->double('longitude');
            $table->string('luasan');
            $table->string('image');
            $table->enum('status', ['Baik', 'Rusak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
