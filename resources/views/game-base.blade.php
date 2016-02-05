<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Websitespel - {{ $title }}</title>
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>
	@yield('modals')

	<div class="container">
		@yield('content')
	</div>

	@yield('scripts')
</body>
</html>