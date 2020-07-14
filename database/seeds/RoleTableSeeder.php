<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'reader';
        $role->description = 'Reader';
        $role->save();
        $role = new Role();
        $role->name = 'publisher';
        $role->description = 'Publisher';
        $role->save();
        $role = new Role();
        $role->name = 'writer';
        $role->description = 'Writer';
        $role->save();
    }
}
