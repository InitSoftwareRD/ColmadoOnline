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

Route::get('profile/change-password', 'Auth\LogoutOtherController@index')->name('change_password');
Route::post('logoutOthers', 'Auth\LogoutOtherController@logoutOtherDevices');

Route::get('/contacto', function () {
    return view('front.pages.contact');
})->name('contacto');

Route::get('/iniciar', function () {
    return view('front.pages.login');
})->name('iniciar');

Route::get('carts', 'CartController@index')->name('cart');
Route::post('carts', 'CartController@store')->name('cart.store');
Route::put('carts/{products}', 'CartController@update')->name('cart.update');
Route::delete('carts/{products}', 'CartController@delete')->name('cart.delete');
Route::delete('carts/{products}/http', 'CartController@deleteHTTP')->name('cart.delete.http');
Route::get('carts/delete/all', 'CartController@deleteAll')->name('cart.deleteAll');
Route::get('carts/confirmation', 'CartController@verification')->name('cart.verification');
Route::get('carts/count', 'CartController@cartCount')->name('cart.count');

Route::get('client/order', 'ClientOrderController@index')->name('order');
Route::post('client/order', 'ClientOrderController@store')->name('order.store');
Route::get('client/order/{orders}', 'ClientOrderController@show')->name('order.show');

Route::middleware(['auth', 'onlyStaff'])->group(function () {
    /* Panel Administrativo */
    Route::get('/admin','AdminController@index')->name('inicioAdmin');
    Route::get('/salir','AdminController@salir')->name('salir');

    /* Administracion de usuario */
    Route::get('admin/users','UsuarioController@index')->name('user');
    Route::post('admin/crear_usuario','UsuarioController@create')->name('crear_usuario');
    Route::get('admin/personal','UsuarioController@personal')->name('personal');
    Route::get('admin/cliente','UsuarioController@cliente')->name('cliente');
    Route::get('personal/status/{id}/{status}','UsuarioController@editStatus')->name('Personalstatus');
    Route::get('cliente/{id}/{status}','UsuarioController@editStatusCliente')->name('Clientestatus');
    Route::get('admin/editar-empleado/{id}','UsuarioController@EditEmpleado')->name('editar-empleado');
    Route::get('admin/editar-cliente/{id}','UsuarioController@EditCliente')->name('editar-cliente');
    Route::post('actualizar-empleado','UsuarioController@updateEmpleado')->name('actualizarEmpleado');
    Route::post('actualizar-cliente','UsuarioController@updateCliente')->name('actualizarCliente');

    /* Categorias */
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
    Route::get('admin/oferta-fragment/{id}','OfertaController@edit')->name('oferta-fragment');
    Route::post('admin/oferta-actulizar','OfertaController@update')->name('oferta-actulizar');

    /* Ordenes */
    Route::get('admin/orden','OrdenarController@index')->name('ordenar');
    Route::get('admin/listar_productos','OrdenarController@ListarProducto')->name('listarProductos');
    Route::get('admin/listar_clientes','OrdenarController@listarClientes')->name('listarClientes');
    Route::post('admin/realizar_orden','OrdenarController@ordenar')->name('realizar_orden');
    Route::get('admin/orden_status','OrdenarController@ordenStatus')->name('orden_status');
    Route::get('admin/ordenes','OrdenarController@status')->name('status');
    Route::get('admin/Onlineordenes','OrdenarController@Onlinestatus')->name('Onlinestatus');
    Route::post('admin/cambiar_status','OrdenarController@CambiarStatus')->name('cambiar_status');
    Route::get('admin/listar_status','OrdenarController@ListarStatus')->name('listar_status');
    Route::get('admin/listar_statusOnline','OrdenarController@ListarStatusOnline')->name('listar_statusOnline');
    Route::get('admin/detalle_pedido','OrdenarController@DetallePedido')->name('detalle_pedido');
    Route::get('admin/deliveries','OrdenarController@delivery')->name('deliveries');

    Route::post('admin/asignardelivery','OrdenarController@Asignar_delivery')->name('asignar_delivery');
    Route::get('admin/ordenes_salientes','DeliveryController@OrdenesEntregar')->name('ordenes_saliente');
    Route::get('admin/delivery','DeliveryController@DeliveryPage')->name('delivery');
    Route::get('admin/detalle_envio','DeliveryController@DetallePedido')->name('detalle_envio');
    Route::post('admin/cambiar_envios','DeliveryController@CambiarStatus')->name('cambiar_envios');

    /* gráficos*/
    Route::get('/admin/graficos', 'ChartController@index')->name('graficos');
    Route::post('/admin/ingresos', 'ChartController@getRevenue')->name('ingresos');

    /*Exportar*/

    Route::get('admin/exportar-clientes','UsuarioController@ClientesExport')->name('expotarClientes');
    Route::get('admin/exportar-empleados','UsuarioController@EmpleadosExport')->name('expotarEmpleados');
    Route::get('admin/exportar-productos','ProductsController@ProductosExport')->name('exportarProductos');
    Route::get('admin/exportar-historico','OrdenarController@HistoricoExport')->name('exportarHistorico');
    Route::get('admin/historico','OrdenarController@historico')->name('HistoricoOrdenes');
    Route::get('admin/detalle-historico/{id}','OrdenarController@DetalleHistorico')->name('DetalleHistorico');
    Route::get('admin/cambiar-contrasena','UsuarioController@CambiarPass')->name('CambiarContrasena');
    Route::post('admin/cambiar-pass','UsuarioController@CambiarContrasena')->name('CambiarPass');
    Route::get('admin/imprimir/{id}','OrdenarController@Imprimir')->name('Imprimir');



});
