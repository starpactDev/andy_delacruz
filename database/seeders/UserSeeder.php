<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
               'name'=>'Employee Doe',

               'email'=>'user@gmail.com',
               'type'=>0,
               'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Employee Cruz',

               'email'=>'user1@gmail.com',
               'type'=>0,
               'password'=> bcrypt('12345678'),
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
