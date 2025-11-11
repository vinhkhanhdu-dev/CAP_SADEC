<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MonThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('danhSachMonThis', function (Blueprint $table) {
            $table->id();
            $table->string('maMonHoc')->unique();
            $table->string('tenMonHoc');
            $table->string('hinhThucThi')->nullable();// Trắc nghiệm, tự luận
            $table->string('thongTinChiTiet')->nullable();                  
            $table->string('ghiChu')->nullable();                    
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
        Schema::dropIfExists('danhSachMonThis');
    }
}
