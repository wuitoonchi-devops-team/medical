<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{env('APP_NAME')}}</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('dashboard/vendor/nprogress/nprogress.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('dashboard/vendor/toastr/toastr.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($cssStyles))
        @foreach( $cssStyles as $css_style)
            <link href="{{ asset($css_style) }}" rel="stylesheet">
        @endforeach
    @endif
</head>
<body class="bg-gradient-primary">
    <input type="hidden" id="domainHost" value="{{ env('APP_URL') }}">
    @yield('content')
</body>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>
    <!-- Custome Libraries-->
    <script src="{{ asset('dashboard/vendor/axios/axios.min.js')}}"></script>
    <script src="{{ asset('dashboard/vendor/axios/progress.bar.min.js')}}"></script>
    <script src="{{ asset('dashboard/vendor/nprogress/nprogress.min.js')}}"></script>
    <script src="{{ asset('dashboard/vendor/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('dashboard/vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery.validate/messages_es.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery.blockUI/jquery.blockUI.min.js') }}" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous"></script>
    <script src="{{ asset('app/Config.js') }}"></script>
    <script src="{{ asset('app/Core.js') }}"></script>
    @if(isset($jsControllers))
        @foreach( $jsControllers as $jsController)
            <script src='{!! asset($jsController).'?v='.mt_rand(100000, 999999) !!}'></script>
        @endforeach
    @endif
</html>