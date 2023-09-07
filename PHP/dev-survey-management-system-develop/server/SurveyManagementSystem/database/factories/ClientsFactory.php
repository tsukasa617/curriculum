<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models;
use Faker\Generator as Faker;

$factory->define(App\Models\clients::class, function (Faker $faker) {
    return [
        //
        'company_name' => $faker->company,
        'department' => $faker->jobTitle,
        'position' => $faker->jobTitle,
        'name' => $faker->name,
        'phone_number' => $faker->phoneNumber,
        'email' => $faker->email,
        'dm' => $faker->boolean,
        'industry_id' => $faker->numberBetween($min =1 ,$max=1),
        'address' => $faker->streetAddress,
        'agent' => $faker->boolean
    ];
});
