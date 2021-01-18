<?php

namespace App\Http\Controllers\API;

use App\User;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaksi;
use App\Models\Transaksi_detail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->name;
        $allProducts = Cache::remember('allProduct', 60 * 60, function () {
            return Product::count();
        });

        $allCustomers = Cache::remember('allCustomers', 60 * 60, function () {
            return Customer::count();
        });

        $allTransaksi = Cache::remember('allTransaksi', 60 * 60, function () {
            return Transaksi_detail::count();
        });

        $transaksi = Cache::remember('transaksi', 60 * 60, function () {
            return Transaksi_detail::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum('total');
        });

        $customer = Cache::remember('customer', 60 * 60, function () {
            return Transaksi_detail::distinct()
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count('customer_id');
        });
        $products = Cache::remember('allTransaksi', 60 * 60, function () {
            return Transaksi::distinct()
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count('product_id');
        });

        return response()->json([
            'allProducts' => $allProducts,
            'allCustomers' => $allCustomers,
            'allTransaksi' => $allTransaksi,
            'transaksi' => $transaksi,
            'customers' => $customer,
            'products' => $products,
            'users' => $user,
        ]);
    }
}
