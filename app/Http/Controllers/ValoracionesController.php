<?php

namespace pruebaNivel\Http\Controllers;

//use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
//use pruebaNivel\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use League\Flysystem\Exception;
use pruebaNivel\Pelicula;
use pruebaNivel\Valoracion;
use DB;


class ValoracionesController extends Controller
{

    public function create ($id){

        $pelicula = PeliculasController::getPelicula($id);

        return view('valoraciones/create', compact('pelicula'));

    }

    public function showEdit($id){


        $usuarios_id = session('usuario_id');
        $valoracion = $this::getValoracionPeliculaUsuario($id, $usuarios_id);

        $pelicula = PeliculasController::getPelicula($id);

        return view('valoraciones/create', compact('pelicula', 'valoracion'));
    }

    public function remove($id){

        DB::beginTransaction();

        try{
            $usuario_id = session('usuario_id');

            $valoracion = ValoracionesController::getValoracionPeliculaUsuario($id,$usuario_id);

            $pelicula = Pelicula::find($id);

            //comprobamos que haya mas de una valoracion para evitar dividir entre 0
            if ($pelicula['num_valoraciones'] == 1){
                $pelicula['valoracion_media'] = 0.00;
                $pelicula['num_valoraciones'] = 0;
            }
            else{

                $valoracion_media_act = (($pelicula['valoracion_media'] * $pelicula['num_valoraciones'] ) - $valoracion->puntuacion) / ($pelicula['num_valoraciones'] -1);

                $pelicula['valoracion_media'] = $valoracion_media_act;
                $pelicula['num_valoraciones'] = $pelicula['num_valoraciones']-1;
            }

            $pelicula->save();

            Valoracion::find($valoracion->id)->delete();

            DB::commit();

            $mensaje = 'Valoración actualizada con éxito';
            $flag = true;
        }
        catch (Exception $ex){
            DB::rollBack();
            $mensaje = 'Error al guardar datos';
            $flag = false;
        }

        return redirect('valoraciones-ver')->with(compact('mensaje','flag' ));


    }

    public function loadValoraciones(){

        $usuario_id = session('usuario_id');

        //$valoraciones = ValoracionesController::getValoracionesUsuario($usuario_id);

        $valoraciones = Valoracion::where('usuario_id', $usuario_id)->get();
        //return view('valoraciones/showall', compact('valoraciones'));

        return view('valoraciones/showall', compact('valoraciones'));
    }

    public static function getValoracionPeliculaUsuario($pelicula_id, $usuario_id){
        return Valoracion::where('usuario_id', $usuario_id)->where('pelicula_id', $pelicula_id)->first();
    }

    public function getValoracion($id){
        return Valoracion::where('id', $id)->first();
    }



    public function store ($id){

        $data = Input::all();

        // volvemos a validar en el controlador
        $validacion = new Valoracion();
        $errores = $validacion->validate($data);

        if(! $errores->fails() ) {

            DB::beginTransaction();

            try{
                $usuario_id = session('usuario_id');

                $pelicula = PeliculasController::getPelicula($id);
                $valoracion_media = $pelicula->valoracion_media;
                $num_valoraciones = $pelicula->num_valoraciones;

                $data['usuario_id'] = session('usuario_id');
                $data['pelicula_id'] = $id;

                //guardar datos tabla valoraciones
                $valoracion = new Valoracion();

                $valoracion->puntuacion = floatval($data['puntuacion']);
                $valoracion->fill($data);
                $valoracion->save();

                //actualizar datos tabla peliculas
                $pelicula = Pelicula::find($id);
                $valoracion_media_act = ( ($valoracion_media * $num_valoraciones)  +  floatval($data['puntuacion']) ) / ($num_valoraciones +1 );

                $pelicula['valoracion_media'] =  $valoracion_media_act;
                $pelicula['num_valoraciones'] =  $pelicula['num_valoraciones'] + 1;

                $pelicula->save();

                DB::commit();

                $mensaje = 'Valoración guardada con éxito';
                $flag = true;
            }
            catch (Exception $ex){
                DB::rollBack();
                $mensaje = 'Error al guardar datos';
                $flag = false;
            }


        }

        return redirect('valoraciones-ver')->with(compact('mensaje','flag' ));

    }

    public function update($id){

        $data = Input::all();

        DB::beginTransaction();

        try {

            $valoracion = $this::getValoracion($id);

            $puntuacion = $valoracion->puntuacion;

            $pelicula_id = $valoracion->pelicula_id;

            $pelicula = PeliculasController::getPelicula($pelicula_id);
            $valoracion_media = $pelicula->valoracion_media;
            $num_valoraciones = $pelicula->num_valoraciones;


            $valoracion_media_act = ((($valoracion_media * $num_valoraciones) - $puntuacion) + floatval($data['puntuacion'])) / $num_valoraciones;

            $pelicula_update = Pelicula::find($pelicula_id);
            $pelicula_update['valoracion_media'] = $valoracion_media_act;
            $pelicula_update->save();


            $valoracion_update = Valoracion::find($id);
            $valoracion_update['puntuacion'] = $data['puntuacion'];
            $valoracion_update->save();

            DB::commit();

            $mensaje = 'Valoración actualizada con éxito';
            $flag = true;
        }
        catch (Exception $ex){
            DB::rollBack();
            $mensaje = 'Error al guardar datos';
            $flag = false;
        }

        return redirect('valoraciones-ver')->with(compact('mensaje','flag' ));

    }

}
