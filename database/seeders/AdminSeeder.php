<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
               'name'=>'Harry Doe',
             
               'email'=>'admin@gmail.com',
               'type'=>1,
               'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Garry Doe',
               
               'email'=>'admin1@gmail.com',
               'type'=>1,
               'password'=> bcrypt('12345678'),
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
