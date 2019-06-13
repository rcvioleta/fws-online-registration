<?php

use Faker\Generator as Faker;
use App\Model\Campaign;

$factory->define(Campaign::class, function (Faker $faker) {
    return [
        'campaign_name' => $faker->state,
        'status' => 1
    ];
});
