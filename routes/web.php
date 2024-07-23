<?php

use App\Http\Controllers\FechaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngrController;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VentasController;

Route::get('/home', [HomeController::class,"home"])->name("home.home");

//Rutas interfaz productos
Route::get('/products', [ProductController::class,"gestProducts"])->name("product.gestProducts");
//Ruta añadir nuevo producto
Route::post('/registrar-producto', [ProductController::class,"createProd"])->name("product.createProd");
//Ruta modificar producto
Route::post('/modificar-producto', [ProductController::class,"updateProd"])->name("product.updateProd");
//Ruta eliminar producto
Route::get('/eliminar-producto-{id}', [ProductController::class,"deleteProd"])->name("product.deleteProd");


//Rutas interfaz ingreso de productos
Route::get('/ingresos', [IngrController::class,"ingresoProducts"])->name("ingresos.ingresoProducts");
//Ruta añadir nuevo ingreso
Route::post('/registrar-ingreso', [IngrController::class,"createIngr"])->name("ingresos.createIngr");
//Ruta modificar ingreso
Route::post('/modificar-ingreso', [IngrController::class,"updateIngr"])->name("ingresos.updateIngr");


//Rutas interfaz ventas
Route::get('/ventas', [VentasController::class,"gestVentas"])->name("ventas.gestVentas");
//Ruta añadir nueva venta
Route::post('/registrar-venta', [VentasController::class,"createVenta"])->name("ventas.createVenta");
//Ruta modificar venta
Route::post('/modificar-venta', [VentasController::class,"updateVenta"])->name("ventas.updateVenta");
//Ruta añadir cliente
Route::post('/cliente-venta', [VentasController::class,"añadirCliente"])->name("ventas.añadirCliente");


//Rutas interfaz inventario
Route::get('/inventario', [InventarioController::class,"gestInventario"])->name("inventario.gestInventario");
//Ruta interfaz tabla ingresos
Route::get('/tablaIngreso', [InventarioController::class,"gestInvIngreso"])->name("inventarioIng.gestInvIngreso");
//Ruta interfaz tabla ventas
Route::get('/tablaVenta', [InventarioController::class,"gestInvVenta"])->name("inventarioIng.gestInvVenta");
//Ruta interfaz tabla clientes
Route::get('/tablaClientes', [InventarioController::class,"gestInvClientes"])->name("inventarioIng.gestInvClientes");
//Ruta flitro fecha ingresos
Route::post('/filtroFecha', [InventarioController::class,"filtrarFecha"])->name("filtroFecha.filtrarFecha");
//Ruta flitro fecha ventas
Route::post('/filtroFechaVent', [InventarioController::class,"filtrarFechaVenta"])->name("filtroFechaVent.filtrarFechaVenta");

