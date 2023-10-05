<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PurchaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('/api/brands', BrandController::class);
Route::apiResource('/api/measurements', CategoryController::class);
Route::apiResource('/api/categories', MeasurementController::class);
Route::apiResource('/api/products', ProductController::class);
Route::apiResource('/api/stocks', StockController::class);
Route::apiResource('/api/purchases', PurchaseController::class);
Route::apiResource('/api/stock-purchases', \App\Http\Controllers\StockPurchaseController::class);
Route::apiResource('/api/sales', \App\Http\Controllers\SaleController::class);
Route::apiResource('/api/stock-sales', \App\Http\Controllers\SaleStockController::class);
Route::apiResource('/api/checkouts', \App\Http\Controllers\CheckoutController::class);
Route::apiResource('/api/checkout-sales', \App\Http\Controllers\CheckoutSaleController::class);
Route::apiResource('/api/checkout-purchases', \App\Http\Controllers\CheckoutPurchaseController::class);
Route::apiResource('api/checkout-activities', \App\Http\Controllers\CheckoutActivityController::class);
Route::apiResource('api/images', \App\Http\Controllers\ImageController::class);
Route::apiResource('api/currencies', \App\Http\Controllers\CurrencyController::class);
Route::apiResource('api/currency-images', \App\Http\Controllers\CurrencyImageController::class);
Route::apiResource('api/suporting-documents', \App\Http\Controllers\SuportingDocumentController::class);
Route::apiResource('api/serie', \App\Http\Controllers\SerieController::class);


