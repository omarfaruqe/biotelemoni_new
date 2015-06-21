<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use database\seeds\UserTableSeeder;

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
		// $this->call('ProductCategorySeeder');
		// $this->call('ProductGroupSeeder');
		// $this->call('ProductSeeder');
		// $this->call('IngredientSeeder');
	}

}
