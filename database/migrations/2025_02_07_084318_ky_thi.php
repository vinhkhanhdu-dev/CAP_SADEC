<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KyThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('kyThis', function (Blueprint $table) {
            $table->id();
            $table->string('maKyThi')->unique();
            $table->string('tenKyThi');
            $table->string('thongTinChiTiet')->nullable();;
            $table->string('ghiChu')->nullable();;                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('thongTinDonVis');
    }
}
