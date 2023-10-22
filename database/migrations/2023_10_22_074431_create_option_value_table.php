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
        Schema::create('option_value', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('color_code', 20)->nullable();
            $table->unsignedBigInteger('option_id')->nullable();
            $table->timestamps();

            $table->foreign('option_id')->references('id')->on('option');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_value');
    }
};
