<?php

namespace pruebaNivel;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    //
    protected $table = 'peliculas';
    protected $fillable= ['titulo', 'categoria', 'valoracion_media', 'num_valoraciones'];

}