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



Route::get('/admin', function () {
    return view('admin.layout.layout');
})->name('inicio');



Route::get('/', function () {
    return view('front.pages.home');
})->name('inicio');


Route::get('/contacto', function () {
    return view('front.pages.contact');
})->name('contacto');

Route::get('/carrito', function () {
    return view('front.pages.card_single');
})->name('carrito');

Route::get('/order', function () {
    return view('front.pages.order');
})->name('orden');

Route::get('/verificacion', function () {
    return view('front.pages.checkout');
})->name('verificacion');

Route::get('/iniciar', function () {
    return view('front.pages.login');
})->name('iniciar');

Auth::routes();

/*User*/

Route::get('admin/users','UsuarioController@index')->name('user');
Route::post('admin/crear_usuario','UsuarioController@create')->name('crear_usuario');
Route::get('admin/personal','UsuarioController@personal')->name('personal');
Route::get('admin/cliente','UsuarioController@cliente')->name('cliente');
Route::get('status/{id}/{status}','UsuarioController@editStatus')->name('status');
Route::get('status/{id}/{status}','UsuarioController@editStatusCliente')->name('Clientestatus');



