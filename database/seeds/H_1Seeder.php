<?php

use App\Models\Hash1;
use App\Models\Order;
use Illuminate\Database\Seeder;

class H_1Seeder extends Seeder
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
        $n = (2 * $n_item) + 1;

        $data = Order::with('transaksi')
            // ->take(1000)
            ->get();

        // $hash1 = Hash1::orderBY('address')
        //                 ->orderBy('created_at')
        //                 ->get();
        // $hash_1 = Hash1::where('product_id','03204807-94a1-4ffc-a3c3-cb4a1916d3f1')
        //                 ->first();

        //delete duplicate row value

        // $data = DB::table('hash_1')->get();
        // $data = $data->groupBy('mobile_no');
        // foreach ($roles as $key => $value) {
        //     if (count($value) > 1) {
        //         $id = $value[0]->id;
        //         $t = $value->where('id', '!=', $id)->pluck('id');
        //         User::whereIn('id', $t)->delete();
        //     }
        // }

        foreach($data as $dat){
            foreach ($dat->transaksi as $trans) {
                $hash_1 = new Hash1;
                $hash_1->address = $dat->id % $n;
                $hash_1->product_id = $dat->product_id;
                $hash_1->link = $trans->invoice;
                $hash_1->created_at = $trans->created_at;
                $hash_1->updated_at = $trans->updated_at;
                $hash_1->save();
            }
        }
    }
}
