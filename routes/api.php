<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\PurchaseController;

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

//Rutas de proveedor
Route::get('provider/products', [ProviderController::class, 'getProducts']);
Route::apiResource('provider', ProviderController::class);

//Rutas de Producto
Route::apiResource('product', ProductController::class);

//Rutas de manejo de Stock
Route::controller(StockController::class)->group(function () {
    Route::get('stock/check/{stock:product_id}', 'checkStock');
    Route::get('stock/{stock:product_id}', 'getStock');
    Route::patch('stock/{stock:product_id}', 'setStock');
    Route::patch('stock/modify/{stock:product_id}', 'modifyStock');
});
