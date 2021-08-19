<?php

use Illuminate\Database\Seeder;
use App\Stat;

class StatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stat::create([
            'name' => 'weight',
            'description' => 'Peso'
        ]);

        Stat::create([
            'name' => 'body_fat',
            'description' => '% Grasa corporal'
        ]);
    }
}
