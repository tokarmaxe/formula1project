<?php

use Faker\Generator as Faker;

$factory->define(App\Components\Post\Models\Post::class, function (Faker $faker) {
    return [
        'title' => str_random(10),
        'description' => str_random(30),
        'price' => rand(1,100),
        'category_id' => rand(1,10),
        'user_id' => rand(1,10),
        'currency' => 'UAH',
    ];
});
