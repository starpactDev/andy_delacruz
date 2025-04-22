<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michaelbrown@example.com',
                'phone' => '+1 555-111-2222',
                'address' => '1234 Elm Street',
                'city' => 'Austin',
                'state' => 'TX',
                'zip' => '78701',
                'products' => 'Laptops',
            ],
            [
                'first_name' => 'Susan',
                'last_name' => 'Taylor',
                'email' => 'susantaylor@example.com',
                'phone' => '+1 555-333-4444',
                'address' => '5678 Oak Lane',
                'city' => 'San Francisco',
                'state' => 'CA',
                'zip' => '94107',
                'products' => 'Mobile Phones',
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Johnson',
                'email' => 'robertjohnson@example.com',
                'phone' => '+1 555-555-6666',
                'address' => '9101 Pine Road',
                'city' => 'Miami',
                'state' => 'FL',
                'zip' => '33101',
                'products' => 'Cameras',
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Davis',
                'email' => 'emilydavis@example.com',
                'phone' => '+1 555-777-8888',
                'address' => '1123 Maple Avenue',
                'city' => 'New York',
                'state' => 'NY',
                'zip' => '10001',
                'products' => 'Printers',
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Lee',
                'email' => 'davidlee@example.com',
                'phone' => '+1 555-999-0000',
                'address' => '1415 Cedar Street',
                'city' => 'Chicago',
                'state' => 'IL',
                'zip' => '60601',
                'products' => 'Headphones',
            ],
        ]);
    }
}
