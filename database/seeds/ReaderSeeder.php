<?php

use App\Models\Finder;
use App\Models\Reader;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User(['name' => 'reader1', 'email' => 'reader1@gmail.com', 'password' => bcrypt('reader1'), 'address' => 'address1', 'phone_number' => '654567543']);
        $reader = new Reader();
        $reader->save();
        $reader->user()->save($user);
        $user->roles()->attach(Role::where('name', 'reader')->first());
    }
}
