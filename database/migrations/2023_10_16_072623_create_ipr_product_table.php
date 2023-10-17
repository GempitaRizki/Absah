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
        Schema::create('ipr_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_type')->nullable();
            $table->unsignedBigInteger('condition_id')->nullable();
            $table->unsignedBigInteger('price_type')->nullable();
            $table->unsignedBigInteger('shipping_type')->nullable();
            $table->string('pdf_spec')->nullable();
            $table->text('attribute')->nullable();
            $table->text('attribute_value')->nullable();
            $table->unsignedBigInteger('type_category')->nullable();
            $table->unsignedBigInteger('prakatalog')->nullable();
            $table->timestamps();

            $table->foreign('product_type')->references('id')->on('master_status');
            $table->foreign('condition_id')->references('id')->on('master_status');
            $table->foreign('price_type')->references('id')->on('master_status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipr_product');
    }
};
