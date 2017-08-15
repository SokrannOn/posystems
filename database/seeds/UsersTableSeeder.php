<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_superuser = new User;
        $user_superuser->nameDisplay = 'Camofts';
        $user_superuser->sex = '1';
        $user_superuser->name = 'camsofts';
        $user_superuser->email = 'camsofts@gmail.com';
        $user_superuser->password = bcrypt('camsofts');
        $user_superuser->contactNum = '';
        $user_superuser->brand = '';
        $user_superuser->is_log = 0;
        $user_superuser->position_id = 1;
        $user_superuser->zone_id = 0;
        $user_superuser->userStatus = 0;
        $user_superuser->save();

        $user_admin = new User;
        $user_admin->nameDisplay = 'Administrator';
        $user_admin->sex = '1';
        $user_admin->name = 'admin';
        $user_admin->email = 'admin@gmail.com';
        $user_admin->password = bcrypt('admin');
        $user_admin->contactNum = '';
        $user_admin->brand = '';
        $user_admin->is_log = 0;
        $user_admin->position_id = 2;
        $user_admin->zone_id = 0;
        $user_admin->userStatus = 0;
        $user_admin->save();

    }
}
