<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::any('home', 'UsuariosController@loginUsuario');

Route::get('valoracion-show/{id}', 'ValoracionesController@show');
Route::get('valoracion-edit/{id}', 'ValoracionesController@edit');
Route::get('valoracion-remove/{id}', 'ValoracionesController@remove');

Route::get('ver-peliculas', 'PeliculasController@showAll');

Route::get('ver-valoraciones', 'ValoracionesController@loadValoraciones');

Route::get('valoracion-create/{id}', 'ValoracionesController@create');
Route::get('valoracion-edit/{id}', 'ValoracionesController@create');

Route::post('valoracion-store', 'ValoracionesController@store');

