<?php

namespace Sugar;

use Illuminate\Database\Eloquent\Model;

class ReturnFile extends AppModel {
    
    const RETURN_UPLOAD_FILE_DIR = '/files/return_file/';

 public static function uploadReturnFilePath(){
		return public_path() . self::RETURN_UPLOAD_FILE_DIR;
	}
    
    protected $table = 'returns';
    protected $fillable = ['name', 'user_id', 'download_counter'];


  public  function user() {
        return $this->belongsTo('\Sugar\User');
    }

}
