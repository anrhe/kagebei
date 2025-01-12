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
        Schema::create('laporan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_gereja');
            $table->string('nama'); 
            $table->string('tipe');
            $table->decimal('nominal', 10, 2); 
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_gereja')->references('id')->on('gereja')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
