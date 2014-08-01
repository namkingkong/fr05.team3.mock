<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>FR05 Team3 Admin System</title>
<link href="{{ URL::asset('public/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/css/admin/my-style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/css/admin/admin.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/css/admin/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/css/my-classes.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/DataTables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<script src="{{ URL::asset('public/js/jquery-1.11.1.min.js') }}"></script>
<!-- <link href="css/admin.css" rel="stylesheet"> --><!-- WHAT ABOUT THIS? -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top bd-none bg-trans-dark-2" id="top-navbar">
		<!-- BEGIN:	NAVBAR HEADER -->
		<div class="navbar-header bg-trans-dark-1">
			<a href="index.html" class="navbar-brand">
				<span class="text-uppercase">
					<span class="glyphicon glyphicon-leaf"></span>
					<span class="text-strong">FR05 MOCK</span> | Admin
				</span>
			</a>
			<a class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="glyphicon glyphicon-th-list"></span>
			</a>
		</div>
		<!-- END:	NAVBAR HEADER -->
		<!-- BEGIN:	NAVIGATION -->
		<div id="navbar-collapse" class="navbar-collapse collapse">
			<!-- BEGIN:	QUICK ACTION NAV -->
			<ul class="nav navbar-nav navbar-right padding-right-15">
				<li>
					<a>
						<span class="glyphicon glyphicon-tasks"></span>
						<span class="label bg-trans-dark-1">1</span>
					</a>
				</li>
				<li>
					<a>
						<span class="glyphicon glyphicon-envelope"></span>
						<span class="label bg-trans-dark-1">1</span>
					</a>
				</li>
				<li>
					<a>
						<span class="glyphicon glyphicon-inbox"></span>
						<span class="label bg-trans-dark-1">1</span>
					</a>
				</li>
				<li class="dropdown user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						Lucifer Mai <span class="caret"></span>
					</a>
					<ul class="dropdown-menu arrow">
						<li>
							<a href="profile.html">
								<span class="glyphicon glyphicon-user"></span> Profile
							</a>
						</li>
						<li>
							<a href="calendar.html">
								<span class="glyphicon glyphicon-calendar"></span> Calendar
							</a>
						</li>
						<li>
							<a href="messages.html">
								<span class="badge badge-red pull-right">3</span>
								<span class="glyphicon glyphicon-envelope"></span> Inbox
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<span class="glyphicon glyphicon-off"></span> Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- END:	QUICK ACTION NAV -->
			<!-- BEGIN:	NAVBAR-NAV -->
			@if (Auth::check())
				<ul class="nav nav-stacked side-nav bg-trans-dark-2">
					<li class="active">
						<a href="{{ URL::to('/admin') }}">Dashboard</a></li>
					<li><a href="{{ URL::to('/admin/user') }}">Users</a></li>
					<li><a href="{{ URL::to('/admin/brand') }}">Brands</a></li>
					<li><a href="{{ URL::to('/admin/category') }}">Categories</a></li>
					<li><a href="{{ URL::to('/admin/product') }}">Products</a></li>
					<li><a href="{{ URL::to('/admin/review') }}">Review and Rating</a></li>
					<li><a href="{{ URL::to('/admin/comment') }}">Comment</a></li>
					<li><a href="{{ URL::to('/admin/order') }}">Orders</a></li>
					<li><a href="{{ URL::to('/admin/banner') }}">Sliders</a></li>
					<li><a href="{{ URL::to('/admin/report') }}">Report</a></li>
					<hr>
					<li><a href="{{ URL::to('/admin/config') }}">Configure</a></li>
					<hr>
					<li><a href="{{ URL::action('Fr05\Auth\Controller\AuthController@getLogout') }}">{{ Auth::user()->username }}, Logout</a></li>
				</ul>
			@endif
			<!-- END:	NAVBAR-NAV -->
		</div>
		<!-- END:	NAVIGATION -->
	</nav>
	
	<!-- BEGIN:	CONTENT -->
	@yield('content')
	<!-- END:	CONTENT -->
	
</body>

<script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/js/btn-file.js') }}"></script>

</html>
