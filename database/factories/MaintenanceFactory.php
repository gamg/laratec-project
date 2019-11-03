<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Maintenance;
use Faker\Generator as Faker;

$factory->define(Maintenance::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2),
        'price' => $faker->randomFloat(2, 10),
    ];
});
