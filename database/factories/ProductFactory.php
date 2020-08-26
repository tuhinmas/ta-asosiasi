<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'product_name' => $faker->lastName,
        'merk' => $faker->word,
        'harga' => $faker->numberBetween($min=1000, $max = 200000),
    ];
});
