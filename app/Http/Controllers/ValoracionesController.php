<?php

namespace pruebaNivel\Http\Controllers;

//use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
//use pruebaNivel\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use pruebaNivel\Pelicula;
use pruebaNivel\Valoracion;


class ValoracionesController extends Controller
{


    public function show($id){


    }

    public function edit($id){
    }

    public function remove($id){
    }

    public function loadValoraciones(){

        $usuario_id = session('usuario_id');

        //$valoraciones = ValoracionesController::getValoracionesUsuario($usuario_id);

        $valoraciones = Valoracion::where('usuario_id', $usuario_id)->get();
        //return view('valoraciones/showall', compact('valoraciones'));

        return view('valoraciones/showall')->with(compact('valoraciones'));
    }

    public static function getValoracionPeliculaUsuario($pelicula_id, $usuario_id){
        return Valoracion::where('usuario_id', $usuario_id)->where('pelicula_id', $pelicula_id)->first();
    }

    public function create ($id){

        $pelicula = PeliculasController::getPelicula($id);
        session(['pelicula_id' => $id]);

        return view('valoraciones/create', compact('pelicula'));

    }

    public function store (){

        $data = Input::all();

        // volvemos a validar en el controlador
        $validacion = new Valoracion();
        $errores = $validacion->validate($data);

        if(! $errores->fails() ) {

            $usuario_id = session('usuario_id');
            $pelicula_id = session('pelicula_id');

            $pelicula = PeliculasController::getPelicula($pelicula_id);
            $valoracion_media = $pelicula->valoracion_media;
            $num_valoraciones = $pelicula->num_valoraciones;

            //solo guardamos en valoraciones si no se previamente no se ha hecho ninguna valoracion de esa pelicula
            $valoracion = $this::getValoracionPeliculaUsuario($pelicula_id, $usuario_id);

            //estamos creando
            if ( is_null($valoracion)){
                $data['usuario_id'] = $usuario_id;
                $data['pelicula_id'] = $pelicula_id;
                $valoracion = new Valoracion();

                $valoracion->puntuacion = floatval($data['puntuacion']);
                $valoracion->fill($data);
                $valoracion->save();

                //actualizar datos tabla peliculas
                $valoracion_media_act = ( ($valoracion_media * $num_valoraciones)  +  floatval($data['puntuacion']) ) / ($num_valoraciones +1 );

                Pelicula::where('id',$pelicula_id)->update( ['valoracion_media' => $valoracion_media_act ]);
                Pelicula::where('id',$pelicula_id)->update( ['num_valoraciones' => $num_valoraciones+1 ]);
                //Pelicula::increment('num_valoraciones');

                session(['mensaje' => 'Valoración guardada con éxito']);
                session(['flag' => true]);
            }

            //estamos editando
           else{

               $puntuacion = $valoracion->puntuacion;

               $valoracion_media_act = ((($valoracion_media * $num_valoraciones) - $puntuacion ) + floatval($data['puntuacion'])) / $num_valoraciones;
               Pelicula::where('id',$pelicula_id)->update( ['valoracion_media' => $valoracion_media_act]);

               Valoracion::where('id', $valoracion->id)->update(['puntuacion' =>  $data['puntuacion']]);


           }



            $mensaje = 'Valoración guardada con éxito';
            $flag = true;

        }
        else{

            $mensaje = 'Error al guardar la valoración';
            $flag = false;
        }

        return redirect('ver-valoraciones')->with(compact('mensaje','flag' ));

    }

}
