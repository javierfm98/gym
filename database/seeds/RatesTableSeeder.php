<?php

use Illuminate\Database\Seeder;
use App\Rate;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rate::create([
            'name' => 'Mensual',
            'price' => '39',
            'duration' => '1',
        ]);

        Rate::create([
            'name' => 'Trimestral',
            'price' => '35',
            'duration' => '3',
        ]);

        Rate::create([
            'name' => 'Anual',
            'price' => '32',
            'duration' => '12',
        ]);

    }
}

