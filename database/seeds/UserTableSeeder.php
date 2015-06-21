<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Sugar\Role;
use Sugar\Permission;
use Sugar\User;


class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        Sugar\User::create( [
        'email' => 'admin@admin.com',
        'password' => Hash::make( 'password' ),
        'name' => 'Admin Admin',
        ] );
        
        $user = Sugar\User::all();
        $admin = \Sugar\Role::where('name', '=', 'admin')->first();
        $user[0]->attachRole($admin);
    }

}
