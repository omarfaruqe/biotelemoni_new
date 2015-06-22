@extends('templates.cms')
@section('header')
    <h1>
        File
        <small>Index</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><i class="fa fa-flask"></i> Files</li>
    </ol>
@endsection
@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>All Files</h3>

                    <h3>
                        @if(Auth::user()->can('edit-ingredients'))
                            <a href="{{route('admin.files.create')}}" class="btn btn-primary btn-sm pull-right"><i
                                        class="fa fa-user-plus"></i> Upload</a>
                        @endif
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover dataTable" id="example2" role="grid"
                           aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th>File Name</th>
                            <th>Uploaded By</th>
                            <th>Uploaded At</th>
                            <th style="width:18%">Download count</th>
                            @if(Auth::user()->can('edit-ingredients') || Auth::user()->can('view-ingredients'))
                                <th style="width:18%">Action</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @if(count($file_list)>0)
                            @foreach($file_list as $file)
                                <tr>
                                    <td>
                                        {{$file->name}}
                                    </td>
                                    <td>
                                        {{$file->user->name}}
                                    </td>
                                    <td>
                                        {{$file->created_at}}
                                    </td>
                                    <td>
                                        {{$file->download_counter}}
                                    </td>
                                    <td>
                                        @if(Auth::user()->can('edit-ingredients'))
                                            <a href="{{route('admin.files.download',$file->id)}}"
                                               class="btn btn-info btn-xs"><i
                                                        class="fa fa-eye"></i> Download</a>
                                        @endif

                                        @if(Auth::user()->can('edit-ingredients'))
                                            <a href="{{route('admin.files.delete',$file->id)}}" onclick="return confirm('Are you sure you want to delete this file?');"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">You have no uploaded file</td>
                            </tr>
                        @endif
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>File Name</th>
                            <th>Uploaded By</th>
                            <th>Uploaded At</th>
                            <th>Download count</th>
                            @if(Auth::user()->can('edit-ingredients') || Auth::user()->can('view-ingredients'))
                                <th>Action</th>
                            @endif
                        </tr>
                        </tfoot>
                    </table>
                </div>
                @include('includes.cms.pagination')
            </div>
        </div>
        <!-- /.box-body -->

        {{-- Confirm Delete --}}
        <div class="modal fade" id="modal-file-delete" tabIndex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">Please Confirm</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-lg"></i>
                            Are you sure you want to delete this file?
                        </p>
                    </div>
                    <div class="modal-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="confirm_button" type="button" class="btn btn-danger">
                                <i class="fa fa-times-circle"></i> Yes
                            </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    function delete_file(file_id) {
        $('#modal-file-delete').modal('show');
        $('#confirm_button').on("click", function () {
            var tok = $('#_token').val();

           /* $.ajax({
                url: '{{route('admin.files.delete')}}',
                type: 'POST',
                data: {"id": file_id, "_method":'DELETE','_token':tok},
                dataType: 'JSON',
                success: function(data){
                    console.log(data);
                }
            });*/
            $('#modal-file-delete').modal('hide');
        });
    }
</script>