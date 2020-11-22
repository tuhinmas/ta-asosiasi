<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth'], function(){
    Route::apiResources(['users' => 'API\UserController']);
    Route::apiResources(['diskon' => 'API\DiskonController']);
    Route::get('/payment_method','API\PaymentMethodController@index');
});
Route::get('/searchProductForTransaction','API\TransactionController@search');
Route::apiResources(['products' => 'API\ProductController']);
// Route::get('/transaksi/invoice/{invoice}','API\TransactionController@invoice');
Route::apiResources(['transaction' => 'API\TransactionController']);
Route::get('/searchProduct','API\DiskonController@search');
Route::apiResources(['customers' => 'API\CustomerController']);
Route::get('/parameter','MiningController@parameter');
Route::get('/riwayat-transaksi','API\TransactionController@riwayat');
Route::get('/resume-transaksi','API\DashboardController@index');
Route::get('/xxx','API\ProductController@index');

//Data Mining
Route::get('/parameter','API\DataMining\ParameterController@parameter');
Route::get('/order-of-item','API\DataMining\OrderController@index');
Route::get('/total-item','API\DataMining\OrderController@total');
Route::get('/data-train','API\DataMining\DataTrainController@index');
Route::get('/count-data-train','API\DataMining\DataTrainController@countDataTrain');
Route::get('/data-mining','API\DataMining\DataMiningController@proses');