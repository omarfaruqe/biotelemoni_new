@extends('templates.cms')
@section('header')
	<h1>
        Group
		<small>edit</small>
	</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.categories')}}"><i class="fa fa-tags"></i> Group</a></li>
        <li><i class="fa fa-pencil-square-o"></i> Edit </li>
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
                {!! Form::model($group, ['method'=>'PUT', 'route' => ['admin.groups.update', $group->id]]) !!}
                <!-- include is used for render partial view errors/form_error.blade.php  -->
                @include('errors.form_error')
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('schedule_m_id', 'Schedule M ID') !!}
                        {!! Form::input('number','schedule_m_id', null, ['class'=> 'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('product_category_id', 'Category ') !!}
                        {!! Form::select('product_category_id', $categories, $group->product_category_id ,['class'=> 'form-control','required']) !!}
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
                        {!! Form::label('average_serving', 'Average Serving Amount') !!}
                        {!! Form::input('number','average_serving', null, ['class'=> 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('average_serving_unit', 'Average Serving Unit') !!}
                        {!! Form::select('average_serving_unit', ['g' => 'g', 'ml' => 'ml'],$group->average_serving_unit, array('class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('all_free_sugar', 'All free sugar') !!}
                        {!! Form::checkbox('all_free_sugar') !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('average_serving', 'Average Natural Sugar (per 100g) : ') !!} {{$group->average_natural_sugar_per_100}}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Recalculate Average Natural Sugar!', 'Recalculate Products') !!}
                        {!! Form::button('Recalculate!', array('class' => 'btn btn-success')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Recalculate Products', 'Recalculate Products') !!}
                        {!! Form::button('Recalculate', array('class' => 'btn btn-success')) !!}
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
