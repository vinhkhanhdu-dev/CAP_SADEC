<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->bigInteger('id_parent')->unsigned()->nullable();
            $table->foreign('id_parent')->references('id')->on('modules')->onDelete('cascade');
            $table->integer('index')->nullable();
            $table->string('alias')->nullable();
            $table->string('class')->nullable();
            $table->string('icon')->nullable();
            $table->string('path')->nullable();
            $table->integer('type')->nullable();
            $table->boolean('status')->nullable()->default(true);
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
        Schema::dropIfExists('modules');
    }
}
