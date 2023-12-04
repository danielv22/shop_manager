<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/checkouts', 'CheckoutController');
Route::post('/product-images/product/{product}', [ProductImageController::class, 'store']);
Route::post('/product-images/product/delete/{productImage}', [ProductImageController::class, 'destroy']);
Route::get('/product-images/product/{product}', [ProductImageController::class, 'show']);
Route::apiResource('/checkout-activities', 'CheckoutActivityController');

