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
        Schema::create('ipr_order', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_order', 45)->nullable();
            $table->string('nomor_invoice', 45)->nullable();
            $table->dateTime('date_order')->nullable();
            $table->unsignedBigInteger('payment_method')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->text('shipping_data')->nullable();
            $table->unsignedBigInteger('shipping_method')->nullable();
            $table->unsignedBigInteger('shipping_status')->nullable();
            $table->unsignedBigInteger('shipping_cost')->nullable();
            $table->unsignedBigInteger('shipping_resi')->nullable();
            $table->unsignedBigInteger('shipping_estimate')->nullable();
            $table->dateTime('confirm_shipping_date')->nullable();
            $table->unsignedBigInteger('sumber_dana_id')->nullable();
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->decimal('denda', 15, 2)->nullable();
            $table->unsignedBigInteger('estimasi_pembayaran')->nullable();
            $table->string('is_edit', 10)->nullable();
            $table->unsignedBigInteger('edit_confirm')->nullable();
            $table->unsignedBigInteger('sekolah_id')->nullable();
            $table->string('shipping_note', 255)->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('is_beku')->nullable();
            $table->string('payment_numbers', 50)->nullable();
            $table->unsignedBigInteger('payment_note')->nullable();
            $table->unsignedBigInteger('reorder')->nullable();
            $table->unsignedBigInteger('gantung')->nullable();
            $table->dateTime('tiba_sekolah')->nullable();
            $table->decimal('total_pesanan', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('master_status');
            $table->foreign('store_id')->references('id')->on('Stores');
            $table->foreign('shipping_method')->references('id')->on('master_status');
            $table->foreign('shipping_status')->references('id')->on('master_status');
            $table->foreign('sumber_dana_id')->references('id')->on('sumber_dana');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipr_order');
    }
};
