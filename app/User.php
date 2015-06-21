<?php namespace Sugar;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Zizaco\Entrust\Contracts\EntrustUserInterface;
use Sugar\Permission;

class User extends AppModel implements AuthenticatableContract, CanResetPasswordContract, EntrustUserInterface {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

	const AVATAR_DIR = '/files/avatar/';
        const UPLOAD_FILE_DIR = '/files/upload/';
       
	public static function avatarPath(){
		return public_path() . self::AVATAR_DIR;
	}
        
       public static function uploadFilePath(){
		return public_path() . self::UPLOAD_FILE_DIR;
	}
        
        

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password','avatar'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function permissions(){
		$this->roles->load('perms');
		$perms = [];

		foreach ($this->roles as $key => $role) {
			foreach ($role->perms as $key => $perm) {
				if(!array_key_exists($perm->id, $perms)){
					$perms[$perm->id] = $perm;
				}
			}
		}
		return collect($perms)->sortBy('display_name')->values();

	}

	public function getAvatarPathAttribute(){
		if(!empty($avatar)){
			return public_path().static::AVATAR_DIR.$this->avatar;
		}

		return null;
	}

	public function getAvatarURLAttribute(){
		if(!empty($this->avatar)){
			return asset(static::AVATAR_DIR.$this->avatar);
		}
		return null;
	}

    public function files()
    {
        return $this->hasMany('\Sugar\File');
    }
}
