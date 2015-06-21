@extends('templates.cms')
@section('header')
    <h1>
        User
        <small>Create</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.users')}}"><i class="fa fa-users"></i> Users</a></li>
        <li><i class="fa fa-user-plus"></i> Create</li>
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
                        {!! Form::open(['method'=>'POST','class' => 'form-horizontal','role'=>'form', 'route' =>
                        ['admin.users.store']]) !!}
                        @include('errors.form_error')
                        @include('cms.users.form_user')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
