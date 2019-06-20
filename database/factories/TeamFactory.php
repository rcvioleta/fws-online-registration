<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Team::class, function (Faker $faker) {
    return [
        'team_name' => $faker->colorName,
        'status' => 1
    ];
});
