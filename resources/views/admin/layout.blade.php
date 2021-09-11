<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{config('app.name')}}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('template/assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('template/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('template/assets/dist/css/adminlte.css')}}">
    <!-- Google Font: Quicksand -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- end of to be removed packages -->
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div id="app">
        <div class="wrapper">

            <!-- Navbar header -->
            @include('admin.includes.header')
            <!-- Main Sidebar Container -->
            @include('admin.includes.sidebar')

            <div class="content-wrapper">
                @yield('page_header')
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="main-footer">
                @include('admin.includes.footer')
            </footer>
            
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ mix('/js/app.js') }}"></script>
    <!-- jQuery -->
    <script src="{{asset('template/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Admin lte -->
    <script src="{{asset('template/assets/dist/js/adminlte.min.js')}}"></script>

    @yield('js')
</body>
</html>
