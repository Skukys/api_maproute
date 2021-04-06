<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processor', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->foreignId('brand');
            $table->foreign('brand')->references('id')->on('brands');
            $table->foreignId('socket');
            $table->foreign('socket')->references('id')->on('socket');
            $table->integer('yad');
            $table->integer('base');
            $table->integer('max');
            $table->integer('kash');
            $table->integer('tdp');
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
        Schema::dropIfExists('processor');
    }
}
