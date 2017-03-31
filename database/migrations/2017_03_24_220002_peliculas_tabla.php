<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeliculasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('peliculas', function (Blueprint $table) {

            $table->increments('id');
            $table->string('titulo');
            $table->string('categoria');
            $table->float('valoracion_media');
            $table->integer('num_valoraciones');

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
        Schema::dropIfExists('peliculas');
    }
}
