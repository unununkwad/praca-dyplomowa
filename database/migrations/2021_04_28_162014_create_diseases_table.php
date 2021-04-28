<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->string('wywiad');
            $table->integer('nr_choroby');
            $table->boolean('czy_pierwsze_zachorowanie');
            $table->dateTime('poczatek_choroby');
            $table->dateTime('koniec_choroby');
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
        Schema::dropIfExists('diseases');
    }
}
