@extends('templates.cms')
@section('header')
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-dashboard"></i> Home</li>
	</ol>
@endsection
@section('content')
	<!-- Small boxes (Stat box) -->
	@if(Auth::user()->can('view-products'))
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>0</h3>
					<p>Published Files</p>
				</div>
				<div class="icon">
					<i class="ion ion-pizza"></i>
				</div>

				<a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3>0</h3>
					<p>User Submissions</p>
				</div>
				<div class="icon">
					<i class="ion ion-upload"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>0</h3>
					<p>Pending Validation</p>
				</div>
				<div class="icon">
					<i class="ion ion-ios-compose"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3>0</h3>
					<p>Pending Approval</p>
				</div>
				<div class="icon">
					<i class="ion ion-checkmark-circled"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div><!-- ./col -->
	</div><!-- /.row -->
	@endif
	<!-- Main row -->
	<div class="row">
		<!-- Left col -->
		<section class="col-lg-12 connectedSortable">
			<!-- Custom tabs (Charts with tabs)-->
			<div class="nav-tabs-custom">
				<!-- Tabs within a box -->
				<ul class="nav nav-tabs pull-right">
					
				</ul>
				<div class="tab-content no-padding">
					
					<!-- Morris chart - Sales -->
{{-- 					<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
					<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
 --}}				</div>
			</div><!-- /.nav-tabs-custom -->
		</section><!-- right col -->
	</div><!-- /.row (main row) -->
@endsection
