@extends('templates.cms')
@section('header')
    <h1>
        Users
        <small>Index</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><i class="fa fa-users"></i> Users</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>All Users</h3>

                    <h3>
                        @if(Auth::user()->can('edit-users'))
                            <a href="{{route('admin.users.create')}}" class="btn btn-primary btn-sm pull-right"><i
                                        class="fa fa-user-plus"></i> Create</a>
                        @endif
                    </h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered dataTable table-hover">
                        <thead>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role(s)</th>
                        <th>Actions</th>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @if(empty($user->avatar))
                                        <img src="{{GlideImage::load('skins/adminLTE/dist/img/default-avatar.jpg')->modify(['w'=> 45, 'h' => 45, 'fit' => 'crop']) }}" alt="" class="img-circle">
                                    @else
                                        <img src="{{ GlideImage::load('/files/avatar/'.$user->avatar)->modify(['w'=> 45, 'h' => 45, 'fit' => 'crop']) }}" alt="" class="img-circle">
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{implode(', ', $user->roles->lists('display_name'))}}</td>
                                <td>
                                    <a href="{{route('admin.users.show',$user->id)}}" class="btn btn-info btn-xs"><i
                                                class="fa fa-eye"></i> View</a>
                                    @if(Auth::user()->can('edit-users'))
                                        <a href="{{route('admin.users.edit',$user->id)}}"
                                           class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                        <a href="{{route('admin.users.delete',$user->id)}}"
                                           class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i> Delete</a>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                        <tfoot>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role(s)</th>
                        <th>Actions</th>
                        </tfoot>
                    </table>
                </div>
                @include('includes.cms.pagination')
            </div>
        </div>
    </div>
@endsection
