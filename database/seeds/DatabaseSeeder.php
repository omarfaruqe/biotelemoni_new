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
            'password' => Hash::make( 'Sonartori1.' ),
            'name' => 'Sourav Kumar Mukhopadhyay',
        ] );

        Sugar\User::create( [
            'email' => 'yplo@pyramidpayments.com',
            'password' => Hash::make( 'password' ),
            'name' => 'Yplo',
        ] );



        $users = Sugar\User::all();

        $admin = \Sugar\Role::where('name', '=', 'admin')->first();
        $guest = \Sugar\Role::where('name', '=', 'guest')->first();
        $last = count($users)-1;
        $total_user = count($users);
        $i=0;
        foreach($users as $key=>$user){
            if($user->email == 'admin@biotelemoni.com') {
                $user->attachRole($admin);
            } else{
                $user->attachRole($guest);
            }
        }


    }

}
