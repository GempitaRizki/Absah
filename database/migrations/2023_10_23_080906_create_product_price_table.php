<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_price', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 15, 2)->nullable();
            $table->unsignedBigInteger('zona')->nullable();
            $table->unsignedBigInteger('qty')->nullable();
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->decimal('price_after_discount', 15, 2)->nullable();
            $table->smallInteger('price_after_discount_type')->nullable();
            $table->text('data_array')->nullable();
            $table->unsignedBigInteger('qty_min')->nullable();
            $table->unsignedBigInteger('qty_max')->nullable();
            $table->timestamps();

            $table->foreign('product_sku_id')->references('id')->on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_price');
    }
};
