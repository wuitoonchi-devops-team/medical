<!DOCTYPE html>
<html lang="en">

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
    <link href="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('dashboard/vendor/easy-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('dashboard/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($cssStyles))
        @foreach( $cssStyles as $css_style)
            <link href="{{ asset($css_style) }}" rel="stylesheet">
        @endforeach
    @endif
</head>
<body id="page-top">
    <input type="hidden" id="domainHost" value="{{ env('APP_URL') }}">
    <input type="hidden" id="csrf-token" name="csrf-token" value="{{ csrf_token() }}">
    <div id="wrapper">
        @include('dashboard.layout.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('dashboard.layout.toolbar')
                <div class="container-fluid">
                    @yield('content')
                    <!--<h1 class="h3 mb-4 text-gray-800">Blank Page</h1>-->
                </div>
            </div>
            @include('dashboard.layout.footer')
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Salir" para cerrar la sesión actual</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Salir</a>
                </div>
            </div>
        </div>
    </div>
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
    <script src="{{ asset('dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/easy-autocomplete/easy-autocomplete.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/select2/select2.min.js') }}" rel="stylesheet"></script>
    <script src="{{ asset('app/Config.js') }}"></script>
    <script src="{{ asset('app/Core.js') }}"></script>
    @if(isset($jsControllers))
        @foreach( $jsControllers as $jsController)
            <script src='{!! asset($jsController).'?v='.mt_rand(100000, 999999) !!}'></script>
        @endforeach
    @endif
</body>
</html>