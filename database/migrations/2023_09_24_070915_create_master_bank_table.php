<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMasterBankTable extends Migration
{
    public function up()
    {
        Schema::create('master_bank', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedInteger('type')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('master_status');
        });

        // Insert data
        DB::table('master_bank')->insert([
            ['id' => 1, 'name' => 'Mandiri'],
            ['id' => 2, 'name' => 'BNI VIRTUAL'],
            ['id' => 5, 'name' => 'BANK ACEH SYARIAH'],
            ['id' => 6, 'name' => 'BANK SUMUT'],
            ['id' => 7, 'name' => 'BANK NAGARI'],
            ['id' => 8, 'name' => 'BANK RIAU KEPRI'],
            ['id' => 9, 'name' => 'BANK JAMBI'],
            ['id' => 10, 'name' => 'BANK BENGKULU'],
            ['id' => 11, 'name' => 'BANK LAMPUNG'],
            ['id' => 12, 'name' => 'BPD SUMSELBABEL'],
            ['id' => 13, 'name' => 'BANK DKI'],
            ['id' => 14, 'name' => 'BANK BJB'],
            ['id' => 15, 'name' => 'BANK JATENG'],
            ['id' => 16, 'name' => 'BANK BPD DIY'],
            ['id' => 17, 'name' => 'BANK JATIM SIDOARJO'],
            ['id' => 18, 'name' => 'BPD BALI'],
            ['id' => 19, 'name' => 'BANK NTB SYARIAH'],
            ['id' => 20, 'name' => 'BPD NUSA TENGGARA TIMUR'],
            ['id' => 21, 'name' => 'BANK KALBAR JAKARTA'],
            ['id' => 22, 'name' => 'BANK KALTENG'],
            ['id' => 23, 'name' => 'BANK KALSEL'],
            ['id' => 24, 'name' => 'BANK KALTIM'],
            ['id' => 25, 'name' => 'BANK SULUTGO'],
            ['id' => 26, 'name' => 'BANK SULTENG'],
            ['id' => 27, 'name' => 'BANK SULSELBAR'],
            ['id' => 28, 'name' => 'BANK SULTRA'],
            ['id' => 29, 'name' => 'BANK MALUKU MALUT'],
            ['id' => 30, 'name' => 'BANK PAPUA'],
            ['id' => 31, 'name' => 'Kode Bayar BPDaja'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('master_bank');
    }
}
