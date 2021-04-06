<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotherboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motherboard', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->foreignId('brand');
            $table->foreign('brand')->references('id')->on('brands');
            $table->foreignId('socket');
            $table->foreign('socket')->references('id')->on('socket');
            $table->integer('ram');
            $table->integer('max-tdp');
            $table->foreignId('ram-type');
            $table->foreign('ram-type')->references('id')->on('ram-type');
            $table->integer('sata');
            $table->integer('m2');
            $table->integer('pci');
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
        Schema::dropIfExists('motherboard');
    }
}
