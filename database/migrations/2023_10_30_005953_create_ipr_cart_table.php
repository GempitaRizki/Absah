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
        Schema::create('ipr_cart', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('status_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('sumber_dana_id')->nullable();
            $table->unsignedBigInteger('shipping_method')->nullable();
            $table->decimal('denda', 8, 2)->nullable();
            $table->unsignedBigInteger('estimasi_pembayaran')->nullable();
            $table->string('shipping_estimate', 255)->nullable();
            $table->string('shipping_note', 255)->nullable();
            $table->decimal('shipping_cost', 8, 2)->nullable();
            $table->unsignedBigInteger('sekolah_id')->nullable();
            $table->unsignedBigInteger('payment_method')->nullable();
            $table->string('shipping_method_code', 255)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipr_cart');
    }
};
