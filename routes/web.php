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

Route::any('home', 'UsuariosController@login');
Route::get('log-out', 'UsuariosController@logout');

Route::get('valoracion-remove/{id}', 'ValoracionesController@remove');

Route::get('peliculas-ver', 'PeliculasController@showAll');

Route::get('valoraciones-ver', 'ValoracionesController@loadValoraciones');

Route::get('valoracion-create/{id}', 'ValoracionesController@create');

Route::get('valoracion-show/{id}', 'ValoracionesController@showEdit');
Route::get('valoracion-edit/{id}', 'ValoracionesController@showEdit');

Route::post('valoracion-store/{id}', 'ValoracionesController@store');
Route::patch('valoracion-update/{id}', 'ValoracionesController@update');
