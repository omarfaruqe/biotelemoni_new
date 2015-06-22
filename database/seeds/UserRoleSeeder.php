<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Sugar\Role;
use Sugar\Permission;
use Sugar\User;

class UserRoleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::transaction(function(){
			// Remember existing user roles
			// This allows us to repopulate the user roles after they are recreated
			$users = User::with(['roles' => function($q){
				$q->select('name');
			}])->get(['id']);

			$old_roles = [];
			foreach ($users as $key => $user) {
				$roles = [];
				foreach ($user->roles as $key => $role) {
					$roles[] = $role->name;
				}
				$old_roles[$user->id] = $roles;
			}


			// Discard old data
			DB::table('roles')->delete();
			DB::table('permissions')->delete();
			DB::table('permission_role')->delete();
			DB::table('role_user')->delete();


			// Create site roles
			$admin = new Role();
			$admin->name = Role::ADMIN;
			$admin->display_name = 'Administrator';
			$admin->description = 'User with full access to site functionality.';
			$admin->save();

			$editor = new Role();
			$editor->name = Role::MERCHANT;
			$editor->display_name = 'Merchant';
			$editor->description = 'Merchant able to upload and modify files.';
			$editor->save();

			$validator = new Role();
			$validator->name = Role::GUEST;
			$validator->display_name = 'Guest';
			$validator->description = 'Guest able to upload and modify files.';
			$validator->save();

			$roles = collect([$admin, $editor, $validator])->keyBy('name');



			// Create site permissions

			// Users
			$edit_profile = new Permission();
			$edit_profile->name = 'edit-profile';
			$edit_profile->display_name = 'Edit Profile';
			$edit_profile->description = 'Can modify own profile';
			$edit_profile->save();

			$view_users = new Permission();
			$view_users->name = 'view-users';
			$view_users->display_name = 'View Users';
			$view_users->description = 'See profile of other users registered on the site.';
			$view_users->save();

			$edit_users = new Permission();
			$edit_users->name = 'edit-users';
			$edit_users->display_name = 'Edit Users';
			$edit_users->description = 'Can add, edit and delete other users. Can assign roles.';
			$edit_users->save();

			// Ingredients
			$view_ingredients = new Permission();
			$view_ingredients->name = 'view-ingredients';
			$view_ingredients->display_name = 'View File List';
			$view_ingredients->description = 'Can view files index.';
			$view_ingredients->save();

			$edit_ingredients = new Permission();
			$edit_ingredients->name = 'edit-ingredients';
			$edit_ingredients->display_name = 'Download and Delete files';
			$edit_ingredients->description = 'Can download and delete.';
			$edit_ingredients->save();


			// Assign Permissions to Roles
			$validator->attachPermissions([
				$edit_profile,
				$view_ingredients
			]);
			$editor->attachPermissions([
				$edit_profile,
				$view_ingredients,
				$edit_ingredients
			]);
			$admin->attachPermissions([
				$edit_profile,
				$view_users,
				$edit_users,
				$view_ingredients,
				$edit_ingredients
			]);

			// Reassign users roles
			foreach ($users as $id => $user) {
				if(!array_key_exists($user->id, $old_roles)){
					continue;
				}
				$user_roles = [];
				foreach ($old_roles[$user->id] as $key => $role_name) {
					if(isset($roles[$role_name]) ){
						$user_roles[] = $roles[$role_name];
					}
				}
				$user->attachRoles($user_roles);
			}

		});

	}

}
