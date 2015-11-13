<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $title }}</title>
	<link rel="stylesheet" href="/css/app.css">
	<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
	@yield('styles')
</head>
<body>

	@yield('content')
	
	@yield('scripts')
</body>
</html>