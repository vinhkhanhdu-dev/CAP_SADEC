<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DanhSachNamHoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('namHocs', function (Blueprint $table) {
            $table->id();
            $table->string('maNamHoc')->unique();
            $table->string('tenNamHoc')->unique();
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
        Schema::dropIfExists('namHocs');
    }
}
