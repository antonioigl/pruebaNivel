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
            @if(session()->has('mensaje'))
                <?php  $mensaje = session('mensaje'); $flag = session('flag');?>
                <div class="row margen-top-10">
                    <div class="col-md-12" style="text-align: center">
                        <?php $estado =  $flag ? 'success' : 'danger';?>
                        <div class="alert alert-{{$estado}}" role="alert">  {{$mensaje}} </div>
                    </div>
                </div>
            @endif
            @if( count($valoraciones))
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
                                <a href="{!!'valoracion-show/'. $valoracion->pelicula_id!!}" class="glyphicon glyphicon-zoom-in" style="text-decoration:none; font-size: 25px;" title="Ver">

                                </a>
                                <a href="{!! 'valoracion-edit/'.$valoracion->pelicula_id !!}" class="glyphicon glyphicon-pencil" style="text-decoration:none; font-size: 25px;" title="Editar">

                                </a>
                                {{--<a href="#" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete" class="glyphicon glyphicon-remove" style="text-decoration:none">--}}
                                    <a class="glyphicon glyphicon-trash abre-modal-borrar" data-id="{{$pelicula->titulo}}|{{$valoracion->pelicula_id}}" style="text-decoration:none; font-size: 25px;" href="#" data-href="valoracion-remove" data-toggle="modal" data-target="#confirm-delete" title="Eliminar"></a>
                                {{--</a>--}}
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















