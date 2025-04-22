<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceiversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('receivers')->insert([
            [
                'sender_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'second_last_name' => 'Smith',
                'nickname' => 'Johnny',
                'email' => 'john.doe@example.com',
                'address' => '123 Main Street',
                'neighborhood' => 'Downtown',
                'city' => 'Metropolis',
                'province' => 'Gotham',
                'reference' => 'Near the park',
                'telephone' => '555-1234',
                'cell' => '555-5678',
                'whatsapp' => '555-8765',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sender_id' => 1,
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'second_last_name' => 'Johnson',
                'nickname' => 'Janey',
                'email' => 'jane.doe@example.com',
                'address' => '456 Elm Street',
                'neighborhood' => 'Uptown',
                'city' => 'Metropolis',
                'province' => 'Gotham',
                'reference' => 'Next to the library',
                'telephone' => '555-2345',
                'cell' => '555-6789',
                'whatsapp' => '555-9876',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sender_id' => 1,
                'first_name' => 'Alice',
                'last_name' => 'Brown',
                'second_last_name' => 'Davis',
                'nickname' => 'Ali',
                'email' => 'alice.brown@example.com',
                'address' => '789 Oak Street',
                'neighborhood' => 'Suburbia',
                'city' => 'Metropolis',
                'province' => 'Gotham',
                'reference' => 'Across from the mall',
                'telephone' => '555-3456',
                'cell' => '555-7890',
                'whatsapp' => '555-8765',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sender_id' => 1,
                'first_name' => 'Bob',
                'last_name' => 'White',
                'second_last_name' => 'Green',
                'nickname' => 'Bobby',
                'email' => 'bob.white@example.com',
                'address' => '101 Pine Street',
                'neighborhood' => 'Old Town',
                'city' => 'Metropolis',
                'province' => 'Gotham',
                'reference' => 'Near the bakery',
                'telephone' => '555-4567',
                'cell' => '555-8901',
                'whatsapp' => '555-7654',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
