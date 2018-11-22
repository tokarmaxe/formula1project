<?php

use Faker\Generator as Faker;

$factory->define(App\Components\BlackMarketPost\Models\BlackMarketPost::class, function (Faker $faker) {
    return [
        'title' => str_random(10),
        'description' => str_random(30),
        'how_much' => rand(1,100),
        'user_id' => rand(1,10),
        'currency' => 'USD',
    ];
});
 