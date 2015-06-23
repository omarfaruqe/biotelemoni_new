<?php 

namespace Sugar\Http\Controllers\CMS;

use Illuminate\Support\Facades\Auth;
use Sugar\File;
use Sugar\Http\Requests;
use Sugar\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use View;
use Sugar\User;
use Validator;

class ReportController extends CmsController {
        
    public function __construct()
    {
        parent::__construct();
        View::share('section', 'report');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	

}
