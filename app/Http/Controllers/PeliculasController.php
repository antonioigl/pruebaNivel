<?php

namespace pruebaNivel\Http\Controllers;

//use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
//use pruebaNivel\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use pruebaNivel\Pelicula;


class PeliculasController extends Controller
{

    public function showAll(){

        $peliculas = Pelicula::orderBy('valoracion_media', 'desc')->paginate(5);

        return view('peliculas/showall', compact('peliculas'));
      
    }

    public static function getPelicula($id){
            return Pelicula::where('id', $id)->first();
    }

}
