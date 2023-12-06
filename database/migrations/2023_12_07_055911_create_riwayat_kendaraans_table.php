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
        Schema::create('riwayat_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pinjam');
            $table->integer('konsumsi_bbm');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_pinjam')->references('id')->on('pinjamen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kendaraans');
    }
};
