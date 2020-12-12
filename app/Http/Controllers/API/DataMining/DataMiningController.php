<?php

namespace App\Http\Controllers\API\DataMining;

use App\Http\Controllers\Controller;
use App\Models\Hash1;
use App\Models\Hash2;
use App\Models\Hash3;
use App\Models\Order;
use App\Models\Transaksi_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        // $data = DB::table('hash_1 as p1')
        //             ->join('hash_1 as p2', 'p1.link', '=', 'p2.link')
        //             ->select('p1.*','p2.product_id as p2_id','p2.address as P2_address','p2.link as link_2')
        //             ->where('p2.address','>',DB::raw('p1.Address'))
        //     ->orderBy('p1.address')
        //     ->orderBy('p2.address')
        //     ->count();
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
        //insert h3
        // $data = DB::table('hash_2 as p1')
        //             ->join('hash_2 as p2', function($join){
        //                     $join->on('p1.link', '=', 'p2.link')
        //                          ->on('p1.product_id_2', '=', 'p2.product_id_1');
        //             })
        //             ->join('orders as or_1','p1.product_id_1','=','or_1.product_id')
        //             ->join('orders as or_2','p1.product_id_2','=','or_2.product_id')
        //             ->join('orders as or_3','p2.product_id_2','=','or_3.product_id')
        //             ->select('p1.*','p2.product_id_1 as p2_1','p2.product_id_2 as p3','or_1.id as order_1','or_2.id as order_2','or_3.id as order_3')
        //             ->where('p2.address','>',DB::raw('p1.Address'))
        //             ->orderBy('p1.product_id_1')
        //             ->orderBy('p1.product_id_2')
        //             ->orderBy('p2.product_id_1')
        //             ->count();
        //             ->take(10)
        //             ->get();

        return response()->json($data);
    }

    public function results_table(Request $request)
    {
        $sup = $request->sup;
        $conf = $request->conf;
        $n_transaksi = Cache::remember('n_transaksi', 24 * 60 * 60, function () {
            return Transaksi_detail::all()->count();
        });

        $plg_rndah = Cache::remember('plg_rndah', 24 * 60 * 60, function () {
            return Hash1::select('hash_1.*', DB::raw('count(*) as sup'))
                ->with('product_1')
                ->groupBY('product_id')
                ->having(DB::raw('count(product_id)'), '=', 1)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        });
        $lvl_1 = Cache::remember('lvl_1' . $sup, 24 * 60 * 60, function () use ($n_transaksi, $sup) {
            return Hash1::select('hash_1.*', DB::raw('count(*) as sup'))
                ->with('product_1')
                ->groupBy('product_id')
                ->having(DB::raw('count(product_id)'), '>', $sup / (100 / $n_transaksi))
                ->orderBy(DB::raw('count(*)'))
            //   ->count();
                ->limit(10)
                ->get();
        });

        $lvl_2 = Cache::remember('lvl_2' . $sup, 24 * 60 * 60, function () use ($n_transaksi, $sup) {
            return Hash2::select('hash_2.*', DB::raw('count(*) as sup'))
                ->with('id_1')
                ->with('id_2')
                ->groupBy('product_id_1')
                ->groupBy('product_id_2')
                ->having(DB::raw('count(*)'), '>', $sup / (100 / $n_transaksi))
                ->orderBy(DB::raw('sup', 'desc'))
                // ->limit(20)
                ->get();
        });

        $lvl_3 = Cache::remember('lvl_3' . $sup, 24 * 60 * 60, function () use ($n_transaksi, $sup) {
            return Hash3::select('hash_3.*', DB::raw('count(*) as sup'))
                ->with('id_1')
                ->with('id_2')
                ->with('id_3')
                ->groupBy('product_id_1')
                ->groupBy('product_id_2')
                ->groupBy('product_id_3')
                ->having(DB::raw('count(*)'), '>', ($sup / (100 / $n_transaksi)))
                ->orderBy(DB::raw('sup', 'desc'))
                // ->limit(20)
                ->get();
        });
        foreach ($lvl_2 as $lv_2) {
            $cnf_2 = Cache::remember('cnf_2' . $lv_2->product_id_1, 24 * 60 * 60, function () use ($lv_2) {
                return hash1::where('product_id', $lv_2->product_id_1)
                    ->count();
            });
            // $cnf_2 = Hash2::where('product_id_1', $lv_2->product_id_1)
            //         ->count();
            $lv_2->conf = ($lv_2->sup / $cnf_2) * 100;
        }
        foreach ($lvl_3 as $lv_3) {
            $cnf_3 = Cache::remember('cnf_3' . $lv_3->product_id_1 . $lv_3->product_id_2, 24 * 60 * 60, function () use ($lv_3) {
                return Hash1::select('hash_1 as p1')
                    ->join('hash_1 as p2','hash_1.link','=','p2.link')
                    ->where('hash_1.product_id', $lv_3->product_id_1)
                    ->where('p2.product_id', $lv_3->product_id_2)
                    ->count();
            });
            // $cnf_3 = Hash3::where('product_id_1', $lv_3->product_id_1)
            //         ->where('product_id_2', $lv_3->product_id_2)
            //         ->count();
            $lv_3->conf = ($lv_3->sup / $cnf_3) * 100;
        }

        $support_2 = [];
        $conf_2 = [];
        $label2 = [];
        $idx = 0;
        foreach ($lvl_2 as $lv2) {
            if ($lv2->conf >= $conf) {
                $label2[$idx] = $lv2->id_1->product_name . ',' . $lv2->id_2->product_name;
                $support_2[$idx] = $lv2->sup / $n_transaksi*100;
                $conf_2[$idx] = $lv2->conf  / 100;
                $idx++;
            }
        };

        $support_3 = [];
        $conf_3 = [];
        $label3 = [];
        $index = 0;
        foreach ($lvl_3 as $lbl) {
            if ($lbl->conf >= $conf) {
                $label3[$index] = $lbl->id_1->product_name . ',' . $lbl->id_2->product_name . ',' . $lbl->id_3->product_name;
                $support_3[$index] = $lbl->sup / $n_transaksi * 100;
                $conf_3[$index] = $lbl->conf /100;
                $index++;
            }
        }
        return response()->json([
            'gak_laku' => $plg_rndah,
            'lvl_1' => $lvl_1,
            'lvl_2' => $lvl_2,
            'lvl_3' => $lvl_3,
            'total_transaksi' => $n_transaksi,
            'label_2' => $label2,
            'label_3' => $label3,
            'support_2' => $support_2,
            'support_3' => $support_3,
            'conf_2' => $conf_2,
            'conf_3' => $conf_3,
        ]);
    }
}
