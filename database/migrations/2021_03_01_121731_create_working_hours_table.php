<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('working_hours')){
            Schema::create('working_hours', function (Blueprint $table) {
                $table->id();
                $table->dateTime('start');
                $table->dateTime('end');
                $table->timestamps();
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onCascade('delete');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_hours');
    }
}
