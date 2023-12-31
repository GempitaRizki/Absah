<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('weight', 15, 2)->nullable()->change();
            $table->text('short_description')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->integer('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('weight', 15, 2)->nullable(false)->change();
            $table->text('short_description')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->integer('status')->nulllable(false)->change();
        });
    }
};
