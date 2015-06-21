@extends('templates.cms')
@section('header')
    <h1>
        User
        <small>Profile</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.users')}}"><i class="fa fa-users"></i> Users</a></li>
        <li><i class="fa fa-eye"></i> {{$user->name}}</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>
                        {{$user->name}}
                        @if(Auth::user()->can('edit-profile'))
                            <a href="{{route('admin.profile.edit')}}" class="btn btn-primary btn-sm pull-right"><i
                                        class="fa fa-pencil-square-o"></i> Edit</a>
                        @endif
                    </h3>
                </div>
                <!-- Here load the partial view of user information. because this portion is common in the user view -->
                @include('cms.users.common_info')
            </div>
        </div>
    </div>
@endsection
