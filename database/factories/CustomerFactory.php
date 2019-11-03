<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'id_number' => $faker->unique()->randomNumber(8),
        'email' => $faker->unique()->email,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
    ];
});
