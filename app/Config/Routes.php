<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/* Usuarios */
$routes->match(['get', 'post'], '/', 'Usuario::login', ['as' => 'login', 'filter' => 'noauth']);
$routes->get('logout', 'Usuario::logout', ['as' => 'logout']);
$routes->get('usuario', 'Usuario::index', ['filter' => 'auth']);
$routes->post('usuario/lista', 'Usuario::obtenerData', ['filter' => 'auth']);
$routes->post('usuario/agregar', 'Usuario::agregar', ['filter' => 'super']);
$routes->post('usuario/editar', 'Usuario::editar', ['filter' => 'auth']);
$routes->put('usuario/update', 'Usuario::update', ['filter' => 'auth']);
$routes->post('usuario/borrar', 'Usuario::borrar', ['filter' => 'super']);
$routes->delete('usuario/delete', 'Usuario::delete', ['filter' => 'super']);
/* Home */
$routes->get('home', 'Home::index', ['as' => 'home', 'filter' => 'auth']);
/* Categoria */
$routes->get('categoria', 'Categoria::index', ['filter' => 'auth']);
$routes->post('categoria/lista', 'Categoria::obtenerData', ['filter' => 'auth']);
$routes->post('categoria/agregar', 'Categoria::agregar', ['filter' => 'super']);
$routes->post('categoria/editar', 'Categoria::editar', ['filter' => 'super']);
$routes->put('categoria/update', 'Categoria::update', ['filter' => 'super']);
$routes->post('categoria/borrar', 'Categoria::borrar', ['filter' => 'super']);
$routes->delete('categoria/delete', 'Categoria::delete', ['filter' => 'super']);
/* Persona */
$routes->get('persona', 'Persona::index', ['filter' => 'auth']);
$routes->post('persona/lista', 'Persona::obtenerData', ['filter' => 'auth']);
$routes->post('persona/agregar', 'Persona::agregar', ['filter' => 'super']);
$routes->post('persona/editar', 'Persona::editar', ['filter' => 'super']);
$routes->put('persona/update', 'Persona::update', ['filter' => 'super']);
$routes->post('persona/borrar', 'Persona::borrar', ['filter' => 'super']);
$routes->delete('persona/delete', 'Persona::delete', ['filter' => 'super']);
/* Producto */
$routes->get('producto', 'Producto::index', ['filter' => 'auth']);
$routes->post('producto/lista', 'Producto::obtenerData', ['filter' => 'auth']);
$routes->get('producto/new', 'Producto::new', ['filter' => 'super']);
$routes->post('producto/agregar', 'Producto::agregar', ['filter' => 'super']);
$routes->post('producto/editar', 'Producto::editar', ['filter' => 'super']);
$routes->put('producto/update', 'Producto::update', ['filter' => 'super']);
$routes->post('producto/borrar', 'Producto::borrar', ['filter' => 'super']);
$routes->delete('producto/delete', 'Producto::delete', ['filter' => 'super']);
/* Venta */
$routes->get('venta', 'Venta::index', ['filter' => 'auth']);
$routes->post('venta/detalle', 'Venta::detalle', ['filter' => 'auth']);
$routes->post('venta/lista', 'Venta::obtenerData', ['filter' => 'auth']);
$routes->post('terminar-cancelar', 'Vender::terminarCancelar', ['filter' => 'auth']);
// Vender
$routes->get('vender', 'Vender::index', ['filter' => 'auth']);
$routes->post('get_productos', 'Vender::obtenerProductos', ['filter' => 'auth']);
$routes->post('get_clientes', 'Vender::obtenerClientes', ['filter' => 'auth']);
$routes->post('get_carro', 'Vender::obtenerCarro', ['filter' => 'auth']);
$routes->post('agregar_al_carro', 'Vender::agregarAlCarro', ['filter' => 'auth']);
$routes->post('registrar_venta', 'Vender::registrarVenta', ['filter' => 'auth']);
$routes->delete('quitarProductoDeVenta', 'Vender::quitarProductoDeVenta', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
