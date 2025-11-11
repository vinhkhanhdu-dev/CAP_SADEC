<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThongTinDonVi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongTinDonVis', function (Blueprint $table) {
            $table->id();
            $table->string('maDonVi')->unique();
            $table->string('tenDonVi');
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
        Schema::dropIfExists('thongTinDonVis');
    }
}
