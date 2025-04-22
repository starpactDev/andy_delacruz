<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PotentialCustomer;

class PotentialCustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [

                'full_name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'phone_number' => '(555) 123-4567',
                'address' => '123 Elm Street',
                'city' => 'Springfield',
                'state' => 'IL',
                'zip' => '62704',
               
            ],
            [

                'full_name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'phone_number' => '(555) 987-6543',
                'address' => '456 Oak Avenue',
                'city' => 'Lincoln',
                'state' => 'NE',
                'zip' => '68508',

            ],
            [

                'full_name' => 'Michael Johnson',
                'email' => 'michaeljohnson@example.com',
                'phone_number' => '(555) 555-5555',
                'address' => '789 Maple Road',
                'city' => 'Denver',
                'state' => 'CO',
                'zip' => '80203',

            ],
            [

                'full_name' => 'Emily Davis',
                'email' => 'emilydavis@example.com',
                'phone_number' => '(555) 654-3210',
                'address' => '321 Pine Street',
                'city' => 'Seattle',
                'state' => 'WA',
                'zip' => '98101',

            ],
            [

                'full_name' => 'William Brown',
                'email' => 'williambrown@example.com',
                'phone_number' => '(555) 777-8888',
                'address' => '654 Cedar Drive',
                'city' => 'Austin',
                'state' => 'TX',
                'zip' => '78701',

            ],
        ];

        foreach ($customers as $customer) {
            PotentialCustomer::create($customer);
        }

    }
}
