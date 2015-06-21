@extends('templates.cms')
@section('header')
	<h1>
		Own Profile
		<small>Edit</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="{{route('admin.users')}}"><i class="fa fa-users"></i> Users</a></li>
		<li><i class="fa fa-pencil-square-o"></i> {{$user->name}}</li>
	</ol>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="box col-xs-12">
			<div class="box-header">
				<h3>
					{{$user->name}}
					<a href="{{route('admin.profile')}}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-eye"></i> View </a>
				</h3>
			</div>
			<div class="box-body">
                {!! Form::model($user, ['method'=>'PUT','files' => 'true','class' => 'form-horizontal','role'=>'form', 'route' => ['admin.profile.update']]) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('errors.form_error')
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Basic Information</h4>
                        </div>

                        <div class="form-group" style="padding-top: 10px;">
                            {!! Form::label('name', 'Name',['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['class'=> 'form-control','required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'E-Mail Address',['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', null, ['class'=> 'form-control','required']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Change Password</h4>
                        </div>

                        <div class="form-group" style="padding-top: 10px;">
                            {!! Form::label('old_password', 'Old Password',['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('old_password', null, ['class'=> 'form-control','required']) !!}
                            </div>
                        </div>

                        <div class="form-group" style="padding-top: 10px;">
                            {!! Form::label('password', 'New Password',['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', null, ['class'=> 'form-control','required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirm New Password',['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', null, ['class'=> 'form-control','required']) !!}
                            </div>
                        </div>
                    </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Change Profile Image</h4>
                    </div>

                    <div class="form-group" style="padding-top: 25px;">
                        {!! form::label('avatar','Image',['class' => 'col-md-4 control-label'])!!}
                        <div class="col-md-6">
                            {!! form::file('avatar',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
