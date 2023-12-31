<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getproductos',[ProductoController::class,'index']);
Route::post('/searchProductos',[ProductoController::class,'searchProducto']);
Route::post('/guardarProductos',[ProductoController::class,'store']);
Route::get('/exportarProductos',[ProductoController::class,'export']);