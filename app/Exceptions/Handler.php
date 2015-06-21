<?php namespace Sugar\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sugar\Exceptions\API\ApiException;
use Sugar\Exceptions\CMS\CmsException;
class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{

		$trace = $e->getTraceAsString();

		if($e instanceof ApiException || mb_strpos($trace, "Sugar\Http\Controllers\API\\") !== false){
			return $this->renderAPI($request, $e);
		}

		if($e instanceof CmsException || mb_strpos($trace, "Sugar\Http\Controllers\CMS\\") !== false){
			return $this->renderCMS($request, $e);
		}

		return parent::render($request, $e);
	}

	/**
	 * Customized error handling for API requests
	 *
	 * returns JSON
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function renderAPI($request, Exception $e){
		$code = 500;
		$message = $e->getMessage();

		if($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException){
			$code = 404;
		}

		//full debugging message for testing
		if(env('APP_DEBUG')){
			return response()->json([
				'result' => 'error',
				'data' => [
					'code' => $code,
					'message' => $message,
					'line' => $e->getLine(),
					'file' => $e->getFile(),
					'trace' => $e->getTrace()
				]
			])->setStatusCode($code);
		}
		//minimal error for live
		else{
			return response()->json([
				'result' => 'error',
				'data' => [
					'code' => $code,
					'message' => $message
				]
			])->setStatusCode($code);
		}
	}

	/**
	 * Customized error handling for CMS requests
	 *
	 * returns cms error page
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function renderCMS($request, Exception $e){
		return parent::render($request, $e);
	}

}
