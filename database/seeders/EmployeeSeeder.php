<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@example.com',
                'phone_number' => '(555) 123-4567',
                'job_position' => 'US Manager',
                'street_address' => '123 Elm Street',
                'city' => 'Springfield',
                'state' => 'IL',
                'zip_code' => '62701',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'janesmith@example.com',
                'phone_number' => '(555) 987-6543',
                'job_position' => 'RD Manager',
                'street_address' => '456 Oak Avenue',
                'city' => 'Lincoln',
                'state' => 'NE',
                'zip_code' => '68508',
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michaeljohnson@example.com',
                'phone_number' => '(555) 555-5555',
                'job_position' => 'US Sub-Manager',
                'street_address' => '789 Maple Road',
                'city' => 'Denver',
                'state' => 'CO',
                'zip_code' => '80202',
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Davis',
                'email' => 'emilydavis@example.com',
                'phone_number' => '(555) 654-3210',
                'job_position' => 'RD Sub-Manager',
                'street_address' => '321 Pine Street',
                'city' => 'Seattle',
                'state' => 'WA',
                'zip_code' => '98101',
            ],
            [
                'first_name' => 'William',
                'last_name' => 'Brown',
                'email' => 'williambrown@example.com',
                'phone_number' => '(555) 777-8888',
                'job_position' => 'US Supervisor',
                'street_address' => '654 Cedar Drive',
                'city' => 'Austin',
                'state' => 'TX',
                'zip_code' => '78701',
            ]
        ]);
    }
}
