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
        Schema::create('order_bast', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_bast', 255)->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('qty')->nullable();
            $table->unsignedBigInteger('qty_sesuai')->nullable();
            $table->unsignedBigInteger('qty_tidak_sesuai')->nullable();
            $table->unsignedBigInteger('qty_rusak')->nullable();
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('sudah_bast')->nullable();
            $table->unsignedBigInteger('ke')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_bast');
    }
};
