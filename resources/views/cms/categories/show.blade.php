@extends('templates.cms')
@section('header')
    <h1>
        Category
        <small>View</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.categories')}}"><i class="fa fa-tags"></i> Category</a></li>
        <li><i class="fa fa-eye"></i> {{$category->title_en}}</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box col-xs-12">
                <div class="box-header">
                    <h3>
                        {{$category->title_en}}
                        @if(Auth::user()->can('edit-categories'))
                            <a href="{{route('admin.categories.edit',$category->id)}}"
                               class="btn btn-primary btn-sm pull-right"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        @endif
                    </h3>
                </div>
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Product Category Info</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled col-xs-8 col-md-10">
                                <li><strong>Title(EN)</strong>: {{$category->title_en}}</li>
                                <li><strong>Title(FR)</strong>: {{$category->title_fr}}</li>
                                <li><strong>Sub Title(EN)</strong>: {{$category->subtitle_en}}</li>
                                <li><strong>Sub Title(FR)</strong>: {{$category->subtitle_fr}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
