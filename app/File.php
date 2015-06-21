<?php namespace Sugar;

use Illuminate\Database\Eloquent\Model;

class File extends AppModel {

    protected $table = 'files';
	protected $fillable = ['name','user_id','download_counter'];

    public function user()
    {
        return $this->belongsTo('\Sugar\User');
    }

}
