<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DanhSachThiSinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('danhSachThiSinhs', function (Blueprint $table) {
            $table->id();
            $table->string('maThiSinh')->unique();
            $table->string('tenThiSinh');
            $table->string('ngaySinh')->nullable();
            $table->string('gioiTinh')->nullable();                  
            $table->string('hsLop')->nullable();          
            $table->string('ketQua')->nullable();          
            $table->string('CCCD')->nullable();          
            $table->string('noiSinh')->nullable();          
            $table->string('ghiChu')->nullable();          
            $table->string('maKhoiThi')->nullable();
            $table->foreign('maKhoiThi')->references('maKhoiThi')->on('khoiThis');   
            $table->string('maNamHoc')->nullable();
            $table->foreign('maNamHoc')->references('maNamHoc')->on('namHocs');           
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
        Schema::dropIfExists('danhSachThiSinhs');
    }
}
