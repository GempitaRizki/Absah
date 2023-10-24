<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToTable extends Migration
{
    public function up()
    {
        Schema::table('product_sku', function (Blueprint $table) {
            $table->unsignedBigInteger('product_sku_id')->nullable();
            $table->foreign('product_sku_id')->references('id')->on('ipr_product');
        });
    }

    public function down()
    {
        Schema::table('product_sku', function (Blueprint $table) {
            $table->dropForeign(['product_sku_id']);
            $table->dropColumn('product_sku_id');
        });
    }
}
