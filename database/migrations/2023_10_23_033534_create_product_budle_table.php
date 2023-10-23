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
        Schema::create('product_buddle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('min_qty')->nullable();
            $table->unsignedBigInteger('bundle_id')->nullable();
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->unsignedBigInteger('is_edit_qty')->nullable();
            $table->unsignedBigInteger('is_delete')->nullable();
            $table->unsignedBigInteger('is_hide')->nullable();

            $table->foreign('bundle_id')->references('id')->on('product_sku');
            $table->foreign('product_sku_id')->references('id')->on('product_sku');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_budle');
    }
};
