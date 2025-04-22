<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Manager Doe',

               'email'=>'manager@gmail.com',
               'type'=>2,
               'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Garry Doe',

               'email'=>'manager1@gmail.com',
               'type'=>2,
               'password'=> bcrypt('12345678'),
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
