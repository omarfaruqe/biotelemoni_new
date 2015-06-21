<?php namespace Sugar;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	const ADMIN = 'admin';
	const MERCHANT = 'merchant';
	const GUEST = 'guest';

	/**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Force Uuids when creating.
     */
	public static function boot(){
		self::creating(function($model){
			$model->{$model->getKeyName()} = (string)\Uuid::uuid4();
		});
	}
}
