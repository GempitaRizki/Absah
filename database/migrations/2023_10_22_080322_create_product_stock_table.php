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
        Schema::create('product_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->unsignedBigInteger('stock')->nullable();
            $table->unsignedBigInteger('limit_stock')->nullable();
            $table->timestamps();

            $table->foreign('product_sku_id')->references('id')->on('product_sku');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stock');
    }
};
