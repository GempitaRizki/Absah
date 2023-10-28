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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_order', 50)->nullable();
            $table->string('nomor_invoice', 50)->nullable();
            $table->dateTime('date_order')->nullable();
            $table->unsignedBigInteger('payment_method')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->text('shipping_data')->nullable();
            $table->unsignedBigInteger('shipping_method')->nullable();
            $table->unsignedBigInteger('shipping_status')->nullable();
            $table->unsignedBigInteger('shipping_cost')->nullable();
            $table->string('shipping_resi', 50)->nullable();
            $table->string('shipping_estimate', 50)->nullable();
            $table->dateTime('confirm_shipping_date')->nullable();
            $table->unsignedBigInteger('sumber_dana_id')->nullable();
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->decimal('denda', 8, 2)->nullable();
            $table->unsignedBigInteger('estimasi_pembayaran')->nullable();
            $table->string('is_edit', 10)->nullable();
            $table->unsignedBigInteger('edit_confirm')->nullable();
            $table->unsignedBigInteger('sekolah_id')->nullable();
            $table->string('shipping_note', 255)->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedTinyInteger('is_beku')->nullable();
            $table->string('payment_note', 255)->nullable();
            $table->unsignedBigInteger('reorder')->nullable();
            $table->unsignedBigInteger('gantung')->nullable();
            $table->dateTime('tiba_disekolah')->nullable();
            $table->decimal('total_pesanan', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('master_status');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('shipping_method')->references('id')->on('master_status');
            $table->foreign('shipping_status')->references('id')->on('master_status');
            $table->foreign('sumber_dana_id')->references('id')->on('master_status');
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

