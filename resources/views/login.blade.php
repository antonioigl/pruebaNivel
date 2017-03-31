<?php
use \pruebaNivel\Http\Controllers\UsuariosController as UsuariosController;
;?>


@extends('master')
@section('body')


<div class="row container">

    <div class="row" style="text-align: center">

        <div class="col-md-12">
            <h1>Selecciona un usuario</h1>
        </div>
    </div>

    <div class="row" >
        {{Form::open( ['url' => 'home', 'method' => 'POST'] )}}



        <div class="col-md-6 col-md-offset-3">
            <div class="row" >
                <div class="col-md-12">
                    <?php
                    $usuarios = UsuariosController::showAll();
                    ;?>
{{--                    {{  Form::select('select_usuario_id', $usuarios,null, ['class' => 'form-control', 'id' => 'select_usuario_id']) }}--}}
                        <select class="form-control" name="select_usuario_id" id="select_usuario_id">

                            @if (count($usuarios))

                                @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->nombre . ' ' }} {{ $usuario->apellido }}</option>
                                @endforeach
                                @else
                                <option value="0">No hay usuarios</option>

                            @endif
                        </select>
                </div>
            </div>

            <div class="row" >
                <div class="col-md-12" style="margin-top: 15px">
                    {{--<a href="home/{{$usuario_id_default}}" id="btn_select_usuario" class="btn btn-block btn-success">Aceptar</a>--}}
                    {{Form::submit('Aceptar', ['class' => 'btn btn-block btn-success'])}}
                </div>
            </div>
        </div>

        {{Form::close()}}
    </div>

</div>
@stop
@section('footer')
@stop




