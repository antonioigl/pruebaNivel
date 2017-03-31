<?php
use \pruebaNivel\Http\Controllers\ValoracionesController as ValoracionesController;
use \pruebaNivel\Http\Controllers\PeliculasController as PeliculasController;


use \pruebaNivel\Valoracion as Valoracion;
;?>


@extends('master')
@section('body')


<div class="row container-fluid">

    <div class="row" >
        <div class="col-md-12" >
            @if( count($valoraciones))
                @if(session()->has('mensaje'))
                    <?php  $mensaje = session('mensaje'); $flag = session('flag');?>
                    <div class="row margen-top-10">
                        <div class="col-md-12" style="text-align: center">
                            <?php $estado =  $flag ? 'success' : 'danger';?>
                            <div class="alert alert-{{$estado}}" role="alert">  {{$mensaje}} </div>
                        </div>
                    </div>
                @endif

                <h3 style="text-align: center">Tus valoraciones</h3>
                <table class="table table-hover" >
                    <thead >
                    <tr >
                        <th style="text-align: center"> T&iacute;tulo Pel&iacute;cula</th>
                        <th style="text-align: center">Tu puntuaci&oacute;n</th>
                        <th style="text-align: center">Opciones</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                    @foreach($valoraciones as $valoracion)
                        <tr>
                            <?php
                            $pelicula = PeliculasController::getPelicula($valoracion->pelicula_id);

                            session(['pelicula_id' => $pelicula->id]);
                            ;?>
                            <td>{{$pelicula->titulo }}</td>
                            <td>{{$valoracion->puntuacion}}</td>
                            <td>
                                <a href="valoracion-show/{{$valoracion->id}}" class="glyphicon glyphicon-zoom-in" style="text-decoration:none">

                                </a>
                                <a href="valoracion-edit/{{$valoracion->id}}" class="glyphicon glyphicon-pencil" style="text-decoration:none">

                                </a>
                                <a href="valoracion-remove/{{$valoracion->id}}" class="glyphicon glyphicon-remove">

                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 style="text-align: center"> Todav&iacute;a no has hecho ninguna valoraci&oacute;n</h3>
            @endif
        </div>
    </div>

</div>


@stop
@section('footer')
@stop















