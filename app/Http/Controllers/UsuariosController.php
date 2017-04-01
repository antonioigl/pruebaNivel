<?php

namespace pruebaNivel\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use pruebaNivel\Usuario;



class UsuariosController extends Controller
{

    /**
     * Devuelve todos los usuarios
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function showAll(){
        return  Usuario::all();

    }

    /**
     * Devuelve un usuario
     * @param $id
     * @return mixed
     */
    public static function getUsuario($id){
        return  Usuario::where('id',$id)->first();

    }

    /**
     * Inicia sesion
     * @return View
     */
    public function login()
    {
        if ( ! session()->has('usuario_id')){

            $data = Input::all();
            $usuario_id = $data['select_usuario_id'];
            session(['usuario_id' => $usuario_id]);
        }

        return view('home');

    }

    /**
     * Cierra sesion
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

}
