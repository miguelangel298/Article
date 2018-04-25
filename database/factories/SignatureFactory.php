<?php

use Faker\Generator as Faker;

$factory->define(App\Singature::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'body' => $faker->sentence
    ];
});
