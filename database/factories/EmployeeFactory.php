<?php

use Faker\Generator as Faker;
use App\Model\Campaign;
use App\Model\Team;

$factory->define(App\Model\Employee::class, function (Faker $faker) {
    return [
        'e_id' => $faker->numberBetween(1000, 3000),
        'team_id' => function () {
            return Team::all()->random();
        },
        'full_name' => $faker->name,
        'campaign_id' => function () {
            return Campaign::all()->random();
        },
        'status' => 1
    ];
});
