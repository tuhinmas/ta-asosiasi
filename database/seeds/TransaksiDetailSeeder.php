<?php

use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use App\Models\Transaksi_detail;
use Illuminate\Support\Facades\Auth;

class TransaksiDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Transaksi::create([
        //     'invoice' => '179474/KSR/UTM/0620',
        //     'product_id' => '0027e986-be40-4858-8031-f48dd4d94e6c',
        //     'product_name' => 'ZINC BTL 340ML GINGSENG',
        //     'qty' => 1,
        // ]);

        // $id =  '829e0629-0fd4-4130-abe2-c7306f0593ae'; //admin
        // Transaksi_detail::create([
        //     'user_id' =>$id,
        //     'customer_id' => '00000f03-5c73-43ef-98d5-e18bd113f899',
        //     'invoice' => '179474/KSR/UTM/0620',
        //     'jumlah_item' => 1,
        //     'payment_method' => '20ec96b5-5d9b-4811-ab55-1deedc6bb8c7',
        //     'sub_total' => 27000,
        //     'diskon' => 0,
        //     'total' => 27000
        // ]);
    }
}
