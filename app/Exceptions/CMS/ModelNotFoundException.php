<?php

namespace Sugar\Exceptions\CMS;

use Illuminate\Database\Eloquent\ModelNotFoundException as BaseException;

class ModelNotFoundException extends BaseException implements CmsException{

}
