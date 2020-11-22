<?php

namespace App\Http\Controllers\API\DataMining;

use App\Models\Product;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;

class DataTrainController extends Controller
{
    public function index()
    {
        $dataTrain = Transaksi::with('products')
                                ->orderBy('created_at')
                                ->paginate(50);

        return response()->json($dataTrain);
    }

    public function countDataTrain(){
        $jml_train = Transaksi::count('id');
        $jml_item = Product::count('product_id');

        return response()->json([
            'jml_train' => $jml_train,
            'jml_item' => $jml_item
        ]);
    }
}
