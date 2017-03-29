<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_user = new Role();
        $role_user->slug= 'user';
        $role_user->name= 'user';
        $role_user->save();

        $role_manager = new Role();
        $role_manager->slug= 'manager';
        $role_manager->name= 'manager';
        $role_manager->save();

        $role_admin = new Role();
        $role_admin->slug= 'admin';
        $role_admin->name= 'admin';
        $role_admin->save();
    }
}
