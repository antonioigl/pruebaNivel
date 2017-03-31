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


                <div id="resultado_valoracion_id">  </div>

                <h3 style="text-align: center">Valoraci&oacute;n</h3>

            {{Form::open( ['url' => 'valoracion-store', 'id' => 'valoraciones_form_id','method' => 'POST'] )}}

            <table class="table table-hover" >
                    <thead >
                    <tr >
                        <th style="text-align: center"> T&iacute;tulo Pel&iacute;cula</th>
                        <th style="text-align: center">Categor&iacute;a</th>
                        <th style="text-align: center">Tu puntuaci&oacute;n</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                        <tr>
                            <td>{{$pelicula->titulo }}</td>
                            <td>{{$pelicula->categoria}}</td>
                            <td>
                                <?php
                                 $valoracion = ValoracionesController::getValoracionPeliculaUsuario($pelicula->id, session('usuario_id'));

                                    $puntuacion = $valoracion ? $valoracion->puntuacion : null;
                                 ;?>

                                {{Form::select('puntuacion', [-1 => 'Selecciona una puntuación'] + [0,1,2,3,4,5,6,7,8,9,10],  $puntuacion, ['class' => 'form-control', 'id'=>'puntuacion_id' ,'style' => 'width: 40%; display: inline-block;'])}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            {{Form::button('Enviar', ['class' => 'btn btn-lg btn-success', 'id' => 'enviar_valoracion_id' ])}}

            {{Form::close()}}
        </div>
    </div>

</div>


@stop
@section('footer')
@stop















