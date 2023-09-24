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
        Schema::create('store_detail_tables', function (Blueprint $table) {
            $table->id();
            $table->string('nib')->nullable();
            $table->string('skb')->nullable();
            $table->string('akta')->nullable();
            $table->string('akta_perusahaan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('suip')->nullable();
            $table->string('tdp')->nullable();
            $table->string('kbli')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('pkp')->nullable();
            $table->unsignedBigInteger('kategori_usaha')->nullable();
            $table->unsignedBigInteger('kepemilikan_usaha')->nullable();
            $table->unsignedBigInteger('wilayah_usaha')->nullable();
            $table->string('req_fitur_pajak')->nullable();
            $table->string('aktif_fitur_pajak')->nullable();
            $table->string('upload_sertel_pajak')->nullable();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('kategori_usaha')->references('id')->on('master_status');
            $table->foreign('kepemilikan_usaha')->references('id')->on('master_status');
            $table->foreign('wilayah_usaha')->references('id')->on('master_status');
            $table->foreign('pkp')->references('id')->on('master_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_detail_tables');
    }
};
