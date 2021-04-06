<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machiens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->foreignId('motherboard');
            $table->foreign('motherboard')->references('id')->on('motherboard');
            $table->foreignId('processor');
            $table->foreign('processor')->references('id')->on('processor');
            $table->foreignId('memory');
            $table->foreign('memory')->references('id')->on('memory');
            $table->integer('memory-col');
            $table->foreignId('storage');
            $table->foreign('storage')->references('id')->on('storage');
            $table->integer('storage-col');
            $table->foreignId('graphic');
            $table->foreign('graphic')->references('id')->on('graphic-cards');
            $table->integer('graphic-col');
            $table->foreignId('power');
            $table->foreign('power')->references('id')->on('power');
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
        Schema::dropIfExists('machiens');
    }
}
