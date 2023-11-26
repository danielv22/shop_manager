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
    Route::post('/login', 'UserController@login');
    Route::apiResource('/users', 'UserController');
    Route::apiResource('/branches', 'BranchController');
    Route::apiResource('/brands', 'BrandController');
    Route::apiResource('/measurements', 'MeasurementController');
    Route::apiResource('/categories', 'CategoryController');
    Route::apiResource('/products', 'ProductController');
    Route::apiResource('/stocks', 'StockController');
    Route::apiResource('/purchases', 'PurchaseController');
    Route::apiResource('/stock-purchases', 'StockPurchaseController');
    Route::apiResource('/sales', 'SaleController');
    Route::apiResource('/stock-sales', 'SaleStockController');
    Route::apiResource('/checkouts', 'CheckoutController');
    Route::apiResource('/checkout-sales', 'CheckoutSaleController');
    Route::apiResource('/checkout-purchases', 'CheckoutPurchaseController');
    Route::apiResource('/checkout-activities', 'CheckoutActivityController');
    Route::apiResource('/images', 'ImageController');
    Route::apiResource('/currencies', 'CurrencyController');
    Route::apiResource('/currency-images', 'CurrencyImageController');
    Route::apiResource('/suporting-documents', 'SuportingDocumentController');
    Route::apiResource('/serie', 'SerieController');
});


