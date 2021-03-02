<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('lekarz_id')->unsigned();
            $table->integer('pacjent_id')->unsigned();

            $table->foreign('lekarz_id')->references('id')->on('users')->onCascade('delete');

            $table->foreign('pacjent_id')->references('id')->on('users')->onCascade('delete');
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
        Schema::dropIfExists('events');
    }
}