<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
                $this->call('UserRoleSeeder');
                $this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        Sugar\User::create( [
            'email' => 'admin@biotelemoni.com',
            'password' => Hash::make( 'Sonartori1.' ),
            'name' => 'Admin Admin',
        ] );

        Sugar\User::create( [
            'email' => 'sourav@biotelemoni.com',
            'password' => Hash::make( 'password' ),
            'name' => 'Sourav Kumar Mukhopadhyay',
        ] );

        Sugar\User::create( [
            'email' => 'yplo@pyramidpayments.com',
            'password' => Hash::make( 'password' ),
            'name' => 'Yplo',
        ] );

        Sugar\User::create( [
            'email' => 'medisure@pyramidpayments.com',
            'password' => Hash::make( 'password' ),
            'name' => 'medisure',
        ] );

        Sugar\User::create( [
            'email' => 'myhealth@pyramidpayments.com',
            'password' => Hash::make( 'password' ),
            'name' => 'myhealth',
        ] );

        Sugar\User::create( [
            'email' => 'john@pyramidpayments.com',
            'password' => Hash::make( 'password' ),
            'name' => 'John',
        ] );


        $users = Sugar\User::all();

        $admin = \Sugar\Role::where('name', '=', 'admin')->first();
        $merchant = \Sugar\Role::where('name', '=', 'merchant')->first();
        $guest = \Sugar\Role::where('name', '=', 'guest')->first();
        $last = count($users)-1;
        $total_user = count($users);
        $i=0;
        foreach($users as $key=>$user){
            if($user->email == 'imran@pyramidpayments.com') {
                $user->attachRole($admin);
            } else if($user->email == 'john@pyramidpayments.com') {
                $user->attachRole($guest);
            } else{
                $user->attachRole($merchant);
            }
        }


    }

}
