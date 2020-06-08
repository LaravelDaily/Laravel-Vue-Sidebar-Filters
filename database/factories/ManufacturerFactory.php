<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Manufacturer;
use Faker\Generator as Faker;

$factory->define(Manufacturer::class, function (Faker $faker) {
    return [
        'name' => $faker->company
    ];
});
