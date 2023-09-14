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
        Schema::create('district', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->smallInteger('status')->nullable();
            $table->unsignedBigInteger('province_id'); 
            $table->string('id_intan')->nullable();
            $table->string('zona_kumer')->nullable();
            $table->string('id_dikbud')->nullable();
            $table->string('url_gambar')->nullable();
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on('province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district');
    }
};

