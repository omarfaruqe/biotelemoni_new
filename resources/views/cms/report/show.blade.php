@extends('templates.cms')
@section('header')
<h1>
    Payout Report
    <small>View</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('admin.reports')}}"><i class="fa fa-envelope"></i> Report</a></li>
    <li><i class="fa fa-eye"></i> view</li>
</ol>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="box col-xs-12">
            <div class="box-header">
                <h3>
                </h3>
            </div>
            <div class="box-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Report information</h4>
                    </div>
                    <div class="panel-body">

                        <ul class="list-unstyled col-xs-8 col-md-10">
                            <li><strong>Title</strong>: {{$report->title}}</li>
                            <li><strong>Created At</strong>: {{$report->created_at->toFormattedDateString()}}</li>
                            <li><strong>Description</strong>: {{$report->description}}</li>

                        </ul>
                    </div>



                </div>
                @if(Auth::user()->can('download-payout-report'))
                <a href="{{route('admin.reports.download',$report->id)}}">

                    <button style="padding-left: 5px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-delete">
                        <i class="fa fa-download"></i> Download
                    </button>
                </a>
                @endif



            </div>
        </div>
    </div>
</div>
@endsection
