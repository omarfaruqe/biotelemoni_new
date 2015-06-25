<?php

namespace Sugar\Http\Controllers\CMS;

use Illuminate\Support\Facades\Auth;
use Sugar\ReturnFile;
use Sugar\Http\Requests;
use Sugar\Http\Controllers\Controller;
use Response;
use Illuminate\Http\Request;
use View;
use Sugar\User;
use Validator;

class ReturnController extends CmsController {

    public function __construct() {
        parent::__construct();
        View::share('section', 'return_file');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $paginator = ReturnFile::paginate(20);

        $file_list = collect($paginator->items());
        $data = compact('paginator', 'file_list');
        return view('cms.returns.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('cms.returns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
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
            $path = ReturnFile::uploadReturnFilePath();

            // Moves file to folder on server
            $file->move($path, $name);
            $input['name'] = $name;
            $input['user_id'] = Auth::user()->id;
            $result = ReturnFile::create(['name' => $name,
            'user_id' => Auth::user()->id]);
            \Session::flash('flash_message', 'Response File has been uploaded.');
            return redirect()->route('admin.returns');
        } else {
            \Session::flash('error_message', 'You have to upload a file');
            return redirect('admin/returns/create');
        }
    }
    
    public function delete($file)
    {
        if (!empty($file->name)) {
            $file_path = ReturnFile::uploadReturnFilePath() . $file->name;
            if (file_exists($file_path)) {
                unlink(User::uploadFilePath() . $file->name);
                File::find($file->id)->delete();
                \Session::flash('flash_message', 'Your File has been deleted');
                return redirect('admin.responses');
            }
            else
            {
                 \Session::flash('error_message', 'Your File has not been deleted');
                return redirect('admin.responses');
            }
        } else {
            \Session::flash('error_message', 'Your file is not deleted');
            return redirect()->route('admin.responses');
        }
    }

    public function download($file)
    {
        $file_name = ReturnFile::uploadReturnFilePath(). $file->name;
        //$file_name = public_path() . "/files/response_file/" . $file->name;
        $headers = array(
            'Content-Type: application/csv',
            'Content-Disposition:attachment; filename="test.csv"',
            'Content-Transfer-Encoding:binary',
            'Content-Length:' . filesize($file_name),
        );
        $input['download_counter']=$file->download_counter+1;
        ReturnFile::where('id', $file->id)->update(['download_counter' => $file->download_counter+1]);

        return Response::download($file_name, 'output.csv');
    }

}
