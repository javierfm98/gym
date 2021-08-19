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
            'name' => 'Peso',
        ]);

        Stat::create([
            'name' => '% Grasa corporal',
        ]);
    }
}
