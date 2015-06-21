<?php

namespace Sugar\Exceptions\API;

use Illuminate\Database\Eloquent\ModelNotFoundException as BaseException;

class ModelNotFoundException extends BaseException implements ApiException{

}
