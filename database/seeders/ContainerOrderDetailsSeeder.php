<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContainerOrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('container_order_details')->insert([
            [
                'container_id' => 20,
                'order_id' => 'ORD123456',
                'customer_id' => 1,
                'customer_name' => 'John Doe',
                'customer_email' => 'john.doe@example.com',
                'customer_phone' => '1234567890',
                'payment_status' => 'Paid',
                'order_status' => 'Pack',
                'delivery_date' => '2024-07-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'container_id' => 20,
                'order_id' => 'ORD123458',
                'customer_id' => 2,
                'customer_name' => 'Acme Corp',
                'customer_email' => 'contact@acmecorp.com',
                'customer_phone' => '0987654321',
                'payment_status' => 'Paid',
                'order_status' => 'Ship',
                'delivery_date' => '2024-07-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'container_id' => 20,
                'order_id' => 'ORD123459',
                'customer_id' => 3,
                'customer_name' => 'Global Industries',
                'customer_email' => 'info@globalindustries.com',
                'customer_phone' => '1122334455',
                'payment_status' => 'Paid',
                'order_status' => 'Customs',
                'delivery_date' => '2024-07-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'container_id' => 20,
                'order_id' => 'ORD123460',
                'customer_id' => 4,
                'customer_name' => 'BlueWave Ltd',
                'customer_email' => 'support@bluewave.com',
                'customer_phone' => '6677889900',
                'payment_status' => 'Paid',
                'order_status' => 'Distribution',
                'delivery_date' => '2024-07-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'container_id' => 20,
                'order_id' => 'ORD123461',
                'customer_id' => 5,
                'customer_name' => 'Tech Innovations',
                'customer_email' => 'info@techinnovations.com',
                'customer_phone' => '5544332211',
                'payment_status' => 'Paid',
                'order_status' => 'Delivered',
                'delivery_date' => '2024-07-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
