<?php

use Illuminate\Support\Facades\App;

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
    Route::view('/','dashboard');
    Route::view('/404','errors.404');
    Route::view('/500','errors.500');

    //Data Mining
    Route::view('/mining/data','mining.data');
    Route::view('/mining/data1','mining.data1');
    Route::view('/mining/grafik','mining.grafik');
    Route::view('/parameter','mining.param');
    Route::view('/order-of-item','mining.order');
    Route::view('/data-train','mining.data');

    Route::view('/produk','kasir.produk');
    Route::view('/stok','kasir.stok');
    Route::view('/diskon','kasir.diskon');
    Route::view('/customer','kasir.customer');
    Route::view('/transaksi','kasir.transaksi');
    Route::view('/transaksi/invoice/{invoice}','kasir.invoice');
    Route::view('/riwayat-transaksi','kasir.riwayatTransaksi');
    Route::view('/report','kasir.report');
    Route::view('/users','user.daftar_user');
});

Route::view('/xxx','orders.index');
Auth::routes();

Route::get('/pdf-transaction-report','PDFReportController@transaksi');

Route::get('/home', 'HomeController@index')->name('home');





















// Route to handle page reload in Vue except for api routes
// Route::get('/{any?}', function (){
//     return view('welcome');
// })->where('any', '^(?!api\/)[\/\w\.-]*');

// Route::get('/{any}', 'API\FronController@index')->where('any', '.*');