<?php

use Faker\Generator as Faker;
use App\Activity;

$factory->define(App\Comment::class, function (Faker $faker) {
    $aid = Activity::all()->random()->id;
    
    return [
        'user_id' => 1,
        'activity_id' => $aid,
        'content' => $faker->text(100),
        'checked' => 1,
    ];
});
