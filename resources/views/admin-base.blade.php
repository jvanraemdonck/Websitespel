<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta id="token" value="{{ csrf_token() }}">
	<title>{{ $title }}</title>
	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/css/customScrollbar.css">
	<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
	@yield('styles')
</head>
<body>


	<div class="top-left">
		<div class="title">
			HHDA
			<div class="pull-right"></div>
		</div>
	</div>
	
	<div class="top-right">
		<div class="crumbs">
			<ol class="breadcrumb">
				@yield('crumbs')
			</ol>
		</div>
		<div class="profile pull-right">

			<div class="notifications has-sub">
				<i class="fa fa-bell"></i>
				<span class="number">7</span>
				<ul class="items">
					<li><a href="">item 1 en blabla</a></li>
					<li><a href="">item 2</a></li>
					<li><a href="">item 3</a></li>
				</ul>
			</div>

			<div class="messages has-sub">
				<i class="fa fa-envelope"></i>
				<span class="number">4</span>
				<ul class="items">
					<li><a href="">item 1</a></li>
					<li><a href="">item 2</a></li>
					<li><a href="">item 3</a></li>
				</ul>
			</div>

			<div class="user has-sub">
				<img src="{{ $admin[0]->avatar }}" alt="avatar" />
				<span>{{ explode(' ', $admin[0]->longname)[0] }}</span>
				<ul class="items">
					<li><a href="">item 1</a></li>
					<li><a href="">item 2</a></li>
					<li><a href="">item 3</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="bottom-left scroll">
		<div class="nav-title">
			Menu
			<div class="hamburger pull-right" id="main-nav-ham">
				<i class="fa fa-bars"></i>
			</div>
		</div>
		<ul id="main-nav">
			<li>
				<a href="#">
					<i class="fa fa-tachometer"></i>
					<span class="nav-text">Dashbord</span>
				</a>
			</li>
			<li>
				<a class="selected" href="#">
					<i class="fa fa-question"></i>
					<span class="nav-text">Vragen</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-question-circle"></i>
					<span class="nav-text">Extra Tip-Vraag</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-users"></i>
					<span class="nav-text">Teams</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-lock"></i>
					<span class="nav-text">Administrators</span>
				</a>
			</li>
		</ul>
	</div>

	<div class="bottom-right scroll">
		@yield('content')
	</div>

	@yield('scripts')

</body>
</html>