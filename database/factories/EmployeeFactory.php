<?php

use Faker\Generator as Faker;
use App\Model\Campaign;

$factory->define(App\Model\Employee::class, function (Faker $faker) {
    return [
        'emp_id' => $faker->numberBetween(1000, 3000),
        'full_name' => $faker->name,
        'campaign_id' => function () {
            return Campaign::all()->random();
        },
        'status' => 1
    ];
});
