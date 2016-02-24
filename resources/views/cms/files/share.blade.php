@extends('templates.cms')
@section('header')
    <h1>
        Batch File
        <small>Share</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.files')}}"><i class="fa fa-file-o"></i> Batch File</a></li>
        <li><i class="fa fa-share"></i> Share</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>
                        Share
                    </h3>
                </div>
                <div class="box-body">
                    <div class="box-body">
                        {!! Form::model($file,['method'=>'PUT','files' => 'true','class' => 'form-horizontal','role'=>'form', 'route' =>
                        ['admin.files.sharefile',$file->id]]) !!}
                        @include('errors.form_error')

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Share your file</h4>
                            </div>

                            <div class="form-group" style="padding-top: 25px;">
                                {!! form::label('file_name','File Name',['class' => 'col-md-4 control-label'])!!}
                                <div class="col-md-6">
                                    {!! Form::text('file_name', $file->name, ['class'=> 'form-control','required','disabled']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Email',['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-8 multiselect-outer" id="list_box">
                                    <select data-column="3" id="user-email-select" multiple="multiple" name="useremail[]" class="multiselect">
                                        @foreach($userList as $key=>$user)
                                            <option value="{{$key}}">
                                                {{$user}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="file_id" value="{{$file->id}}"/>
                        <input type="hidden" name="file_name" value="{{$file->name}}"/>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-share"></i> Share By Email
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {

        // to initialize the multiple checkbox library
        $('.multiselect').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true
        });
    });
</script>
@endsection



