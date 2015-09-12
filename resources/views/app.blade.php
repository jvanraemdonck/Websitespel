<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $title }}</title>
	<link rel="stylesheet" href="/css/app.css">
	@yield('styles')
</head>
<body>

	@yield('content')
	
	@yield('scripts')
</body>
</html>