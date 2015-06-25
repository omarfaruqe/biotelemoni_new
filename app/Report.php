<?php

namespace Sugar;

use Illuminate\Database\Eloquent\Model;

class Report extends AppModel {
    
    protected $table = 'reports';
    protected $fillable = ['title', 'description', 'user_id', 'download_counter'];

    public

    function user() {
        return $this->belongsTo('\Sugar\User');
    }

}
