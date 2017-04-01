{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    {{--<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->--}}
    {{--<meta name="description" content="">--}}
    {{--<meta name="author" content="">--}}
    {{--<link rel="icon" href="{{ asset('favicon.ico') }}">--}}
    {{--<title>prueba</title>--}}
    {{--<!-- Bootstrap core CSS -->--}}
    {{--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    {{--<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->--}}
    {{--<link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">--}}
    {{--<!-- Custom styles for this template -->--}}
    {{--<link href="{{ asset('css/jumbotron-narrow.css') }}" rel="stylesheet">--}}
    {{--<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->--}}
    {{--<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->--}}
    {{--<script src="{{ asset('js/ie-emulation-modes-warning.js') }}"></script>--}}
    {{--<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->--}}
    {{--<!--[if lt IE 9]>--}}
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>--}}
    {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}




    {{--<![endif]-->--}}
{{--</head>--}}
{{--<body>--}}
{{--<header>--}}


            {{--<nav class="navbar navbar-default">--}}
                {{--<div class="container-fluid">--}}
                    {{--<div class="navbar-header">--}}
                        {{--<button type="button" class="collapsed navbar-toggle" data-toggle="collapse"--}}
                                {{--data-target="#bs-example-navbar-collapse-6" aria-expanded="false"><span class="sr-only">Toggle navigation</span>--}}
                            {{--<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>--}}
                        {{--<a href="/" class="navbar-brand">Nuevo Usuario</a></div>--}}
                    {{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">--}}
                        {{--<ul class="nav navbar-nav">--}}
                            {{--<li class="active"><a href="./{{$usuario_id }}">Mis Valoraci&oacute;n</a></li>--}}
                            {{--<li><a href="peliculas/show-all">Pel&iacute;culas</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</nav>--}}

{{--<div class="container">--}}
    {{--<div class="header clearfix">--}}
        {{--@yield('header')--}}
    {{--</div>--}}

    {{--<div class="jumbotron">--}}
        {{--@yield('sidebar-up')--}}
    {{--</div>--}}

    {{--<div class="row marketing">--}}
        {{--<div class="col-lg-6">--}}
            {{--@yield('sidebar-left')--}}
        {{--</div>--}}

        {{--<div class="col-lg-6">--}}
            {{--@yield('sidebar-right')--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<footer class="footer">--}}
        {{--@yield('footer')--}}
    {{--</footer>--}}

{{--</div> <!-- /container -->--}}
{{--<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->--}}
{{--<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>--}}
{{--<script src="{{ asset('js/funciones.js') }}"></script>--}}

{{--<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>--}}

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}

{{--@yield('header')--}}
{{--</header>--}}
{{--</body>--}}
{{--</html>--}}












<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
{{--    {{HTML::style('css/style.css')}}--}}
    @yield('head')
</head>

<body>
<header>

@if(session()->has('usuario_id') ||  (strpos($_SERVER['REQUEST_URI'], 'create') === false) )
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
                    <ul class="nav navbar-nav">
                        <?php $usuario_id = session()->get('usuarios_id'); ;?>
                        <li><a href="valoraciones-ver">Mis Valoraci&oacute;n</a></li>
                        <li><a href="peliculas-ver">Pel&iacute;culas</a></li>
                        <li><a href="log-out">Cerrar Sesi&oacute;n</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    @endif
    @yield('header')
</header>


@include('modales.confirmacion')


<div class="container">
    @yield('body')
</div>

<footer>
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>

    <script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
    <script src="{{ asset('js/funciones.js') }}"></script>
    <script type="text/javscript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @yield('footer')
</footer>
</body>

</html>
