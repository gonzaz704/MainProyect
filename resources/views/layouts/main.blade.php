<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Notidata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="Subir imágenes"/>
    <!-- <link rel="icon" type="image/jpg" href="assets/img/favicon.ico"/> -->
    <link rel="apple-touch-icon" href="{{asset('/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/vendors/css/extensions/pace.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/app.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/colors.min.css')}}">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/css/core/menu/menu-types/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/core/menu/menu-types/vertical-overlay-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/core/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/pages/invoice.min.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/flip_button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/mobile-responsive-custom.css')}}">
    <!-- END Page Level CSS-->

    <link href="{{ asset('/css/smart_wizard/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/smart_wizard/smart_wizard_theme_arrows.css')}}" rel="stylesheet" type="text/css" />    
    <link href="{{URL::to('/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('/vendors/css/forms/selects/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/charts.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/slider.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/share.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>    
    @yield('meta-tags')
</head>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    @include('layouts.partials.nav')
    @include('layouts.partials.notidata-menu')
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{URL::to('/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/js/core/app-menu.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/js/core/app.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/js/scripts/customizer.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/js/follow.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/js/news.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/js/common.js')}}" type="text/javascript"></script>

    <!-- ctrl + / -->
        
    <script type="text/javascript" src="{{URL::to('/js/waitingfor.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('/js/formvalidator/jquery.form-validator.js')}}"></script>
    <!-- <script type="text/javascript" src="{{URL::to('dist/js/jquery-2.1.0.js')}}"></script> -->
    <!-- <script type="text/javascript" src="{{URL::to('dist/js/jquery-ui-1.10.1.custom.min.js')}}"></script> -->
    <script type="text/javascript" src="{{URL::to('/js/formvalidator/security.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('/js/es6-promise.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('/js/profile/ProfileWizard.js')}}"></script>
    <script src="{{URL::to('/js/smart_wizard/popper.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{URL::to('/js/smart_wizard/jquery.smartWizard.js')}}"></script>
    <script src="{{URL::to('/vendors/js/tables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('/js/owl.carousel.js')}}"></script>
    <script src="{{URL::to('/js/charts.js')}}"></script>
    <script src="{{URL::to('/js/slider.js')}}"></script>
    <script src="{{URL::to('/js/utils.js')}}"></script>
    <script src="{{URL::to('/js/ckeditor/ckeditor.js')}}"></script>
    @yield('js_scripts')
    
    @stack('scripts')
</body>
</html>