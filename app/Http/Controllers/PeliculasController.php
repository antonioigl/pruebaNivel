<?php

namespace pruebaNivel\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use pruebaNivel\Pelicula;


class PeliculasController extends Controller
{

    /**
     * Devuelve todas las peliculas
     * @return View
     */
    public function showAll(){

        $peliculas = Pelicula::orderBy('valoracion_media', 'desc')->paginate(5);

        return view('peliculas/showall', compact('peliculas'));
      
    }

    /**
     * Devulve una pelicula
     * @param $id
     * @return mixed
     */
    public static function getPelicula($id){
            return Pelicula::where('id', $id)->first();
    }

}
