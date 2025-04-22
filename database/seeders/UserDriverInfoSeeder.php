<?php

namespace Database\Seeders;

use App\Models\UserDriverInfo;
use Illuminate\Database\Seeder;

class UserDriverInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDriverInfo::create([
            'user_id' => 2,
            'street' => '123 Main St',
            'city' => 'New York',
            'state' => 'NY',
            'zip' => '10001',
            'team' => 'USA Team',
        ]);

        UserDriverInfo::create([
            'user_id' => 1,
            'street' => '456 Elm St',
            'city' => 'Santo Domingo',
            'state' => 'SD',
            'zip' => '10210',
            'team' => 'Dominican Team',
        ]);
    }
}
