<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ValoracionesTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('valoraciones', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('pelicula_id')->unsigned();

            $table->integer('puntuacion');

            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('pelicula_id')->references('id')->on('peliculas');
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
        Schema::table('valoraciones', function(Blueprint $table) {

            $table->dropForeign('valoraciones_usuario_id_foreign');
            $table->dropForeign('valoraciones_pelicula_id_foreign');
        });

        Schema::dropIfExists('valoraciones');
    }
}
