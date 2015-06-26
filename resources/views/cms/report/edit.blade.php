
@extends('templates.cms')
@section('header')
    <h1>
        Payout Report
        <small>Edit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.reports')}}"><i class="fa fa-flask"></i> Payout Report</a></li>
        <li><i class="fa fa-pencil-square-o"></i> edit</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>
                       
                    </h3>
                </div>
                <div class="box-body">
                    {!! Form::model($report, ['method'=>'PUT', 'class' => 'form-horizontal','role'=>'form', 'route'
                    => ['admin.reports.update', $report->id]]) !!}
                    <!-- include is used for render partial view errors/form_error.blade.php  -->
                    @include('errors.form_error')

                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            <h4 class="panel-title">Payout Report info</h4>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                {!! Form::label('title', 'Title (en)',['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('title', null, ['class'=> 'form-control','required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Title (fr)',['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-8">
                                    {!! Form::textarea('description', null, ['class'=> 'form-control','id'=> 'editor1']) !!}
                                </div>
                            </div>
                            
                        </div>
                        <!-- end of default panel body-->
                    </div>
                    <!-- end of default panel-->

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>

                </div>
                <!-- end of box body-->
                {!! Form::close() !!}
            </div>
        </div>
        <!-- end of row div -->
    </div>
 <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
      
      });
    </script>
@endsection
