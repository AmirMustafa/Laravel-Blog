<!DOCTYPE html>
<html>
<head>
	<title>Admin Area</title>
	<!-- <link rel="stylesheet" href="{{ URL::to('public/src/css/admin.css') }}"> -->

	<!-- <link rel="stylesheet" href="{{ URL::secure('public/src/css/admin.css') }}"> -->
		
	<link rel="stylesheet" href="{{ URL::to('public/src/css/admin.css') }}">
	@yield('styles')
</head>
<body>
	@include('includes.admin-header')		<!-- Admin Header -->
	
	@yield('content')

	<script type="text/javascript"> 
		var baseUrl = "{{ URL::to('/') }}";	//good to know the base url for different ajax calls	
	</script>
	
	@yield('scripts')
		
</body>
</html>