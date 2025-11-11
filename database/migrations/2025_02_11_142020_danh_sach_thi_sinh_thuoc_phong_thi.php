<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DanhSachThiSinhThuocPhongThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('danhSachThiSinhThuocPhongThis', function (Blueprint $table) {
            $table->id();            
            $table->string('ketQua')->nullable(); 
            $table->string('maThiSinh')->nullable();
            $table->foreign('maThiSinh')->references('maThiSinh')->on('danhSachThiSinhs');   
            $table->string('maKhoiThi')->nullable();
            $table->foreign('maKhoiThi')->references('maKhoiThi')->on('khoiThis');   
            $table->string('maNamHoc')->nullable();
            $table->foreign('maNamHoc')->references('maNamHoc')->on('namHocs');           
            $table->string('maPhongThi')->nullable();
            $table->foreign('maPhongThi')->references('maPhongThi')->on('danhSachPhongThis');    
            $table->string('maMonHoc')->nullable();
            $table->foreign('maMonHoc')->references('maMonHoc')->on('danhSachMonThis');
            $table->string('maDonVi')->nullable();
            $table->foreign('maDonVi')->references('maDonVi')->on('thongTinDonVis');  
            $table->string('maKyThi')->nullable();
            $table->foreign('maKyThi')->references('maKyThi')->on('kyThis');  
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
        Schema::dropIfExists('danhSachThiSinhThuocPhongThis');
    }
}
