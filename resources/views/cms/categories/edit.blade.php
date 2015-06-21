@extends('templates.cms')
@section('header')
	<h1>
        Category
		<small>edit</small>
	</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.ingredients')}}"><i class="fa fa-tags"></i> Category</a></li>
        <li><i class="fa fa-pencil-square-o"></i> edit</li>
    </ol>
@endsection
@section('content')
	<!-- Small boxes (Stat box) -->

	<!-- Main row -->
	<div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8" style="padding-top: 60px;">
            <div class="box box-primary">
                {!! Form::model($category, ['method'=>'PUT', 'route' => ['admin.categories.update', $category->id]]) !!}
                <!-- include is used for render partial view errors/form_error.blade.php  -->
                @include('errors.form_error')
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('schedule_m_id', 'Schedule M ID') !!}
                        {!! Form::input('number','schedule_m_id', null, ['class'=> 'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title_en', 'Title (en)') !!}
                        {!! Form::text('title_en', null, ['class'=> 'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title_fr', 'Title (fr)') !!}
                        {!! Form::text('title_fr', null, ['class'=> 'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('subtitle_en', 'Subtitle (en)') !!}
                        {!! Form::text('subtitle_en', null, ['class'=> 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('subtitle_fr', 'Subtitle (fr)') !!}
                        {!! Form::text('subtitle_fr', null, ['class'=> 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Save!', array('class' => 'btn btn-primary')) !!}
                    </div>

                </div>

                {!! Form::close() !!}
            </div>
        </div>
	</div><!-- /.row (main row) -->
@endsection
