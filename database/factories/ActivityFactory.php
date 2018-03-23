<?php

use Faker\Generator as Faker;
use App\CommunityDay;
use Carbon\Carbon;

$factory->define(App\Activity::class, function (Faker $faker) {
    $arr = ['sxyl','yxtx','mzy','tgpx','xywh'];
    if (CommunityDay::count()>0) array_push($arr,'zttr');
    $type = array_random($arr);
    if ($type == 'zttr') $cdi = CommunityDay::all()->random()->id;
    else $cdi = null;
    
    $randDay = new Carbon();
    $randDay->addMonths(rand(0,5));
    $randDay->addDays(rand(0,30));
    $randDay->addHours(rand(0,23));
    $randDay->addMinutes(rand(0,59));
    $randDay->addSeconds(rand(0,59));
    return [
        'user_id' => 1,
        'title' => $faker->sentence,
        'content' => '<p>'.$faker->text(200) .'</p><p>'.$faker->text(200) .'</p>', 
        'type' => $type,
        'community_day_id' => $cdi,
        'start_at' => $randDay,
        'check_required' => rand(0,1),
    ];
});
