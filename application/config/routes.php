<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//USUARIO
$route['addUsuario'] = 'Usuario/addUsuario';
$route['getUsuarios'] = 'Usuario/getUsuarios';
$route['getCuenta'] = 'Usuario/getCuenta';
$route['addSaldo'] = 'Usuario/addSaldo';

//CATEGORIA
$route['subirFoto'] = 'Categoria/do_upload';
$route['editCat'] = 'Categoria/editarCategoria';
$route['addCategoria'] = 'Categoria/addCategoria';
$route['listaCat'] = 'Categoria/getCategorias';
$route['eliminarCategoria'] = 'Categoria/eliminarCategoria';

//PROVEEDOR
$route['eliminarProveedor'] = 'Proveedor/eliminarPRoveedor';
$route['addProveedor'] = 'Proveedor/addProveedor';
$route['getProveedores'] = 'Proveedor/getProveedores';
$route['editProveedor'] = 'Proveedor/editarProveedor';


//PRODUCTOS
$route['addProducto'] = 'Producto/agregarProducto';
$route['getProductos'] = 'Producto/getProductos';
$route['editProducto'] = 'Producto/editarProducto';
$route['eliminarProducto'] = 'Producto/eliminarProducto';
$route['listaProdCat'] = 'Producto/listaProdCat';
$route['finCompra'] = 'Producto/finCompra';


//MENU CASINO


// VISTAS
$route['agregarSaldo'] = 'Vista/agregarSaldo';
$route['informeProductos'] = 'Vista/informeProductos';
$route['informeUsuarios'] = 'Vista/informeUsuarios';
$route['informeVentas'] = 'Vista/informeVentas';
$route['menuCasino'] = 'Vista/menuCasino';
$route['listaProductos'] = 'Vista/listaProductos';
$route['agregarProducto'] = 'Vista/agregarProducto';
$route['listaProveedores'] = 'Vista/listaProveedores';
$route['agregarProveedor'] = 'Vista/agregarProveedor';
$route['agregarCategoria'] = 'Vista/agregarCategoria';
$route['listaUsuarios'] = 'Vista/listaUsuarios';
$route['agregarUsuario'] = 'Vista/agregarUsuario';
$route['menuAdmin'] = 'Vista/menuAdmin';
$route['menuUser'] = 'Vista/menuUser';


//CONTROL
$route['login-user'] = 'Control/login';
$route['getSession'] = 'Control/getSession';
$route['logout'] = 'Control/logout';
$route['contarUsuarios'] = 'Control/contarUsuarios';
$route['contarProductos'] = 'Control/contarProductos';
$route['contarCategorias'] = 'Control/contarCategorias';
$route['contarVentas'] = 'Control/contarVentas';
$route['contarProveedores'] = 'Control/contarProveedores';
$route['cantidadProdComprados'] = 'Control/cantidadProdComprados';

//INFORMES
$route['getInformeCuentas'] = 'Informe/getInformeCuentas';
$route['getInformeVentas'] = 'Informe/getInformeVentas';
$route['getDetalleCompra'] = 'Informe/getDetalleCompra';
$route['getInformeProductos'] = 'Informe/getInformeProductos';
$route['getInformeProductosCat'] = 'Informe/getInformeProductosCat';
$route['exportarExcel'] = 'Informe/exportarExcel';

$route['default_controller'] = 'control';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
