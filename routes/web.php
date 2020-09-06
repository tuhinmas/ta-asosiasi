<?php

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
Route::middleware('auth')->group(function(){
    Route::view('/','layouts.main');
    Route::view('/404','errors.404');
    Route::view('/500','errors.500');
    Route::view('/mining/data','mining.data');
    Route::view('/mining/grafik','mining.grafik');
    Route::view('/users','user.daftar_user');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route to handle page reload in Vue except for api routes
// Route::get('/{any?}', function (){
//     return view('welcome');
// })->where('any', '^(?!api\/)[\/\w\.-]*');

// Route::get('/{any}', 'API\FronController@index')->where('any', '.*');