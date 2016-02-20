
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				@if(empty(Auth::user()->avatar))
					<img src="{{ asset('skins/adminLTE/dist/img/default-avatar.jpg') }}" class="img-circle" alt="User Image" />
				@else
					<img src="{{ GlideImage::load('/files/avatar/'.Auth::user()->avatar)->modify(['w'=> 45, 'h' => 45, 'fit' => 'crop']) }}" alt="" class="img-circle" alt="User Image">
				@endif
			</div>
			<div class="pull-left info">
				<p><a href="{{route('admin.profile')}}">{{Auth::user()->name}}</a></p>
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			
			@if (Auth::user()->can('view-batch-files'))
			<li {!!$section=='files' ? 'class="active"' : ''!!}>
				<a href="{{route('admin.files')}}">
					<i class="fa fa-file-o"></i> <span>Batch upload</span></i>
				</a>
			</li>
			@endif 
			
			@if (Auth::user()->can('view-users'))
			<li {!!$section=='users' ? 'class="active"' : ''!!}>
				<a href="{{route('admin.users')}}">
					<i class="fa fa-users"></i> <span>Users</span></i>
				</a>
			</li>
			@endif
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
