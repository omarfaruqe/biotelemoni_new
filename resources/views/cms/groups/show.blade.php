
@extends('templates.cms')
@section('header')
    <h1>
        Group
        <small>View</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.categories')}}"><i class="fa fa-users"></i> Category</a></li>
        <li><i class="fa fa-eye"></i> {{$group->title_en}}</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>
                        {{$group->title_en}}
                        @if(Auth::user()->can('edit-categories'))
                            <a href="{{route('admin.groups.edit',$group->id)}}"
                               class="btn btn-primary btn-sm pull-right"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        @endif
                    </h3>
                </div>
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Product Group Info</h4>
                        </div>

                        <div class="panel-body">
                            <ul class="list-unstyled col-xs-8 col-md-10">
                                <li><strong>Schedule M ID</strong>: {{$group->schedule_m_id}}</li>
                                <li><strong>Category(en)</strong>: {{$group->category->title_en}}</li>
                                <li><strong>Category(fr)</strong>: {{$group->category->title_fr}}</li>
                                <li><strong>Title(en)</strong>: {{$group->title_en}}</li>
                                <li><strong>Title(fr)</strong>: {{$group->title_fr}}</li>
                                <li><strong>Sub-Title(en)</strong>: {{$group->subtitle_en}}</li>
                                <li><strong>Sub-Title(fr)</strong>: {{$group->subtitle_fr}}</li>
                                <li><strong>Average Serving Amount</strong>: {{$group->average_serving}}</li>
                                <li><strong>Average Serving Unit</strong>: {{$group->average_serving_unit}}</li>
                                <li><strong>Average Serving Unit</strong>: {{$group->average_serving_scale}}</li>
                                <li><strong>Average Natural Sugar per 100</strong>: {{$group->average_natural_sugar_per_100}}</li>
                                <li>
                                    <strong>All Free Sugar</strong>:
                                    @if ($group->all_free_sugar == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
