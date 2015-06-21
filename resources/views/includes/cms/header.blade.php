<header class="main-header">
	<!-- Logo -->
	<a href="{{route('admin.dashboard')}}" class="logo"><b>Pyramid Payments</b> CMS</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						@if(empty(Auth::user()->avatar))
							<img src="{{ asset('skins/adminLTE/dist/img/default-avatar.jpg') }}" class="user-image" alt="User Image"/>
						@else
							<!--<img src="{{asset('/files/avatar') .'/'. Auth::user()->avatar}}" class="user-image" alt="User Image">-->
							<img src="{{ GlideImage::load('/files/avatar/'.Auth::user()->avatar)->modify(['w'=> 25, 'h' => 25, 'fit' => 'crop']) }}" class="user-image" />
						@endif

						<span class="hidden-xs">{{ Auth::user()->name}}</span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">

							@if(empty(Auth::user()->avatar))
								<img src="{{ asset('skins/adminLTE/dist/img/default-avatar.jpg') }}" class="img-circle" alt="User Image" />
							@else
								 <img src="{{ GlideImage::load('/files/avatar/'.Auth::user()->avatar)->modify(['w'=> 90, 'h' => 90, 'fit' => 'crop']) }}" class="img-circle" alt="User Image">
							@endif

							<p>
								{{ Auth::user()->name}} - {{ Auth::user()->roles[0]->display_name}}
								<small>Member since {{ Auth::user()->created_at->toFormattedDateString()}}</small>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="{{route('admin.profile')}}" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="{{route('auth.logout')}}" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
