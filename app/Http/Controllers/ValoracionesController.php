<?php

namespace pruebaNivel\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use League\Flysystem\Exception;
use pruebaNivel\Pelicula;
use pruebaNivel\Valoracion;
use DB;
use File;


class ValoracionesController extends Controller
{

    /**
     * Crea vista guarda valoracion
     * @param $id
     * @return View
     */
    public function create ($id){

        $pelicula = PeliculasController::getPelicula($id);

        return view('valoraciones/create', compact('pelicula'));

    }

    /**
     * Crea vista ver y editar
     * @param $id
     * @return View
     */
    public function showEdit($id){

        $usuarios_id = session('usuario_id');
        $valoracion = $this::getValoracionPeliculaUsuario($id, $usuarios_id);

        $pelicula = PeliculasController::getPelicula($id);

        return view('valoraciones/create', compact('pelicula', 'valoracion'));
    }

    /**
     * Borra valoracion
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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




            $mensaje = 'Valoración eliminada con éxito';
            $flag = true;
        }
        catch (Exception $ex){
            DB::rollBack();
            $mensaje = 'Error al guardar datos';
            $flag = false;
        }

        return redirect('valoraciones-ver')->with(compact('mensaje','flag' ));


    }


    /**
     * Devuelte valoraciones de un usuario
     * @return View
     */
    public function loadValoraciones(){

        $usuario_id = session('usuario_id');

        $valoraciones = Valoracion::where('usuario_id', $usuario_id)->paginate(5);

        return view('valoraciones/showall', compact('valoraciones'));
    }

    /**
     * Devuelve la valoracion realizada por el usuario de una determinada pelicula
     * @param $pelicula_id
     * @param $usuario_id
     * @return mixed
     */
    public static function getValoracionPeliculaUsuario($pelicula_id, $usuario_id){
        return Valoracion::where('usuario_id', $usuario_id)->where('pelicula_id', $pelicula_id)->first();
    }

    /**
     * Devuelve una valoracion
     * @param $id
     * @return mixed
     */
    public function getValoracion($id){
        return Valoracion::where('id', $id)->first();
    }

    /***
     * Guarda una valoracion
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store ($id){

        $data = Input::all();

        // volvemos a validar en el controlador
        $validacion = new Valoracion();
        $errores = $validacion->validate($data);

        if(! $errores->fails() ) {

            DB::beginTransaction();

            try {
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
                $valoracion_media_act = (($valoracion_media * $num_valoraciones) + floatval($data['puntuacion'])) / ($num_valoraciones + 1);

                $pelicula['valoracion_media'] = $valoracion_media_act;
                $pelicula['num_valoraciones'] = $pelicula['num_valoraciones'] + 1;

                $pelicula->save();

                $mensaje = 'Valoración guardada correctamente';
                $flag = true;
                $tipo = 'EXITO';
                $info = 'GUARDAR';

                DB::commit();


            } catch (Exception $ex) {
                DB::rollBack();
                $mensaje = 'Se ha producido un error al guardar los datos';
                $flag = false;
                $tipo = 'ERROR';
                $info = 'GUARDAR';
            }

            //escribe en el log
            $this->anyadeLog(['fecha' => date('d-m-Y H:m:s'), 'tipo' => $tipo, 'info' => $info, 'pelicula_id' => $id, 'usuario_id' => $usuario_id]);
        }

        return redirect('valoraciones-ver')->with(compact('mensaje','flag' ));

    }

    /**Actualiza valoracion
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id){

        $data = Input::all();

        // volvemos a validar en el controlador
        $validacion = new Valoracion();
        $errores = $validacion->validate($data);

        if(! $errores->fails() ) {

            DB::beginTransaction();

            try {

                $usuario_id = session('usuario_id');

                $valoracion = $this::getValoracion($id);

                $puntuacion = $valoracion->puntuacion;

                $pelicula_id = $valoracion->pelicula_id;

                $pelicula = PeliculasController::getPelicula($pelicula_id);
                $valoracion_media = $pelicula->valoracion_media;
                $num_valoraciones = $pelicula->num_valoraciones;


                $valoracion_media_act = ((($valoracion_media * $num_valoraciones) - $puntuacion) + floatval($data['puntuacion'])) / $num_valoraciones;

                //Actualiza en tabla pelicula
                $pelicula_update = Pelicula::find($pelicula_id);
                $pelicula_update['valoracion_media'] = $valoracion_media_act;
                $pelicula_update->save();

                //Actualiza en tabla valoraciones
                $valoracion_update = Valoracion::find($id);
                $valoracion_update['puntuacion'] = $data['puntuacion'];
                $valoracion_update->save();

                DB::commit();

                $mensaje = 'Valoración actualizada con éxito';
                $flag = true;
                $tipo = 'EXITO';
                $info = 'ACTUALIZAR';

            } catch (Exception $ex) {
                DB::rollBack();
                $mensaje = 'Se ha producido un error al actualizar los datos';
                $flag = false;
                $tipo = 'ERROR';
                $info = 'ACTUALIZAR';
            }

            //escribe en el log
            $this->anyadeLog(['fecha' => date('d-m-Y H:m:s'), 'tipo' => $tipo, 'info' => $info, 'pelicula_id' => $id, 'usuario_id' => $usuario_id]);
        }

        return redirect('valoraciones-ver')->with(compact('mensaje','flag' ));

    }

    /**Crea un fichero log
     * @param $data
     */
    public function anyadeLog ($data){

        $usuario_id = session('usuario_id');

        $archivo = 'log_valoraciones/vlrc_log_'.$usuario_id.'.txt';

        if (!File::exists('log_valoraciones'))
            File::makeDirectory('log_valoraciones', 777, true);

       if (File::exists($archivo)){
           $contenido = File::get($archivo);
           File::put($archivo, $contenido."\r\n" .json_encode($data));

       }

       else{
           File::put($archivo, json_encode($data));
       }

    }



}
