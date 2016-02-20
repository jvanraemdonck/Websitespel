<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Websitespel - {{ $title }}</title>
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>

	@yield('modals')

	<div class="top-left">
		<div class="title">
			Websitespel
		</div>
	</div>
	
	<div class="top-right">
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
				<a href="/">
					<i class="fa fa-question"></i>
					<span class="nav-text">Spel</span>
				</a>
			</li>
			<li>
				<a href="/stand">
					<i class="fa fa-trophy"></i>
					<span class="nav-text">Stand</span>
				</a>
			</li>
			<li>
				<a href="/reglement">
					<i class="fa fa-book"></i>
					<span class="nav-text">Reglement</span>
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