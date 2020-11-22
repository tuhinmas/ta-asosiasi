<?php

namespace App\Http\Controllers\API\DataMining;

use App\Models\Hash1;
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;

class DataMiningController extends Controller
{
    public function proses()
    {
        $n_item = Order::count('product_id');
        $order_of_item = Order::all();
        $n = (2 * $n_item) + 1;

        $order_coba = Order::first();
        $hash_1_coba = Hash1::first();
        $order_coba->hash_1()->attach($hash_1_coba->product_id);
        // $data = $order_coba->hash_1;

        // $hash1 = Hash1::orderBY('address')
        //                 ->orderBy('created_at')
        //                 ->get();
        $hash_1 = Hash1::where('product_id','03204807-94a1-4ffc-a3c3-cb4a1916d3f1')
                        ->first();
        
        // foreach($data as $dat){
        //     foreach ($dat->transaksi as $trans) { 
        //         $hash_1 = new Hash1;
        //         $hash_1->address = $dat->id % $n;
        //         $hash_1->product_id = $dat->product_id;
        //         $hash_1->link = $trans->invoice;
        //         $hash_1->created_at = $trans->created_at;
        //         $hash_1->updated_at = $trans->updated_at;
                // $hash_1->save();
        //     }
        // }


        return response()->json($hash_1_coba);
    }
}
