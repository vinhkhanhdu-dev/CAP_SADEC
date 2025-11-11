<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProvinces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Provinces', function (Blueprint $table) {
            $table->id();
            $table->string('ProvinceCode')->unique();
            $table->string('ProvinceName')->nullable();
            $table->string('ProvinceParent', 32)->nullable()->references('ProvinceCode')->on('Provinces')->onDelete('cascade');
            $table->integer('Level')->nullable();
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
        Schema::dropIfExists('Provinces');
    }
}
