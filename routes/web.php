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

Route::group(['prefix'=>'api'],function (){
    Route::apiResource('/branches', \App\Http\Controllers\BranchController::class);
    Route::apiResource('/brands', BrandController::class);
    Route::apiResource('/measurements', MeasurementController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/products', ProductController::class);
    Route::get('/stocks/kardex/{product}', [StockController::class, 'kardex']);
    Route::apiResource('/stocks', StockController::class);
    Route::apiResource('/purchases', PurchaseController::class);
    Route::apiResource('/stock-purchases', \App\Http\Controllers\StockPurchaseController::class);
    Route::apiResource('/sales', \App\Http\Controllers\SaleController::class);
    Route::apiResource('/stock-sales', \App\Http\Controllers\SaleStockController::class);
    Route::apiResource('/checkouts', \App\Http\Controllers\CheckoutController::class);
    Route::apiResource('/checkout-sales', \App\Http\Controllers\CheckoutSaleController::class);
    Route::apiResource('/checkout-purchases', \App\Http\Controllers\CheckoutPurchaseController::class);
    Route::apiResource('/checkout-activities', \App\Http\Controllers\CheckoutActivityController::class);
    Route::apiResource('/images', \App\Http\Controllers\ImageController::class);
    Route::apiResource('/currencies', \App\Http\Controllers\CurrencyController::class);
    Route::apiResource('/currency-images', \App\Http\Controllers\CurrencyImageController::class);
    Route::apiResource('/suporting-documents', \App\Http\Controllers\SuportingDocumentController::class);
    Route::apiResource('/serie', \App\Http\Controllers\SerieController::class);
});


