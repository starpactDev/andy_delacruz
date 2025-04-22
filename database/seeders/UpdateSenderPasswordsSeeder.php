<?php

namespace Database\Seeders;

use App\Models\Sender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UpdateSenderPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sender::whereNull('password')->orWhere('password', '')->update([
            'password' => Hash::make('12345678')
        ]);
    }
}
