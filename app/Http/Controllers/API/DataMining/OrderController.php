<?php

namespace App\Http\Controllers\API\DataMining;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        // $order = Order::all();
        // $order = $order->product;
        $order = Order::with('products')
                        ->orderBy('product_id')
                        ->paginate(30);

        return response()->json($order);

    }
    public function total(){
        $total = Product::count('product_id');

        return response()->json($total);
    }
}
