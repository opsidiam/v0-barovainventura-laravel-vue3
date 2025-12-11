<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Patrik Karaba WebPlace s.r.o. (www.web-place.sk)">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Barová inventúra</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('web/fav/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <link href="{{ asset('app/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('app/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/datatables.min.css') }}"/>
    <script src="https://kit.fontawesome.com/b74d5fe3b4.js" crossorigin="anonymous"></script>

    @yield('css')
    <style>
        /* Hlavný popover */
        .info-icon{
            cursor: pointer;
        }
        .popover {
            background-color: #ffffff;        /* čisté biele pozadie */
            color: #212529;
            border: 1px solid #e0e0e0;        /* jemná bordúra */
            border-radius: 0.75rem;           /* oblý tvar */
            box-shadow: 0 6px 20px rgba(0,0,0,0.15); /* modernejší tieň */
            font-size: 0.9rem;
            max-width: 260px;                 /* nech nie je príliš široký */
            padding: 0;                       /* Bootstrap tam dáva default padding, vyčistíme */
        }

        /* Hlavička */
        .popover-header {
            background-color: #f8f9fa;        /* svetlá šedá */
            color: #0d6efd;                   /* decentne modrá */
            font-weight: 600;
            border-bottom: 1px solid #e0e0e0;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            padding: 0.5rem 0.75rem;
        }

        /* Obsah */
        .popover-body {
            padding: 0.75rem;
            color: #495057;
            line-height: 1.4;
        }

        /* Šípka (arrow) */
        .bs-popover-top > .arrow::before,
        .bs-popover-auto[x-placement^="top"] > .arrow::before {
            border-top-color: #e0e0e0;   /* okraj šípky */
        }
        .bs-popover-top > .arrow::after,
        .bs-popover-auto[x-placement^="top"] > .arrow::after {
            border-top-color: #ffffff;   /* výplň šípky, rovnaká ako pozadie */
        }


    </style>
</head>

<body id="page-top">
<div id="wrapper">
    @include('admin.layouts.partials.sidebar')
    @include('admin.layouts.partials.head')
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
@include('admin.layouts.partials.modals')
<script src="{{ asset('app/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('app/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('app/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('app/js/sb-admin-2.min.js') }}"></script>
{{--    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>--}}
{{--    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>--}}
{{--    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>--}}
<script src="{{ asset('app/js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('app/js/datatables.min.js') }}"></script>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "positionClass": "toast-top-full-width",
            "progressBar" : true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "positionClass": "toast-top-full-width",
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "positionClass": "toast-top-full-width",
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "positionClass": "toast-top-full-width",
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
        @if ($errors->any())
        toastr.options =
        {
            "closeButton" : true,
            "positionClass": "toast-top-full-width",
            "progressBar" : true
        }
    @foreach ($errors->all() as $error)
    toastr.error("{{ __($error) }}");
    @endforeach
    @endif
    $( document ).ready(function() {
        var idleMax = 10;
        var idleTime = 0;
        setInterval(function(){
            timerIncrement();
        }, 60000);// 1 minute interval 60000
        $( "body" ).mousemove(function( event ) {
            idleTime = 0; // reset to zero
        });
        function timerIncrement() {
            idleTime = idleTime + 1;
            console.log(idleTime);
            if (idleTime > idleMax) {
                $('#autoLogoutModal').modal('toggle');
            }
        }

    });
    $(document)
        .on('mouseenter', '[data-toggle="popover"]', function () {
            var $el = $(this);

            // Initialize once per element, then show
            if (!$el.data('bs.popover')) {
                $el.popover({
                    trigger: 'manual',
                    placement: 'top',
                    container: 'body',
                    boundary: 'viewport',
                    customClass: 'modern-popover',
                    html: true,
                    content: function() {
                        var selector = $(this).attr('data-content');
                        if (selector && selector.startsWith('#')) {
                            return $(selector).html();
                        }
                        return $(this).attr('data-content');
                    }
                });
            }
            $el.popover('show');
        })
        .on('mouseleave', '[data-toggle="popover"]', function () {
            var $el = $(this);
            setTimeout(function () {
                if (!$('.popover:hover').length) {
                    $el.popover('hide');
                }
            }, 100);
        })
        .on('mouseleave', '.bs-popover-top', function () {
            var $el = $(this);
            setTimeout(function () {
                if (!$('.popover:hover').length) {
                    $el.popover('hide');
                }
            }, 100);
        })
</script>
@yield('js')
</body>

</html>
