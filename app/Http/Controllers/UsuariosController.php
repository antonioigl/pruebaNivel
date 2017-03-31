<?php

namespace pruebaNivel\Http\Controllers;

//use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
//use pruebaNivel\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use pruebaNivel\Usuario;



class UsuariosController extends Controller
{

    public static function showAll(){
        return  Usuario::all();

    }

    public static function getUsuario($id){
        return  Usuario::where('id',$id)->first();

    }


    public function loginUsuario()
    {
        session()->flush();

        $data = Input::all();
        $usuario_id = $data['select_usuario_id'];
        session(['usuario_id' => $usuario_id]);

        return view('home');

    }


}
