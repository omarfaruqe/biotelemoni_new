<?php

namespace Sugar;

use Illuminate\Database\Eloquent\Model;

class Response extends AppModel {
const RESPONSE_UPLOAD_FILE_DIR = '/files/response_file/';

 public static function uploadResponseFilePath(){
		return public_path() . self::RESPONSE_UPLOAD_FILE_DIR;
	}

protected $table = 'responses';
protected $fillable = ['name', 'user_id', 'download_counter'];


function user() {
    return $this->belongsTo('\Sugar\User');
}

}
