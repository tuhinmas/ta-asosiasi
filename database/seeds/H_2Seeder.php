<?php

use App\Models\Hash1;
use App\Models\Hash2;
use App\Models\Order;
use Illuminate\Database\Seeder;

class H_2Seeder extends Seeder
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
        $n = 36153;
//get frequent itemset
        // $fi = DB::table('hash_2')
        //             ->select('count(distinct product_id_1, product_id_2)')
        //             ->get();
        // $data = DB::table('hash_1 as p1')
        //     ->join('hash_1 as p2', 'p1.link', '=', 'p2.link')
        //     ->select('p1.*', 'p2.product_id as p2_id', 'p2.address as p2_address', 'p2.link as link_2')
        //     ->whereRaw('p2.address > p1.Address')
            // ->orderBy('p1.address')
            // ->orderBy('p2.address')
            // ->take(500)
            // ->get();
        
    //update hash 2 id duplicate
        // $data = DB::table('hash_2 as h2')
        //         ->join('orders as or_1', 'h2.product_id_1', '=', 'or_1.product_id')
        //         ->join('orders as or_2','h2.product_id_2','=','or_2.product_id')
        //         ->select('h2.*', 'or_1.id as id_1', 'or_2.id as id_2')
        //         // ->take(100)
        //         ->get();

//inserting h2
        // $data = DB::table('hash_1 as p1')
        //             ->join('hash_1 as p2', 'p1.link', '=', 'p2.link')
        //             ->select('p1.*','p2.product_id as p2_id','p2.address as P2_address','p2.link as link_2')
        //             ->where('p2.address','>',DB::raw('p1.Address'))
                    // ->orderBy('p1.address')
                    // ->orderBy('p2.address')
                    // ->count();
                    // ->take(10)
                    // ->get();
//update address
      $data = DB::table('hash_2 as h2')
                ->join('orders as or_1', 'h2.product_id_1', '=', 'or_1.product_id')
                ->join('orders as or_2','h2.product_id_2','=','or_2.product_id')
                ->select('h2.*', 'or_1.id as id_1', 'or_2.id as id_2')
                // ->take(100)
                ->get();  
        foreach ($data as $dat) {
            $hash_2 = Hash2::findOrFail($dat->id);
            $hash_2->address = ($dat->id_1 * 100 + $dat->id_2) % $n;
            // $hash_2->product_id_1 = $dat->product_id;
            // $hash_2->product_id_2 = $dat->p2_id;
            // $hash_2->link = $dat->link;
            // $hash_2->created_at = $dat->created_at;
            // $hash_2->updated_at = $dat->updated_at;
            $hash_2->save();
        }
    }
}
