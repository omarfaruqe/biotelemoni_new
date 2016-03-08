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

			$guest = new Role();
			$guest->name = Role::GUEST;
			$guest->display_name = 'Guest';
			$guest->description = 'Guest able to upload and modify files.';
			$guest->save();

			$roles = collect([$admin, $guest])->keyBy('name');



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

			// Batch Files
			$view_files = new Permission();
			$view_files->name = 'view-files';
			$view_files->display_name = 'View File List';
			$view_files->description = 'Can viewh files index.';
			$view_files->save();
                        
            $upload_files = new Permission();
			$upload_files->name = 'upload-files';
			$upload_files->display_name = 'Upload File';
			$upload_files->description = 'Can upload file';
			$upload_files->save();
                        
                        //can upload if he is able to delete
			$delete_file = new Permission();
			$delete_file->name = 'delete-files';
			$delete_file->display_name = 'Delete files';
			$delete_file->description = 'Can delete files.';
			$delete_file->save(); 

			$download_file = new Permission();
			$download_file->name = 'download-files';
			$download_file->display_name = 'Downloadfiles';
			$download_file->description = 'Can download tch files.';
			$download_file->save();
                      

			// Assign Permissions to Roles
			$guest->attachPermissions([
				$edit_profile,    
				$view_files,
				$download_file
			]);

			$admin->attachPermissions([
				$edit_profile,
				$view_users,
				$edit_users,
                                
				$view_files,
                $upload_files,
				$delete_file,
				$download_file
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
