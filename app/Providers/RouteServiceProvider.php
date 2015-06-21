<?php namespace Sugar\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Sugar\Exceptions\API\ModelNotFoundException as ApiNotFound;
use Sugar\Exceptions\CMS\ModelNotFoundException as CmsNotFound;
use Entrust;
use Session;
use Sugar\Product;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'Sugar\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		$router->pattern('page','[1-9][0-9]*');

		$uuid_pattern = '[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}';

		$router->patterns(['date', 'start_date', 'end_date'], '[0-9]{4}-[0-9]{2}-[0-9]{2}');
		$router->pattern('datetime', '[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}');

		// CMS
		$router->filter('role', function($route, $request, $role){
			if(!Entrust::hasRole($role)) {
				Session::flash('message','You do not have permission to perform that operation.');
				Session::flash('alert_type', 'warning');
				return redirect('admin');
			}
		});

		$router->filter('perm', function($route, $request, $perm){
			if(!Entrust::can($perm)) {
				Session::flash('message','You do not have permission to perform that operation.');
				Session::flash('alert_type', 'warning');
				return redirect('admin');
			}
		});



		$cms_model_not_found = function(){
			throw new CmsNotFound('The requested entity was not found.');
		};

		$router->patterns(['cms_file', 'cms_user'], $uuid_pattern);
		$router->model('cms_user','\Sugar\User', $cms_model_not_found);
		$router->model('cms_file','\Sugar\File', $cms_model_not_found);
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
