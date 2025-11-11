<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KhoiThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('khoiThis', function (Blueprint $table) {
            $table->id();
            $table->string('maKhoiThi')->unique();
            $table->string('tenKhoiThi');
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
        Schema::dropIfExists('khoiThis');
    }
}
