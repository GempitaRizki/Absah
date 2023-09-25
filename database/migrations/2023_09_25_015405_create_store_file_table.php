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
        Schema::create('store_file', function (Blueprint $table) {
            $table->id();
            $table->string('storefile')->nullable();
            $table->string('storefile_bash_url')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('file_category')->nullable();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_file');
    }
};
