<?php

namespace Sugar\Http\Controllers\CMS;

use Illuminate\Support\Facades\Auth;
use Sugar\Http\Requests;
use Sugar\Http\Controllers\Controller;
use Response;
use File;
use Illuminate\Http\Request;
use Sugar\Role;
use Sugar\User;
use View;
use Hash;
use GlideImage;

class UserController extends CmsController {
	/**
	 * The registrar implementation.
	 *
	 * @var \Illuminate\Contracts\Auth\Registrar
	 */

	public function __construct(){
		parent::__construct();
		View::share('section', 'users');
	}

	public function index(){
		$paginator = User::orderby('name')->paginate(20);
		$users = collect($paginator->items());

		$data = compact('paginator', 'users');
		// $data
		return view('cms.users.index', $data);
	}

	/**
	 * @param $user
	 *
	 * @return mixed
	 */
	public function show($user){
		return view('cms.users.show')->with('user',$user);
	}

	public function create(){
		$roles = Role::all(['id','name'])->lists('name','id');
		$selected_role = '';
		$avatar = 0;
		return view('cms.users.create', compact('roles','selected_role','avatar'));
	}

	public function store(Request $request){
		$this->validate($request,
			[
				'name' => 'required|max:255',
				'email' => 'required|email|max:255|unique:users,email',
				'password' => 'required|confirmed|min:6',
			]);
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$role = Role::find($input['role_id']);
		$user = User::create($input);
		// attach the role to user
		$user->roles()->attach($role->id);
		\Session::flash('flash_message', 'User has been created.');
		return redirect('admin/users');
	}

	/**
	 * @param $user
	 *
	 * @return mixed
	 */
	public function edit($user){
		// fetch all roles to set option of select drop-down
		$roles = Role::all(['id','name'])->lists('name','id');
		$selected_role='';
		$avatar = 1;
		foreach($user->roles as $role){
			$selected_role = $role->id;
		}
		return view('cms.users.edit',compact('user','roles','selected_role','avatar'));
	}

	public function update($user, Request $request){
		$input = $request->all();
		$imageName = null;
		$validate_array = [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,'.$user->id
		];

		if($request->file('avatar')) {
			$validate_array['avatar'] = 'required|mimes:jpeg,bmp,png,jpg';
		}

		if(!empty($request['password']))
		{
			$validate_array['password'] = 'required|confirmed|min:6';
			$input['password'] = bcrypt($request['password']);
		}
		else
		{
			unset($input['password']);
			unset($input['password_confirmation']);
		}

		$this->validate($request,$validate_array);

		$result = $this->_updateUserInfo($user, $request, $input);
		if($result == 1)
		{
			\Session::flash('flash_message', 'User has been updated.');
			return redirect('admin/users');
		}
		else
		{
			\Session::flash('error_message', 'There is some problem, User is not updated.');
			return redirect('admin/users/'.$user->id.'/edit');
		}

	}

	public function profile(){
		$user_id = Auth::user()->id;
		$user = User::find($user_id);
		return view('cms.users.profile')->with('user',$user);
	}

	public function editProfile(){
		$user_id = Auth::user()->id;
		$user = User::find($user_id);
		return view('cms.users.profile_edit')->with('user',$user);
	}

	public function updateProfile(Request $request){
		$user = Auth::user();
		$input = $request->all();
		// Required filed in the validate array
		$validation_array = [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,'.Auth::user()->id,
		];
		if( ($request->file('avatar')) && (!empty($request['password'])) )
		{
			if(Hash::check($request['old_password'], $user->password))
			{
				$validation_array['password'] = 'required|confirmed|min:6';
				$validation_array['avatar'] = 'required|mimes:jpeg,bmp,png,jpg';
				$input['password'] = bcrypt($request['password']);
			}
			else
			{
				\Session::flash('error_message', 'Your old password does not match');
				return redirect('admin/profile/edit');
			}
		}
		else if( ($request->file('avatar')) && (empty($request['password'])) )
		{
			$validation_array['avatar'] = 'required|mimes:jpeg,bmp,png,jpg';
			unset($input['password']);
			unset($input['password_confirmation']);
		}
		else if(!empty($request['password']))
		{
			if(Hash::check($request['old_password'], $user->password))
			{
				$validation_array['password'] = 'required|confirmed|min:6';
				$input['password'] = bcrypt($request['password']);
			}
			else
			{
				\Session::flash('error_message', 'Your old password does not match');
				return redirect('admin/profile/edit');
			}
		}
		else
		{
			unset($input['password']);
			unset($input['password_confirmation']);
		}

		$result = $this->_updateUserInfo($user, $request, $input);
		if($result == 1)
		{
			\Session::flash('flash_message', 'Your profile has been updated');
			return redirect('admin/profile');
		}
		else
		{
			\Session::flash('error_message', 'There is some problem, your profile is not updated.');
			return redirect('admin/profile/edit');
		}

	}

	/**
	 * This function will upload the new image and delete the previous one
	 * @param $user
	 * @param $request
	 *
	 * @return string
	 */
	public function _uploadAndDeleteImg($user, $request)
	{
		$fileName=null;
		if($request->hasFile('avatar'))
		{
			$extension = $request->file('avatar')->getClientOriginalExtension(); // getting image extension
			$fileName = time().$user->id.'.'.$extension; // renaming image
			$request->file('avatar')->move(User::avatarPath(), $fileName);
			// delete the previous avatar of this user
			if(!empty($user->avatar))
			{
				File::Delete(User::avatarPath() . $user->avatar);
			}
		}

		return $fileName;
	}

	/**
	 * this function update the user info with avatar upload
	 * @param $user
	 * @param $request
	 * @param $input
	 *
	 * @return null or 1/0
	 */
	private function _updateUserInfo($user, $request, $input)
	{
		$result = null;
		$imageName = $this->_uploadAndDeleteImg($user, $request);
		if(!empty($imageName))
		{
			$input['avatar'] = $imageName;
		}
		$result = $user->update($input);
		if(array_key_exists('role_id',$input))
		{
			$role = Role::find($input['role_id']);
			$user->roles()->sync([$role->id]);
		}

		return $result;
	}
}
