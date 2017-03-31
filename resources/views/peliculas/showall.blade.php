<?php
use \pruebaNivel\Http\Controllers\ValoracionesController as ValoracionesController;
use \pruebaNivel\Http\Controllers\PeliculasController as PeliculasController;


use \pruebaNivel\Valoracion as Valoracion;
;?>


@extends('master')
@section('body')

<?php $usuario_id = session('usuario_id') ;?>

<div class="row container-fluid">


    <div class="row" >
        <div class="col-md-12" >
            @if( count($peliculas) > 0)


                <h3 style="text-align: center">Pel&iacute;culas</h3>
                <table class="table table-hover" >
                    <thead >
                    <tr >
                        <th style="text-align: center"> T&iacute;tulo Pel&iacute;cula</th>
                        <th style="text-align: center"> Categor&iacute;a</th>
                        <th style="text-align: center"> Puntuaci&oacute;n Media</th>
                        <th style="text-align: center"> Num. Valoraciones</th>
                        <th style="text-align: center">Tu puntuaci&oacute;n</th>
                        <th style="text-align: center">Opciones</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center">
                    @foreach($peliculas as $pelicula)
                        <tr>
                            <td>{{$pelicula->titulo }}</td>
                            <td>{{$pelicula->categoria}}</td>
                            <td>{{$pelicula->valoracion_media}}</td>
                            <td>{{$pelicula->num_valoraciones}}</td>
                            <?php $valoracion = ValoracionesController::getValoracionPeliculaUsuario($pelicula->id, $usuario_id) ;?>
                            @if(count($valoracion) > 0 )
                                <td>{{$valoracion->puntuacion}}</td>
                            @else
                                <td> - </td>
                            @endif

                            <td>
                                @if(count($valoracion) > 0 )
                                    <a href="valoracion-edit/{{$pelicula->id}}" class="'btn btn-xs btn-info">EDITAR AHORA</a>
                                @else
                                    <a href="valoracion-create/{{$pelicula->id}}" class="btn btn-xs btn-success">PUNTUAR AHORA</a>
                                @endif
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


















