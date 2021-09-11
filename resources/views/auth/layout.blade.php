<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title') | {{config('app.name')}}</title>
		<link rel="icon" type="image/icon" href="">
		<!-- Kindly removed once the packages need is working properly -->
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('template/assets/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{asset('template/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('template/assets/dist/css/adminlte.min.css')}}">
		<!-- Google Font: Quicksand -->
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
		<!-- end of to be removed packages -->
		@yield('css')
	</head>
    <body class="hold-transition login-page">

        @yield('content')

        <!-- jQuery -->
        <script src="{{asset('template/assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	</body>
</html>

