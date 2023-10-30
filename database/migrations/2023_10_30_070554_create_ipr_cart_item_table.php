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
        Schema::create('ipr_cart_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->unsignedBigInteger('qty')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('price_after_disc')->nullable();
            $table->unsignedBigInteger('type_category')->nullable();
            $table->unsignedBigInteger('check_cart_item')->nullable();
            $table->decimal('shipping_cost')->nullable();
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('ipr_cart');
            $table->foreign('product_sku_id')->references('id')->on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipr_cart_item');
    }
};
