<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'category_id' => \App\Category::inRandomOrder()->first()->id,
        'description' => $faker->paragraph,
        'price' => rand(1000, 99999)
    ];
});
