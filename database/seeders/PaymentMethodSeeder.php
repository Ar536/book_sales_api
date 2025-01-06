<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'name' => 'Credit Card',
            'account_number' => '123456',
            'image' => 'Credit_Card.png'
        ]);
        
        PaymentMethod::create([
            'name' => 'PayPal', 'account_number' => '612532', 'image' => 'PayPal.png'
        ]);
        
        PaymentMethod::create([
            'name' => 'Bank Transfer', 'account_number' => '172816', 'image' => 'Bank_Transfer.png'

        ]);
    }
}
