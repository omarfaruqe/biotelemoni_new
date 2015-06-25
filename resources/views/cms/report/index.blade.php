@extends('templates.cms')
@section('header')
    <h1>
        Payout Report
        <small>Index</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><i class="fa fa-file-text"></i>  Payout Report </li>
    </ol>
@endsection
@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>All Payout Report</h3>

                    <h3>
                        @if(Auth::user()->can('create-payout-report'))
                            <a href="{{route('admin.reports.create')}}" class="btn btn-primary btn-sm pull-right"><i
                                        class="fa fa-file-archive-o"></i> Create Report</a>
                        @endif
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover dataTable" id="example2" role="grid"
                           aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th style="width:18%">Download count</th>
                            @if(Auth::user()->can('download-payout-report'))
                                <th style="width:18%">Action</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @if(count($report_list)>0)
                            @foreach($report_list as $report)
                                <tr>
                                    <td>
                                        {{$report->title}}
                                    </td>
                                    <td>
                                        <?php 
                                            $length = count($report->description);
                                            if($length > 60) {
                                                $pos=strpos($report->description, ' ', 20);
                                                echo  substr($report->description,0,$pos );
                                            } else{
                                                echo $report->description;
                                            }
                                        ?>
                                        
                                    </td>
                                    <td>
                                        {{$report->created_at}}
                                    </td>
                                    <td>
                                        {{$report->download_counter}}
                                    </td>
                                    <td>
                                        @if(Auth::user()->can('download-payout-report'))
                                            <a href="{{route('admin.reports.edit',$report->id)}}"
                                               class="btn btn-info btn-xs"><i
                                                        class="fa fa-pencil-square-o"></i> Edit</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">There is no report yet</td>
                            </tr>
                        @endif
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Download count</th>
                            @if(Auth::user()->can('download-payout-report'))
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