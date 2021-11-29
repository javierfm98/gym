<?php

use Illuminate\Database\Seeder;
use App\Subscription;
use App\User;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ids = User::clients()->pluck('id')->toArray();
        $number = count($ids);

        factory(Subscription::class, $number)->create();
        factory(Subscription::class, 250)->states('many')->create();
    }
}


