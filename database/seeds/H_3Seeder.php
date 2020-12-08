<?php

use App\Models\Hash3;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class H_3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $n_item = Order::count('product_id');
        $order_of_item = Order::all();
        $n = 2237;

//insert h3
        // $data = DB::table('hash_2 as p1')
        //     ->join('hash_2 as p2', function ($join) {
        //         $join->on('p1.link', '=', 'p2.link')
        //             ->on('p1.product_id_2', '=', 'p2.product_id_1');
        //     })
        //     ->join('orders as or_1', 'p1.product_id_1', '=', 'or_1.product_id')
        //     ->join('orders as or_2', 'p1.product_id_2', '=', 'or_2.product_id')
        //     ->join('orders as or_3', 'p2.product_id_2', '=', 'or_3.product_id')
        //     ->select('p1.*', 'p2.product_id_1 as p2_1', 'p2.product_id_2 as p3', 'or_1.id as order_1', 'or_2.id as order_2', 'or_3.id as order_3')
        //     ->where('p2.address', '>', DB::raw('p1.Address'))
        //     ->orderBy('p1.product_id_1')
        //     ->orderBy('p1.product_id_2')
        //     ->orderBy('p2.product_id_1')
        //     ->count();
        // ->take(10)
        // ->get();

//insert h3 default address
        // foreach ($data as $dat) {
        //     $hash_2 = new Hash3;
        //     $hash_2->address = 1;
        //     $hash_2->product_id_1 = $dat->product_id_1;
        //     $hash_2->product_id_2 = $dat->product_id_2;
        //     $hash_2->product_id_3 = $dat->p3;
        //     $hash_2->link = $dat->link;
        //     $hash_2->created_at = $dat->created_at;
        //     $hash_2->updated_at = $dat->updated_at;
        //     $hash_2->save();
        // }
        //update address
        $data = DB::table('hash_3 as h3')
            ->join('orders as or_1', 'h3.product_id_1', '=', 'or_1.product_id')
            ->join('orders as or_2', 'h3.product_id_2', '=', 'or_2.product_id')
            ->join('orders as or_3', 'h3.product_id_3', '=', 'or_3.product_id')
            ->select('h3.*', 'or_1.id as id_1', 'or_2.id as id_2','or_3.id as id_3')
            ->get();

        foreach ($data as $dat) {
            $hash_3 = Hash3::findOrFail($dat->id);
            $hash_3->address = (($dat->id_1 * 100)+($dat->id_2 * 10) + $dat->id_3) % $n;
            $hash_3->save();
        }
    }
}
