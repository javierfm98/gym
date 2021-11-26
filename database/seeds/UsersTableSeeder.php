<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Javier',
        	'surname' => 'Fernandez',
        	'username' => 'javier',
        	'email' => 'javier@gmail.com',
        	'role_id' => 1,
            'photo_id' => 1,
        	'password' => bcrypt('123456789'),
            'payment_status' => 1
		]);

        User::create([
            'name' => 'Entrenador',
            'surname' => 'Entrenador',
            'username' => 'entrenador',
            'email' => 'en@gmail.com',
            'role_id' => 2,
            'photo_id' => 1,
            'password' => bcrypt('123456789'),
            'payment_status' => 1
        ]);

        User::create([
            'name' => 'Cliente',
            'surname' => 'Cliente',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'role_id' => 3,
            'photo_id' => 1,
            'password' => bcrypt('123456789'),
            'payment_status' => 1
        ]);

          factory(User::class, 250)->create();
    }
}

