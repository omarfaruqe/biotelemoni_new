<?php

namespace Sugar\Http\Controllers\CMS;

use Sugar\Http\Requests;
use Sugar\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use Sugar\Product;
use Auth;
use View;

class CmsController extends Controller {

	public function __construct(){
		View::share('section', 'files');
	}

	public function dashboard(){
			//die('kjjhks');
              //return redirect('admin/files');
            return view('cms.dashboard.dashboard');
	}

	public function styleGuide(){
		return view('cms.styleguide.styleguide');
	}

}
