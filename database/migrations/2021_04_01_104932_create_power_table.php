<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->string('power');
            $table->foreignId('reyt');
            $table->foreign('reyt')->references('id')->on('reyt');
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
        Schema::dropIfExists('power');
    }
}
