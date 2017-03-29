<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * command: php artisan migrate --seed
     * @return void
     */
    public function run()
    {
        //
        $role_user = Role::where('name', 'user')->first();
        $role_manager = Role::where('name', 'manager')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->email='user@example.com';
        $user->password=bcrypt('user');
        $user->first_name='Leo';
        $user->last_name='Matsson';
        $user->save();
        //this statement has to be done after user is saved into database
        $user->roles()->attach($role_user); //this statements create a row in user_role table

        $manager = new User();
        $manager->email='manager@example.com';
        $manager->password=bcrypt('manager');
        $manager->first_name='Andy';
        $manager->last_name='Ross';
        $manager->save();
        //this statement has to be done after user is saved into database
        $manager->roles()->attach($role_manager); //this statements create a row in user_role table

        $admin = new User();
        $admin->email='admin@example.com';
        $admin->password=bcrypt('admin');
        $admin->first_name='Alex';
        $admin->last_name='Johansson';
        $admin->save();
        //this statement has to be done after user is saved into database
        $admin->roles()->attach($role_admin); //this statements create a row in user_role table
    }
}
