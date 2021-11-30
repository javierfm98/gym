<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Subscription;
use App\User;
use Carbon\Carbon;

$getUserId = getUserId();
$getPaymentStatus = getPaymentStatus();

$factory->define(Subscription::class, function (Faker $faker) use ($getUserId, $getPaymentStatus) {

    
    $user_id = (int) $getUserId->current();
    $getUserId->next();

    $user_id_pay = (int) $getPaymentStatus->current();
    $getPaymentStatus->next();

   // $startMonth = Carbon::today()->startOfMonth()->toDateString();
    $now = Carbon::today()->toDateString();
    $endMonth = Carbon::today()->endOfMonth()->toDateString();


    return [
        'user_id' => $user_id,
        'rate_id' => $faker->randomElement([1,2,3]),
        'status' =>  $user_id_pay,
        //'end_at' =>  $faker->dateTimeThisMonth()
        'end_at' => $faker->dateTimeBetween($startDate =  $now, $endDate = $endMonth, $timezone = null)

    ];
});


$factory->state(Subscription::class, 'many', function (Faker $faker){

    $idsArray = User::clients()->pluck('id')->toArray();
    $date = Carbon::today()->subMonth()->endOfMonth()->toDateString();

    return [
        'user_id' => $faker->randomElement($idsArray),
        'rate_id' => $faker->randomElement([1,2,3]),
        'status' =>  1,
        'end_at' => $faker->dateTimeBetween($startDate =  '-2 year', $endDate = $date, $timezone = null)        
    ];
});


function getUserId()
{
    $ids = User::clients()->pluck('id')->toArray();

    for ($i = 0; $i < count($ids); $i++) {
        yield $ids[$i];
    }
}

function getPaymentStatus()
{
    $status = User::clients()->pluck('payment_status')->toArray();

    for ($i = 0; $i < count($status); $i++) {
        yield $status[$i];
    }
}

