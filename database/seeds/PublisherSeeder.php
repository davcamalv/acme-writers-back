<?php

use App\Models\CreditCard;
use App\Models\Publisher;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User(['name' => 'publisher1', 'email' => 'publisher1@gmail.com', 'password' => bcrypt('publisher1'), 'address' => 'address1', 'phone_number' => '654567543']);
        $publisher = new Publisher(['VAT'=>'VAT1', 'comercial_name' => 'comercial_name1']);
        CreditCard::all()->skip(1)->first()->publisher()->save($publisher);
        $publisher->save();
        $publisher->user()->save($user);
        $user->save();
        $user->roles()->attach(Role::where('name', 'publisher')->first());
    }
}
