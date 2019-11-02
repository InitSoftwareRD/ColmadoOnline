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
Route::get('cliente/{id}/{status}','UsuarioController@editStatusCliente')->name('Clientestatus');

/*Product*/

/*Category*/
Route::get('admin/category','ProductsController@category')->name('category');
Route::post('admin/category','ProductsController@create_category')->name('create_category');
Route::get('category/{id}/{status}','ProductsController@categorystatus')->name("categorystatus");
Route::get('admin/producto','ProductsController@index')->name('producto');
Route::post('admin/producto','ProductsController@create')->name('crear_producto');


/*Orden*/

Route::get('admin/orden','OrdenarController@index')->name('ordenar');
Route::get('admin/listar_productos','OrdenarController@ListarProducto')->name('listarProductos');
Route::get('admin/listar_clientes','OrdenarController@listarClientes')->name('listarClientes');
Route::post('admin/realizar_orden','OrdenarController@ordenar')->name('realizar_orden');

// Route::get('/admin/prueba', function () {
//           dd(rand ( 100000, 999999 ));
// });






