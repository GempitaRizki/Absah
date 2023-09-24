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
        Schema::create('subdistricts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->smallInteger('status')->nullable();
            $table->unsignedBigInteger('districts_id')->nullable();
            $table->string('id_intan')->nullable();
            $table->string('id_dikbud')->nullable();
            $table->timestamps();

            $table->foreign('districts_id')->references('id')->on('districts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdistricts');
    }
};
