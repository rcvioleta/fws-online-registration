<?php

use Faker\Generator as Faker;
use App\Model\Event;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'event_name' => $faker->streetName,
        'year' => now()->year
    ];
});
