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

Route::get('/', function () {
    return view('layouts/main');
});
Route::get('404',function(){
    return view('errors.404');
});
Route::get('500',function(){
    return view('errors.500');
});

Route::get('mining/data',function(){
    return view('mining.data');
});

Route::get('mining/grafik',function(){
    return view('mining.grafik');
});

Route::get('kasir/stok',function(){
    return view('kasir.stok');
});
Route::get('xxx',function(){
    return view('xxx');
});

Route::get('/users',function(){
    return view('user.daftar_user');
});
Route::get('/cek',function(){
    return view('user.update_user');
});

// Route::get('admin', function () {
    // if (Auth::check()) {
    //     return view('admin');
    // }
    // return view('admin');

// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route to handle page reload in Vue except for api routes
// Route::get('/{any?}', function (){
//     return view('welcome');
// })->where('any', '^(?!api\/)[\/\w\.-]*');

// Route::get('/{any}', 'API\FronController@index')->where('any', '.*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
