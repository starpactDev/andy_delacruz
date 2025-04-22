<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('senders')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@example.com',
                'street_address' => '123 Elm Street',
                'apt' => '4B',
                'city' => 'Springfield',
                'state' => 'IL',
                'zip' => '62704',
                'telephone' => '(555) 123-4567',
                'cell' => '(555) 765-4321'
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'janesmith@example.com',
                'street_address' => '456 Oak Avenue',
                'apt' => '12A',
                'city' => 'Lincoln',
                'state' => 'NE',
                'zip' => '68508',
                'telephone' => '(555) 987-6543',
                'cell' => '(555) 543-9876'
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michaeljohnson@example.com',
                'street_address' => '789 Maple Road',
                'apt' => '7C',
                'city' => 'Denver',
                'state' => 'CO',
                'zip' => '80203',
                'telephone' => '(555) 555-5555',
                'cell' => '(555) 555-6666'
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Davis',
                'email' => 'emilydavis@example.com',
                'street_address' => '321 Pine Street',
                'apt' => '2D',
                'city' => 'Seattle',
                'state' => 'WA',
                'zip' => '98101',
                'telephone' => '(555) 654-3210',
                'cell' => '(555) 123-0987'
            ],
            [
                'first_name' => 'William',
                'last_name' => 'Brown',
                'email' => 'williambrown@example.com',
                'street_address' => '654 Cedar Drive',
                'apt' => '9E',
                'city' => 'Austin',
                'state' => 'TX',
                'zip' => '78701',
                'telephone' => '(555) 777-8888',
                'cell' => '(555) 888-9999'
            ],
        ]);
    }
}
