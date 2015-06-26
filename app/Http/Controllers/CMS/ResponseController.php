<?php

namespace Sugar\Http\Controllers\CMS;

use Illuminate\Support\Facades\Auth;
use Sugar\Response as FileResponse;
use Sugar\Http\Requests;
use Sugar\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use View;
use Sugar\User;
use Validator;

class ResponseController extends CmsController {

    public function __construct() {
        parent::__construct();
        View::share('section', 'response');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $paginator = FileResponse::paginate(20);

        $file_list = collect($paginator->items());
        $data = compact('paginator', 'file_list');
        return view('cms.responses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('cms.responses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        
         /*$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
            if(in_array($_FILES['file']['type'],$mimes)){
            die('pass');
            } else {
            die("Sorry, mime type not allowed");
            } */
         
        $input = [];
        if ($request->file('file')) {
            $file = $request->file('file');
            $validator = Validator::make(
            [
            'file' => $file,
            'extension' => strtolower($file->getClientOriginalExtension()),
            ],
            [
            'file' => 'required',
            'extension' => 'required|in:csv,xls',
            ]
            );

            if ($validator->fails()) {
                return redirect('admin/responses/create')
                                ->withErrors($validator)
                                ->withInput();
            }

            $name = time() . '-' . $file->getClientOriginalName();

            $input['name'] = $name;
            $input['user_id'] = Auth::user()->id;
            $path = FileResponse::uploadResponseFilePath();
   
            // Moves file to folder on server
            $file->move($path, $name);
            $input['name'] = $name;
            $input['user_id'] = Auth::user()->id;
            $result = FileResponse::create(['name' => $name,
            'user_id' => Auth::user()->id]);
            \Session::flash('flash_message', 'Response File has been uploaded.');
            return redirect('admin/responses');
        } else {
            \Session::flash('error_message', 'You have to upload a file');
            return redirect('admin/responses/create');
        }
    }
    
    public function delete($file)
    {
        if (!empty($file->name)) {
            $file_path = FileResponse::uploadResponseFilePath() . $file->name;
            if (file_exists($file_path)) {
                unlink(FileResponse::uploadResponseFilePath() . $file->name);
                FileResponse::find($file->id)->delete();
                \Session::flash('flash_message', 'Your File has been deleted');
                return redirect()->route('admin.responses');
            }
            else
            {
                 \Session::flash('error_message', 'Your File has not been deleted');
                return redirect()->route('admin.responses');
            }
        } else {
            \Session::flash('error_message', 'Your file is not deleted');
            return redirect()->route('admin.responses');
        }
    }

    public function download($file)
    {
        $file_name = FileResponse::uploadResponseFilePath(). $file->name;
        //$file_name = public_path() . "/files/response_file/" . $file->name;
        $headers = array(
            'Content-Type: application/csv',
            'Content-Disposition:attachment; filename="test.csv"',
            'Content-Transfer-Encoding:binary',
            'Content-Length:' . filesize($file_name),
        );
        $input['download_counter']=$file->download_counter+1;
        FileResponse::where('id', $file->id)->update(['download_counter' => $file->download_counter+1]);

        return Response::download($file_name, 'output.csv');
    }


}
