<?php

namespace App\Http\Controllers\API;

use App\User;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Transaksi_detail;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $user = User::count();
        $allProducts = Product::count();
        $allCustomers = Customer::count();
        $allTransaksi = Transaksi_detail::count();

        $transaksi = Transaksi_detail::whereYear('created_at',Carbon::now()->year)
                               ->whereMonth('created_at',Carbon::now()->month)
                               ->sum('total');
        $customer = Transaksi_detail::distinct()
                               ->whereYear('created_at',Carbon::now()->year)
                               ->whereMonth('created_at',Carbon::now()->month)
                               ->count('customer_id');
        $products = Transaksi::distinct()
                               ->whereYear('created_at',Carbon::now()->year)
                               ->whereMonth('created_at',Carbon::now()->month)
                               ->count('product_id');

        return response()->json([
            'allProducts' => $allProducts,
            'allCustomers' => $allCustomers,
            'allTransaksi' => $allTransaksi,
            'transaksi' => $transaksi,
            'customers' => $customer,
            'products' => $products,
            'users' => $user
        ]);
    }
}
