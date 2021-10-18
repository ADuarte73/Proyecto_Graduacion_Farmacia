<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TrackingController;


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


/*
	* Home Controller
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalogo' , [HomeController::class , 'catalogo'])->name('catalogo');
Route::get('/detalle/{id}' , [HomeController::class , 'detalle'])->name('detalle');
Route::post('/agregarproducto' , [HomeController::class , 'agregarproducto'])->name('agregarproducto');
Route::post('/resultado', [HomeController::class, 'buscar_producto'])->name('buscar_producto');


/*
	* Cart Controller
*/
Route::get('/carrito' , [CarritoController::class  	, 'index'])->name('carrito');
Route::post('/cargar_carrito' 	, [CarritoController::class  	, 'cargar_carrito'])->name('cargar_carrito');
Route::post('/eliminar_producto', [CarritoController::class  	, 'eliminar_producto'])->name('eliminar_producto');
Route::post('/cantidad_productos', [CarritoController::class  	, 'cantidad_productos'])->name('cantidad_productos');
Route::post('/total_carrito'	, [CarritoController::class  	, 'total_carrito'])->name('total_carrito');
Route::post('/toolbarcarrito'	, [CarritoController::class  	, 'toolbarcarrito'])->name('toolbarcarrito');
Route::post('/removercarrito'	, [CarritoController::class  	, 'removercarrito'])->name('removercarrito');

/*
	* Login Controller
*/
Route::get('/login' , [LoginController::class , 'index'])->name('login');
Route::get('/cerrar_sesion', [LoginController::class, 'cerrar_sesion'])->name('cerrar_sesion');
Route::post('/login_sesion', [LoginController::class, 'login_sesion'])->name('login_sesion');

/*
	* Admin Controller
*/
Route::get('/home' 	, [AdminController::class, 'index'])->name('admin');
Route::get('/comentarios' 		, [AdminController::class       , 'blog'])->name('admin.comentarios');
Route::get('/obtener_comentarios', [AdminController::class 		, 'obtener_comentarios'])->name('obtener_comentarios');
Route::post('/actualizar_check' , [AdminController::class 		, 'actualizar_check'])->name('actualizar_check');
Route::get('/configuracion'     , [AdminController::class 		, 'configuracion'])->name('admin.configuracion');
Route::post('/cargarlogo'    	, [AdminController::class 		, 'cargarlogo'])->name('cargarlogo');
Route::post('/storeconfig'    	, [AdminController::class 		, 'storeconfig'])->name('storeconfig');


/*
	* Orden Controller
*/
Route::get('/ordenes' , [OrdenController::class 		, 'index'])->name('ordenes');
Route::get('/obtener_ordenes'   , [OrdenController::class 	    , 'obtener_ordenes'])->name('obtener_ordenes');
Route::get('/actualizarorden/{orden}', [OrdenController::class 	, 'actualizarorden'])->name('actualizarorden');
Route::post('/store_orden'		, [OrdenController::class 	    , 'store_orden'])->name('store_orden');


/*
	* Producto Controller
*/
Route::get('/productos' , [ProductoController::class 	, 'index'])->name('admin.productos');
Route::get('/nuevoproducto' 	 , [ProductoController::class 	, 'nuevoproducto'])->name('nuevoproducto');
Route::post('/agregar_producto'  , [ProductoController::class 	, 'agregar_producto'])->name('agregar_producto');
Route::get('/obtener_productos'  , [ProductoController::class 	, 'obtener_productos'])->name('obtener_productos');
Route::get('/editarproducto/{id}', [ProductoController::class 	, 'editarproducto'])->name('editarproducto');
Route::post('/storeproducto'     , [ProductoController::class 	, 'storeproducto'])->name('storeproducto');
Route::get('/eliminarproducto/{id}', [ProductoController::class , 'eliminarproducto'])->name('eliminarproducto');
Route::post('/cargarimagenes'    , [ProductoController::class 	, 'cargarimagenes'])->name('cargarimagenes');
Route::post('/cargarimagenrefe'  , [ProductoController::class 	, 'cargarimagenrefe'])->name('cargarimagenrefe');

/*
	* Blog Controller 
*/
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::post('/agregar_comentario', [BlogController::class , 'agregar_comentario'])->name('agregar_comentario');


/*
	* Nosotros Controller
*/
Route::get('/nosotros' 				, [NosotrosController::class 		, 'index'])->name('nosotros');



/*
	* Contacto Controller
*/
Route::get('/contacto' 		 , [ContactoController::class 	, 'index'])->name('contacto');


/*
	* Checkout Controller
*/
Route::get('/checkout' 			, [CheckoutController::class 	, 'index'])->name('checkout'); 
Route::post('/total_checkout'   , [CheckoutController::class    , 'total_checkout'])->name('total_checkout');
Route::post('/direccion_envio'  , [CheckoutController::class    , 'direccion_envio'])->name('direccion_envio');
Route::get('/pagar'  			, [CheckoutController::class    , 'pagar'])->name('pagar');
Route::get('/pago'   			, [CheckoutController::class    , 'pago'])->name('pago');
Route::get('/orden'   			, [CheckoutController::class    , 'orden'])->name('orden');
Route::get('/generar_orden'     , [CheckoutController::class    , 'generar_orden'])->name('generar_orden');


/*
	Tracking Controller
*/

Route::get('/consulta' 			, [TrackingController::class 	, 'index'])->name('consulta');
Route::post('/tracking' 		, [TrackingController::class 	, 'tracking'])->name('tracking');