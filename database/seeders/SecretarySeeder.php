<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SecretarySeeder extends Seeder
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
               'name'=>'Secretary Doe',

               'email'=>'secretary@gmail.com',
               'type'=>3, // Secretary -3
               'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'Garry Secretary',

               'email'=>'secretary1@gmail.com',
               'type'=>3,
               'password'=> bcrypt('12345678'),
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
