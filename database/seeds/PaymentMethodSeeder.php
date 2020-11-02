<?php

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_method = [
            ['name' => 'Cash', 'description' => 'Bayar tunai'],
            ['name' => 'BRI', 'description' => 'ATM BRI'],
            ['name' => 'BCA', 'description' => 'ATM BCA'],
        ];
        foreach($payment_method as $pm){
            PaymentMethod::create($pm);
        }
    }
}
