<?php

use App\coba;
use App\Models\Order;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;


class OrderofItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::all()->each(function($product){
            $order = new Order;
            $order->product_id = $product->id;
            $order->save();
        });
    }
}