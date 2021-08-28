<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Subscription;
use App\User;

$getUserId = getUserId();

$factory->define(Subscription::class, function (Faker $faker) use ($getUserId) {

    
    $user_id = (int) $getUserId->current();
    $getUserId->next();

    return [
        'user_id' => $user_id,
        'rate_id' => $faker->randomElement([1,3]),
        'status' =>  $faker->randomElement([0,1]),
        'end_at' =>  $faker->dateTimeThisMonth()
    ];
});


function getUserId()
{
    $ids = User::clients()->pluck('id')->toArray();

    for ($i = 0; $i < count($ids); $i++) {
        yield $ids[$i];
    }
}

