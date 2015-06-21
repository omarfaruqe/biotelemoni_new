@extends('templates.cms')
@section('header')
    <h1>
        User
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
                        @if(empty($user->avatar))
                            <img src="{{asset('skins/adminLTE/dist/img/default-avatar.jpg')}}" alt=""
                                 class="col-xs-4 col-md-2 img-circle">
                        @else
                            <img src="{{ GlideImage::load('/files/avatar/'.$user->avatar)->modify(['w'=> 300]) }}" alt=""
                                 class="col-xs-4 col-md-2 img-circle">
                        @endif
                        <a href="{{route('admin.users.show',$user->id)}}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-eye"></i> View </a>
                    </h3>
                </div>
                <div class="box-body">
                    {!! Form::model($user, ['method'=>'PUT','files' => 'true','class' => 'form-horizontal','role'=>'form', 'route' =>
                    ['admin.users.update', $user->id]]) !!}
                    @include('errors.form_error')
                    @include('cms.users.form_user')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
