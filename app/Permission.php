<?php namespace Sugar;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
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
