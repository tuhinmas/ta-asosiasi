<?php

namespace App\Http\Controllers\API\DataMining;

use App\Models\Hash1;
use App\Models\Hash2;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DataMiningController extends Controller
{
    public function proses()
    {
        $n_item = Order::count('product_id');
        $order_of_item = Order::all();
        $n = (2 * $n_item) + 1;

//inserting h1
        // $data = Order::with('transaksi')
                        // ->count();
                        // ->take(10)
                        // ->get();
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


//delete duplicate hash_1
        // $data = DB::table('hash_1')
        //         ->groupBy('product_id', 'link')
        //         ->havingRaw('count(*) > 1')
        //         //     ->count();
        //         //     ->take(10)
        //         ->get();
        // $dele  = '';
        // foreach ($data as $dat) {
        //     $dele = Hash1::where('product_id', $dat->product_id)
        //                    ->where('link', $dat->link)
        //                    ->first();
        //     $dele->delete();
        // }

//get frequent itemset
        // $data = DB::table('hash_2')
        //             ->select('count(distinct product_id_1, product_id_2)')
        //             ->get();
//update address h2
        // $data = DB::table('hash_2 as h2')
        //         ->join('orders as or_1', 'h2.product_id_1', '=', 'or_1.product_id')
        //         ->join('orders as or_2','h2.product_id_2','=','or_2.product_id')
        //         ->select('h2.*', 'or_1.id as id_1', 'or_2.id as id_2')
        //         ->take(100)
        //         ->get();

//inserting h2
        $data = DB::table('hash_1 as p1')
                    ->join('hash_1 as p2', 'p1.link', '=', 'p2.link')
                    ->select('p1.*','p2.product_id as p2_id','p2.address as P2_address','p2.link as link_2')
                    ->where('p2.address','>',DB::raw('p1.Address'))
                //     ->orderBy('p1.address')
                //     ->orderBy('p2.address')
                    ->count();
                //     ->take(10)
                //     ->get();
        
                // foreach ($data as $dat) {
                //         $hash_2 = new Hash2;
                //         $hash_2->address = (($dat->address * 10) + $dat->p2_address) % $n;
                //         $hash_2->product_id_1 = $dat->product_id;
                //         $hash_2->product_id_2 = $dat->p2_id;
                //         $hash_2->link = $dat->link;
                //         $hash_2->created_at = $dat->created_at;
                //         $hash_2->updated_at = $dat->updated_at;
                        // $hash_2->save();
                //     }

        return response()->json($data);
    }
}
