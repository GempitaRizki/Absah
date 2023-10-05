<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('store_detail', function (Blueprint $table) {
            $table->integer('store_id')->change();
        });
    }

    public function down()
    {
        Schema::table('store_detail', function (Blueprint $table) {
            $table->string('store_id')->change();
        });
    }
};
