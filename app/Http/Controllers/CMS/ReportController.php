<?php 

namespace Sugar\Http\Controllers\CMS;

use Illuminate\Support\Facades\Auth;
use File;
use Sugar\Report;
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
            $paginator = Report::paginate(20);
            $report_list = collect($paginator->items());
            $data = compact('paginator', 'report_list');
            return view('cms.report.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return view('cms.report.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
            $this->validate($request,
                    [
                            'title' => 'required|max:255',
                            'description' => 'required'
                    ]);
            $input = $request->all();
            $input['description'] = strip_tags($input['description']);
            $input['user_id'] = Auth::user()->id;
            Report::create($input);
            
            \Session::flash('flash_message', 'Payout report has beed created');
            return redirect()->route('admin.reports');
	}
        
        public function edit($report)
        {
            return view('cms.report.edit', compact('report'));
        }


        public function update($report, Request $request)
        {
            $this->validate($request,
                    [
                            'title' => 'required|max:255',
                            'description' => 'required'
                    ]);
            $input = $request->all();
            $input['description'] = strip_tags($input['description']);
            $report->update($input);
            
            \Session::flash('flash_message', 'Report has been updated.');
            return redirect()->route('admin.reports');
        }

        public function download($report)
        {
            \Session::flash('flash_message', 'We will be comming back with download');
            return redirect()->route('admin.reports');
            File::put(public_path().'files/upload/report.txt',$report->description);
            $report['download_counter']=$report->download_counter+1;
            $report->update();

            return Response::download($file_name, 'report.text');
        }
        
        public function show($report)
        {
            return view('cms.report.show',  compact('report'));
        }
	

}
