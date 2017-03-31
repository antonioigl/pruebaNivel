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
                                <a href="{!!'valoracion-show/'. $valoracion->pelicula_id!!}" class="glyphicon glyphicon-zoom-in" style="text-decoration:none">

                                </a>
                                <a href="{!! 'valoracion-edit/'.$valoracion->pelicula_id !!}" class="glyphicon glyphicon-pencil" style="text-decoration:none">

                                </a>
                                {{--<a href="#" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete" class="glyphicon glyphicon-remove" style="text-decoration:none">--}}
                                    <a class="glyphicon glyphicon-remove abre-modal-borrar" data-id="hola" style="text-decoration:none" href="#" data-href="{!! 'valoracion-remove/'.$valoracion->pelicula_id !!}" data-toggle="modal" data-target="#confirm-delete"></a>
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



<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>

            <div class="modal-body">
                <p>You are about to delete one track, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<a href="#" data-href="/delete.php?id=23" data-toggle="modal" data-target="#confirm-delete">Delete record #23</a><br>

<button class="btn btn-default" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete">
    Delete record #54
</button>








@stop
@section('footer')
@stop















