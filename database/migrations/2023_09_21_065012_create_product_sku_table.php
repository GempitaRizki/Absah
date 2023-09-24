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
        Schema::create('product_sku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_id_reference');
            $table->string('sku')->nullable();
            $table->string('key_attribute')->nullable();
            $table->string('key_sku')->nullable();
            $table->string('name')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('tipe_produk')->nullable();
            $table->string('slug')->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('weight_packing')->nullable();
            $table->unsignedBigInteger('unit_weight')->nullable();
            $table->unsignedBigInteger('has_ppn')->nullable();
            $table->string('detail_ppn')->nullable();
            $table->string('tag_ppn')->nullable();
            $table->unsignedBigInteger('has_shipping')->nullable();
            $table->string('produsen_type')->nullable();
            $table->string('descriptions')->nullable();
            $table->string('url_video')->nullable();
            $table->string('length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->string('preorder_estimate')->nullable();
            $table->unsignedBigInteger('preorder')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('attribute_value')->nullable();
            $table->string('value_ppn')->nullable();
            $table->unsignedBigInteger('type_ppn');
            $table->string('tags')->nullable();
            $table->string('garansi')->nullable();
            $table->string('brand')->nullable();
            $table->string('cetakan')->nullable();
            $table->string('nomor_sk')->nullable();
            $table->string('tgl_sk')->nullable();
            $table->string('code_kbki')->nullable();
            $table->string('made_in')->nullable();


            $table->foreign('created_by')->references('id')->on('users');

            $table->foreign('product_id')->references('id')->on('master_status');
            $table->foreign('unit_weight')->references('id')->on('master_status');
            $table->foreign('has_ppn')->references('id')->on('master_status');
            $table->foreign('has_shipping')->references('id')->on('master_status');
            $table->foreign('preorder')->references('id')->on('master_status');
            $table->foreign('status_id')->references('id')->on('master_status');




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sku');
    }
};
