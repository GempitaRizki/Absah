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
        Schema::create('assign_product_cat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('parent', 255)->nullable();
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->unsignedBigInteger('category_agregasi')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_category');
            $table->foreign('product_sku_id')->references('id')->on('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_product_cat');
    }
};
