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
});
Route::apiResources(['products' => 'API\ProductController']);
Route::apiResources(['diskon' => 'API\DiskonController']);
Route::apiResources(['customers' => 'API\CustomerController']);
Route::apiResources(['transaction' => 'API\TransactionController']);
Route::get('/payment_method','API\PaymentMethodController@index');
Route::get('/searchProduct','API\DiskonController@search');
Route::get('/searchProductForTransaction','API\TransactionController@search');
Route::get('/xxx','API\ProductController@index');






// Route::post('/register', 'API\AuthController@register');
// Route::post('/login', 'API\AuthController@login');
// Route::get('/me', 'API\AuthController@me');
// Route::post('/logout', 'API\AuthController@logout');
