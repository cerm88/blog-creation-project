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

// Ruta raiz, nos mostrará todos los posts

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/','PageController@posts');

// Ruta para ir al blog y el post seleccionado
Route::get('/blog{post}','PageController@post')->name('post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Ruta de tipo recursos, las rutas priavdas deberían estar en la carpeta Backend/
Route::resource('posts', 'Backend\PostController')
    ->middleware('auth')
    ->except('show'); // No queremos que desde la parte privada nos muestre el método show
