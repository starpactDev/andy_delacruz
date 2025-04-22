<?php

namespace Database\Seeders;

use App\Models\BusinessExpense;
use Illuminate\Database\Seeder;

class BusinessExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expenses = [
            [
                'date_of_payment' => '2025-01-01',
                'payment_method' => 'Credit Card',
                'paid_to' => 'John Doe',
                'description' => 'Office Supplies Purchase',
                'paid_amount' => 150.00,
                'running_total' => 150.00,
            ],
            [
                'date_of_payment' => '2025-01-02',
                'payment_method' => 'Bank Transfer',
                'paid_to' => 'Jane Smith',
                'description' => 'Utility Bill Payment',
                'paid_amount' => 200.00,
                'running_total' => 350.00,
            ],
            [
                'date_of_payment' => '2025-01-03',
                'payment_method' => 'Cash',
                'paid_to' => 'Office Depot',
                'description' => 'Furniture Purchase',
                'paid_amount' => 500.00,
                'running_total' => 850.00,
            ],
        ];

        foreach ($expenses as $expense) {
            BusinessExpense::create($expense);
        }
    }

}

