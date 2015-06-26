@extends('templates.cms')
@section('header')
    <h1>
        Batch File
        <small>Upload</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.files')}}"><i class="fa fa-file-o"></i> Batch File</a></li>
        <li><i class="fa fa-user-plus"></i> Upload</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>
                        New
                    </h3>
                </div>
                <div class="box-body">
                    <div class="box-body">
                        {!! Form::open(['method'=>'POST','files' => 'true','class' => 'form-horizontal','role'=>'form', 'route' =>
                        ['admin.files.store']]) !!}
                        @include('errors.form_error')

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Upload your file</h4>
                            </div>

                            <div class="form-group" style="padding-top: 20px;">
                                {!! form::label('file','File',['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-6">
                                    {!! form::file('file',null,['class' => 'form-control']) !!}
                                </div>
                            </div>



                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Upload
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
