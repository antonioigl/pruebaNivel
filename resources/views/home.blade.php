<?php
use \pruebaNivel\Http\Controllers\ValoracionesController as ValoracionesController;
use \pruebaNivel\Http\Controllers\PeliculasController as PeliculasController;
use \pruebaNivel\Http\Controllers\UsuariosController as UsuariosController;


use \pruebaNivel\Valoracion as Valoracion;
;?>


@extends('master')
@section('body')

<?php

$usuario_id = session('usuario_id');

$usuario = UsuariosController::getUsuario(session('usuario_id'));

;?>

<div class="row container-fluid">

    <div class="row" >
        <div class="col-md-12" >
            <h3 class="text-center"> Bienvenid@ {{$usuario->nombre}}</h3>
        </div>
    </div>

</div>


@stop
@section('footer')
@stop















