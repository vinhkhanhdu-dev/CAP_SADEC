<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DanhSachPhongThi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('danhSachPhongThis', function (Blueprint $table) {
            $table->id();
            $table->string('maPhongThi')->unique();
            $table->string('tenPhongThi');               
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
        Schema::dropIfExists('danhSachPhongThis');
    }
}
