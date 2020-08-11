<?php

use App\Models\CreditCard;
use Illuminate\Database\Seeder;

class CreditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $credit_card = new CreditCard(['holder' => 'holder1', 'make' => 'make1', 'number' => '123456789123', 'expiration_month' => 12, 'expiration_year' => 2030, 'cvv' => 333]);
        $credit_card->save();
        $credit_card = new CreditCard(['holder' => 'holder2', 'make' => 'make2', 'number' => '123456789123', 'expiration_month' => 12, 'expiration_year' => 2030, 'cvv' => 333]);
        $credit_card->save();
    }

}
