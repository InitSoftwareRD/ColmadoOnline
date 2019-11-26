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

Auth::routes();

Route::get('/', 'WelcomeController@index')->name('home');

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


Route::middleware(['auth', 'onlyStaff'])->group(function () {
         /* Panel Administrativo */
Route::get('/admin','AdminController@index')->name('inicioAdmin');
Route::get('/salir','AdminController@salir')->name('salir');

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
Route::get('producto/{id}/{status}','ProductsController@Productostatus')->name("productostatus");
Route::get('admin/producto','ProductsController@index')->name('producto');
Route::post('admin/producto','ProductsController@create')->name('crear_producto');
Route::get('admin/editar-producto','ProductsController@Listar')->name('editar-producto');
Route::post('admin/actualizar-producto','ProductsController@update')->name('actualizar-producto');
Route::get('admin/editar-fragment/{id}','ProductsController@mostrar')->name('formulario-fragment');
Route::get('admin/crear-oferta','OfertaController@index')->name('crear-oferta');
Route::post('admin/registrar-oferta','OfertaController@store')->name('registar-oferta');
Route::get('admin/editar-oferta','OfertaController@editarPage')->name('editar-oferta');
Route::get('oferta/{id}/{status}','OfertaController@OfertaEstatus')->name("ofertastatus");


/*Orden*/

Route::get('admin/orden','OrdenarController@index')->name('ordenar');
Route::get('admin/listar_productos','OrdenarController@ListarProducto')->name('listarProductos');
Route::get('admin/listar_clientes','OrdenarController@listarClientes')->name('listarClientes');
Route::post('admin/realizar_orden','OrdenarController@ordenar')->name('realizar_orden');
Route::get('admin/orden_status','OrdenarController@ordenStatus')->name('orden_status');
Route::get('admin/ordenes','OrdenarController@status')->name('status');
Route::post('admin/cambiar_status','OrdenarController@CambiarStatus')->name('cambiar_status');
Route::get('admin/listar_status','OrdenarController@ListarStatus')->name('listar_status');
Route::get('admin/detalle_pedido','OrdenarController@DetallePedido')->name('detalle_pedido');

});

// Route::get('/admin/prueba', function () {
//           dd(rand ( 100000, 999999 ));
// });






