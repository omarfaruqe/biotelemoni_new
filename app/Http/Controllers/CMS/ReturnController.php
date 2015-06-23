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

class ReturnController extends CmsController {
    
    public function __construct()
    {
        parent::__construct();
        View::share('section', 'return');
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $admin=null;
        foreach(Auth::user()->roles as $role){
            $admin = $role->name;
        }
        if($admin == 'admin')
        {
            $paginator = File::paginate(20);
        }
        else
        {
            $paginator = File::where('user_id', '=', Auth::user()->id)->paginate(20);
        }
        $file_list = collect($paginator->items());
        $data = compact('paginator', 'file_list');
        return view('cms.return.index', $data);
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
