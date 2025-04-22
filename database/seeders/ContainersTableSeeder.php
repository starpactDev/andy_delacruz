<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Prepare an array to hold the container data
        $containers = [];

        // Loop through to create names EPG 01 to EPG 20
        for ($i = 1; $i <= 20; $i++) {
            $containers[] = [
                'name' => 'EPG ' . str_pad($i, 2, '0', STR_PAD_LEFT), // Format the name to include leading zeros
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the data into the 'containers' table
        DB::table('containers')->insert($containers);
    }
}
