@extends('templates.cms')
@section('header')
    <h1>
        Categories &amp; Groups
        <small>Index</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><i class="fa fa-tags"></i> Categories</li>
    </ol>
@endsection
@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover dataTable" id="example2" role="grid"
                           aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th style="width:30px">ID</th>
                            <th>Title (EN)</th>
                            <th>Sub-Title (EN)</th>
                            @if(Auth::user()->can('edit-categories') || Auth::user()->can('view-categories'))
                                <th style="width:15%">Action</th>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($categories as $category)
                            <tr role="row" class="info">
                                <td>{{$category->schedule_m_id}}</td>
                                <td>{{$category->title_en}}</td>
                                <td>{{$category->subtitle_en}}</td>
                                <td>
                                    @if(Auth::user()->can('view-categories'))
                                        <a href="{{route('admin.categories.show',$category->id)}}"
                                           class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                                    @endif

                                    @if(Auth::user()->can('edit-categories'))
                                        <a href="{{route('admin.categories.edit',$category->id)}}"
                                           class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                    @endif
                                </td>
                            </tr>
                            @foreach ($category->groups as $group)
                                <tr role="row">
                                    <td>{{$group->schedule_m_id}}</td>
                                    <td style="padding-left: 2em">{{$group->title_en}}</td>
                                    <td>{{$group->subtitle_en}}</td>
                                    <td>
                                        @if(Auth::user()->can('view-categories'))
                                            <a href="{{route('admin.groups.show',$group->id)}}"
                                               class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                                        @endif
                                        @if(Auth::user()->can('edit-categories'))
                                            <a href="{{route('admin.groups.edit',$group->id)}}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title (EN)</th>
                            <th>Sub-Title (EN)</th>
                            @if(Auth::user()->can('edit-categories') || Auth::user()->can('view-categories'))
                                <th>Action</th>
                            @endif
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
