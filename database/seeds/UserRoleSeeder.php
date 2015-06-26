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

			$marchant = new Role();
			$marchant->name = Role::MERCHANT;
			$marchant->display_name = 'Merchant';
			$marchant->description = 'Merchant able to upload and modify files.';
			$marchant->save();

			$guest = new Role();
			$guest->name = Role::GUEST;
			$guest->display_name = 'Guest';
			$guest->description = 'Guest able to upload and modify files.';
			$guest->save();

			$roles = collect([$admin, $marchant, $guest])->keyBy('name');



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
			$view_batch_files = new Permission();
			$view_batch_files->name = 'view-batch-files';
			$view_batch_files->display_name = 'View Batch File List';
			$view_batch_files->description = 'Can view batch files index.';
			$view_batch_files->save();
                        
                        $upload_batch_files = new Permission();
			$upload_batch_files->name = 'upload-batch-files';
			$upload_batch_files->display_name = 'Upload Batch';
			$upload_batch_files->description = 'Can upload batch';
			$upload_batch_files->save();
                        
                        //can upload if he is able to delete
			$delete_download_batch_file = new Permission();
			$delete_download_batch_file->name = 'delete-download-batch-files';
			$delete_download_batch_file->display_name = 'Download and Delete batch files';
			$delete_download_batch_file->description = 'Can download and delete batch files.';
			$delete_download_batch_file->save(); 
                        
                        // Response 
                        $view_response_file = new Permission();
			$view_response_file->name = 'view-response-files';
			$view_response_file->display_name = 'View Response File List';
			$view_response_file->description = 'Can only upload response file';
			$view_response_file->save();
                        
                        $upload_response_file = new Permission();
			$upload_response_file->name = 'upload-response-files';
			$upload_response_file->display_name = 'Upload Response File';
			$upload_response_file->description = 'Can only upload response file';
			$upload_response_file->save();
                        
                        $delete_response_file = new Permission();
			$delete_response_file->name = 'delete-response-files';
			$delete_response_file->display_name = 'Delete Response File';
			$delete_response_file->description = 'Can delete response file';
			$delete_response_file->save();
                        
                        
                        $download_response_file = new Permission();
			$download_response_file->name = 'download-response-files';
			$download_response_file->display_name = 'Download Response File';
			$download_response_file->description = 'Can download response file';
			$download_response_file->save();
                        
                        // Return 
                        $view_return_file = new Permission();
			$view_return_file->name = 'view-return-files';
			$view_return_file->display_name = 'View Return File List';
			$view_return_file->description = 'Can only upload return file';
			$view_return_file->save();
                        
                        $upload_return_file = new Permission();
			$upload_return_file->name = 'upload-return-files';
			$upload_return_file->display_name = 'Upload Return File';
			$upload_return_file->description = 'Can only upload return file';
			$upload_return_file->save();
                        
                        $delete_return_file = new Permission();
			$delete_return_file->name = 'delete-return-files';
			$delete_return_file->display_name = 'delete Return File';
			$delete_return_file->description = 'Can delete return file';
			$delete_return_file->save();
                        
                        
                        $download_return_file = new Permission();
			$download_return_file->name = 'download-return-files';
			$download_return_file->display_name = 'Download Return File';
			$download_return_file->description = 'Can download return file';
			$download_return_file->save();
                        
                        // Payout report
                        $view_payout_report = new Permission();
                        $view_payout_report->name = 'view-payout-report';
			$view_payout_report->display_name = 'View Payout Report List';
			$view_payout_report->description = 'Can see the Payout Report';
			$view_payout_report->save();
                        
                        $write_payout_report = new Permission();
                        $write_payout_report->name = 'create-payout-report';
			$write_payout_report->display_name = 'Create Payout Report';
			$write_payout_report->description = 'Can create payout report';
			$write_payout_report->save();
                        
                        $download_payout_report = new Permission();
                        $download_payout_report->name = 'download-payout-report';
			$download_payout_report->display_name = 'Download Payout Report';
			$download_payout_report->description = 'Can download payout report';
			$download_payout_report->save();

			// Assign Permissions to Roles
			$guest->attachPermissions([
				$edit_profile,
                                
				$view_batch_files,
                                $upload_batch_files,
                                $delete_download_batch_file,
                                
                                $view_return_file,
                                $download_return_file,
                                
                                $view_payout_report,
                                $download_payout_report
                                
			]);
			$marchant->attachPermissions([
				$edit_profile,
                                
				$view_batch_files,
                                $upload_batch_files,
				$delete_download_batch_file,
                                
                                $view_response_file,
                                $download_response_file,
                                
                                $view_return_file,
                                $download_return_file,
                                
                                $view_payout_report,
                                $download_payout_report
			]);
			$admin->attachPermissions([
				$edit_profile,
				$view_users,
				$edit_users,
                                
				$view_batch_files,
                                $upload_batch_files,
				$delete_download_batch_file,
                                
                                $view_response_file,
                                $upload_response_file,
                                $delete_response_file,
                                $download_response_file,
                                
                                $view_return_file,
                                $upload_return_file,
                                $download_return_file,
                                $delete_return_file,
                                
                                $view_payout_report,
                                $write_payout_report,
                                $download_payout_report
                                
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
