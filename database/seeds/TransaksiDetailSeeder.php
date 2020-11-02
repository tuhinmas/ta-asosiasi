<?php

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
        $id =  'bf5179d1-a353-4f5d-8859-8882ef7dca77'; //admin;
        Transaksi_detail::create([
            'user_id' =>$id,
            'customer_id' => '00b288ae-dfaa-4576-a3a1-27404b3cdee7',
            'invoice' => '179474/KSR/UTM/0620',
            'jumlah_item' => 1,
            'payment_method' => 'e4ac0805-e14e-4ad1-83cd-1a196f126b04',
            'sub_total' => 20000,
            'diskon' => 500,
            'total' => 19500
        ]);
    }
}
