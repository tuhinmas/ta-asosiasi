<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use App\Models\Transaksi;
use Faker\Generator as Faker;

$factory->define(Transaksi::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'invoice' => $faker->word,
        'product_id' => factory(Product::class)->create()->id,
        'product_name' => factory(Product::class)->create()->product_name,
        'qty' => $faker->numberBetween($min=1, $max = 10),
    ];
});
