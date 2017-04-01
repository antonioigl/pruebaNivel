<?php
use \pruebaNivel\Http\Controllers\ValoracionesController as ValoracionesController;
use \pruebaNivel\Http\Controllers\PeliculasController as PeliculasController;


use \pruebaNivel\Valoracion as Valoracion;
;?>

<?php

if (isset($valoracion)){
    $datos_form = ['url' => 'valoracion-update/'.$valoracion->id, 'method'=>'PATCH', 'id' => 'form-update-valoracion'];
    $puntuacion = $valoracion->puntuacion;
}
else{
    $datos_form = ['url' => 'valoracion-store/'.$pelicula->id, 'method'=>'POST', 'id' => 'form-store-valoracion'];
    $puntuacion =  null;
}

;?>


@extends('master')
@section('body')


    <div class="row container-fluid">

    <div class="row" >
        <div class="col-md-12" >

                <div id="resultado_valoracion_id">  </div>

                <h3 class="text-center">Valoraci&oacute;n</h3>

            {{Form::open( $datos_form )}}
{{--            {{Form::model( $valoracion, $datos_form ,['role'=>'form'] )}}--}}

            <table class="table table-hover" >
                    <thead >
                    <tr >
                        <th class="text-center"> T&iacute;tulo Pel&iacute;cula</th>
                        <th class="text-center">Categor&iacute;a</th>
                        <th class="text-center">Tu puntuaci&oacute;n</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>{{$pelicula->titulo }}</td>
                            <td>{{$pelicula->categoria}}</td>
                            <td>
                                @if(strpos($_SERVER['REQUEST_URI'], 'show'))
                                    {{$valoracion->puntuacion}}
                                @else
                                    {{Form::select('puntuacion', [-1 => 'Selecciona una puntuación'] + [0,1,2,3,4,5,6,7,8,9,10],  $puntuacion, ['class' => 'form-control width-40x100 display-inline-block', 'id'=>'puntuacion_id'])}}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @if(strpos($_SERVER['REQUEST_URI'], 'show') === false)
                {{Form::button('Enviar', ['class' => 'btn btn-lg btn-success', 'id' => 'enviar_valoracion_id' ])}}
            @endif
            <a href="{!!  url()->previous() !!}" class="btn btn-lg btn-default">Atr&aacute;s</a>
            {{Form::close()}}
        </div>
    </div>

</div>


@stop
@section('footer')
@stop















