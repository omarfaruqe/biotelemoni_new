<?php 
namespace Sugar;

use Illuminate\Database\Eloquent\Model;

class File extends AppModel {
    
    const UPLOAD_BATCH_FILE_DIR = '/files/batch_file/';
     public static function uploadBatchFilePath(){
		return public_path() . self::UPLOAD_BATCH_FILE_DIR;
	}
    protected $table = 'files';
    protected $fillable = ['name','user_id','download_counter','status'];

    public function user()
    {
        return $this->belongsTo('\Sugar\User');
    }

}
