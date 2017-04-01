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
                    <div class="col-md-12" class="text-center">
                        <?php $estado =  $flag ? 'success' : 'danger';?>
                        <div class="alert alert-{{$estado}}" role="alert">  {{$mensaje}} </div>
                    </div>
                </div>
            @endif
            @if( count($valoraciones))
                <h3 class="text-center">Tus valoraciones</h3>
                <table class="table table-hover" >
                    <thead >
                    <tr >
                        <th class="text-center"> T&iacute;tulo Pel&iacute;cula</th>
                        <th class="text-center">Tu puntuaci&oacute;n</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($valoraciones as $valoracion)
                        <tr>
                            <?php
                            $pelicula = PeliculasController::getPelicula($valoracion->pelicula_id);

                            session(['pelicula_id' => $pelicula->id]);
                            ;?>
                            <td>{{$pelicula->titulo }}</td>
                            <td>{{$valoracion->puntuacion}}</td>
                            <td>
                                <a href="{!!'valoracion-show/'. $valoracion->pelicula_id!!}" class="glyphicon glyphicon-zoom-in letra-25 text-deco-none" title="Ver">

                                </a>
                                <a href="{!! 'valoracion-edit/'.$valoracion->pelicula_id !!}" class="glyphicon glyphicon-pencil letra-25 text-deco-none" title="Editar">

                                </a>
                                    <a class="glyphicon glyphicon-trash abre-modal-borrar letra-25 text-deco-none" data-id="{{$pelicula->titulo}}|{{$valoracion->pelicula_id}}" href="#" data-href="valoracion-remove" data-toggle="modal" data-target="#confirm-delete" title="Eliminar"></a>
                                {{--</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    <div class="col-md-offset-6">
                        <span class="pagination">  {!! $valoraciones->render() !!} </span>
                    </div>
            @else
                <h3 class="text-center"> Todav&iacute;a no has hecho ninguna valoraci&oacute;n</h3>
            @endif
        </div>
    </div>

</div>




@stop
@section('footer')
@stop















