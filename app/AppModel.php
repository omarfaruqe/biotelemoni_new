<?php namespace Sugar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Uuid;
class AppModel extends Model {

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

	public function scopeGetByPage($query, $page = 1, $limit = 20){
		$items = $this->skip($limit * ($page - 1))->take($limit)->get();
		$count = $this->newQuery()->count();
		return new Paginator($items->toArray(), $count, $limit, $page, ['path' ]);
	}

}
