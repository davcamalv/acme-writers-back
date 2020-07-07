<?php

use App\Models\CreditCard;
use App\Models\Role;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Database\Seeder;

class WriterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User(['name' => 'writer1', 'email' => 'writer1@gmail.com', 'password' => bcrypt('writer1'), 'address' => 'address1', 'phone_number' => '654567543']);
        $writer = new Writer();
        CreditCard::all()->first()->writer()->save($writer);
        $writer->save();
        $writer->user()->save($user);
        $user->save();
        $user->roles()->attach(Role::where('name', 'writer')->first());
    }
}
