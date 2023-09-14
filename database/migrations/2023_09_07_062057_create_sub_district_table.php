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
        Schema::create('sub_district', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->smallInteger('status');
            $table->unsignedBigInteger('district_id');
            $table->string('id_intan')->nullable();
            $table->string('id_dikbud')->nullable();
            $table->timestamps();

            $table->foreign('district_id')->references('id')->on('district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_district');
    }
};

