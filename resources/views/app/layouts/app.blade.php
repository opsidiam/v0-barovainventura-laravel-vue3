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

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
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
    @yield('css')
    <style>
        .select2-container--default .select2-selection--single {
            width: 100%;
            height: 38px;
        }
        .select2-results{
            background-color: aliceblue;
        }
        .select2-search--dropdown{
            background-color: aliceblue;
        }
        .select2-selection__clear{
            display: none;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 9999;
            display: none;
            backdrop-filter: blur(2px);
        }

        .loading-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .spinner {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            border: 5px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-text {
            font-size: 1.2rem;
            font-weight: 500;
        }
        .unread-notification {
            background-color: rgba(0, 123, 255, 0.05);
            border-left: 3px solid #0d6efd;
        }

        .notification-item:hover {
            background-color: #f8f9fa !important;
        }

        .unread-notification:hover {
            background-color: rgba(0, 123, 255, 0.1) !important;
        }
        .badge-counter {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .badge-counter.hide {
            opacity: 0;
            transform: scale(0);
        }
    </style>
</head>

<body id="page-top">
<div id="wrapper">
    @include('app.layouts.partials.sidebar')
    @include('app.layouts.partials.head')
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
@if(!isset($blockPreloader))
    <div class="loading-overlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <div class="loading-text">Načítavam...</div>
        </div>
    </div>
@endif
@include('app.layouts.partials.modals')
@include('app.components.session-timeout-modal')
<script src="{{ asset('app/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('app/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('app/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('app/js/sb-admin-2.min.js') }}"></script>
{{--<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>--}}
{{--<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('app/js/datatables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
@if(!isset($blockPreloader))
    <script>

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const SESSION_TIMEOUT = {{ config('session.lifetime') * 60 * 1000 }};
        const CHECK_INTERVAL = 60000;
        let inactivityTimer;

        const overlay = document.getElementById('sessionExpiredOverlay');
        const modal = document.getElementById('sessionExpiredModal');

        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(checkSession, SESSION_TIMEOUT);
        }

        function showSessionExpiredModal() {
            overlay.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        async function checkSession() {
            try {
                const response = await fetch('/session-check', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    credentials: 'include'
                });

                const data = await response.json();

                if (!data.active) {
                    showSessionExpiredModal();
                }
            } catch (error) {
                console.error('Chyba pri kontrole relácie:', error);
                showSessionExpiredModal();
            }
        }

        const activityEvents = ['mousemove', 'keydown', 'click', 'scroll', 'touchstart'];
        activityEvents.forEach(event => {
            document.addEventListener(event, resetInactivityTimer, { passive: true });
        });

        resetInactivityTimer();
        setInterval(checkSession, CHECK_INTERVAL);
    });
</script>
<script>
    function showLoading(text = 'Načítavam...') {
        $('.loading-overlay').find('.loading-text').text(text);
        $('.loading-overlay').fadeIn();
    }

    function hideLoading() {
        $('.loading-overlay').fadeOut();
    }

    $(document).ajaxStart(function() {
        showLoading();
    }).ajaxStop(function() {
        hideLoading();
    });

    function showToast(message, type = 'success') {
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-full-width",
            "progressBar": true,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "newestOnTop": true
        };

        switch(type) {
            case 'success':
                toastr.success(message);
                break;
            case 'error':
                toastr.error(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'info':
                toastr.info(message);
                break;
            default:
                toastr.success(message);
        }
    }
    toastr.options =
        {
            "closeButton" : true,
            "positionClass": "toast-top-full-width",
            "progressBar" : true
        }
    @if(Session::has('message'))
        toastr.success("{{ session('message') }}");
    @endif
    @if ($message = Session::get('success'))
        toastr.success("{{ $message }}");
    @endif


    @if ($message = Session::get('error'))
        toastr.error("{{ $message }}");
    @endif


    @if ($message = Session::get('warning'))
        toastr.warning("{{ $message }}");
    @endif


    @if ($message = Session::get('info'))
        toastr.info("{{ $message }}");
    @endif
    @if ($errors->any())
        toastr.info("{{ $message }}");
    @endif
    function handleNotificationsDropdown() {
        // Only proceed if there are unread notifications
        if (document.getElementById('notificationCounter')) {
            fetch("{{ route('notifications.mark-all-as-read') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hide the counter
                        const counter = document.getElementById('notificationCounter');
                        if (counter) {
                            counter.remove();
                        }

                        // Update all notifications to appear as read
                        document.querySelectorAll('.unread-notification').forEach(item => {
                            item.classList.remove('unread-notification');
                            item.querySelector('.bg-primary').remove();
                            item.querySelector('.position-absolute').remove();
                            item.querySelector('span').classList.remove('fw-bold', 'text-dark');
                            item.querySelector('span').classList.add('text-muted');
                        });
                    }
                });
        }
    }
    $( document ).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#live_search_cargo_list').select2({
            placeholder: "Vyhľadať produkt *",
            selectionCssClass : "form-control",
            width: '100%',
            allowClear: true,
            escapeMarkup: function (markup) { return markup; },
            height: '38px',
            minimumInputLength: 2,
            "language": {
                "noResults": function(){
                    return "<b>Produkt neexistuje. Pre doplnenie kontaktuj <a href='{{route('support')}}' target='_blank'>podporu</a>.</b>";
                },
                "inputTooShort": function(){
                    return "Zadajte minimálne 2 znaky.";
                },
                "inputTooLong": function(){
                    return "Zadali ste príliš veľa znakov.";
                },
                "errorLoading": function(){
                    return "Chyba pri načítaní výsledkov. <b>Skús to napísať znova</b>";
                },
                "loadingMore": function(){
                    return "Načítavajú sa ďalšie výsledky.";
                },
                "searching": function(){
                    return "Hľadám ... ";
                },
                "maximumSelected": function(){
                    return "Chyba pri načítaní výsledkov ";
                },
            },
            ajax: {
                url: '{{route('cargo.live-data.search')}}',
                method: 'post',
                dataType: 'json',
                data: function (params) {
                    console.log(params);
                    return {
                        q: $.trim(params.term),
                        type: 0,
                        _token: CSRF_TOKEN,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },

                cache: true
            }
        });
        $('#live_search_service_list').select2({
            placeholder: "Vyhľadať dodávateľa",
            selectionCssClass : "form-control",
            allowClear: true,
            escapeMarkup: function (markup) { return markup; },
            width: '100%',
            height: '38px',
            // minimumInputLength: 2,
            "language": {
                "noResults": function(){
                    return "<b>Dodávateľ neexistuje.<br><a href='{{route('supplier.index')}}' target='_blank' >Pridať dodávateľa</a> ";
                },
                "inputTooShort": function(){
                    return "Zadajte minimálne 2 znaky.";
                },
                "inputTooLong": function(){
                    return "Zadali ste príliš veľa znakov.";
                },
                "errorLoading": function(){
                    return "Chyba pri načítaní výsledkov. <b>Skús to napísať znova</b>";
                },
                "loadingMore": function(){
                    return "Načítavajú sa ďalšie výsledky.";
                },
                "searching": function(){
                    return "Hľadám ... ";
                },
                "maximumSelected": function(){
                    return "Chyba pri načítaní výsledkov ";
                },
            },
            ajax: {
                url: '{{route('supplier.live-data.search')}}',
                method: 'post',
                dataType: 'json',
                data: function (params) {
                    console.log(params);
                    return {
                        q: $.trim(params.term),
                        _token: CSRF_TOKEN,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },

                cache: true
            }
        });
        $('#live_search_cargo_list_no_alko').select2({
            placeholder: "Vyhľadať produkt *",
            selectionCssClass : "form-control",
            width: '100%',
            allowClear: true,
            escapeMarkup: function (markup) { return markup; },
            height: '38px',
            minimumInputLength: 2,
            "language": {
                "noResults": function(){
                    return "<b>Produkt neexistuje. Pre doplnenie kontaktuj <a href='{{route('support')}}' target='_blank'>podporu</a>.</b>";
                },
                "inputTooShort": function(){
                    return "Zadajte minimálne 2 znaky.";
                },
                "inputTooLong": function(){
                    return "Zadali ste príliš veľa znakov.";
                },
                "errorLoading": function(){
                    return "Chyba pri načítaní výsledkov. <b>Skús to napísať znova</b>";
                },
                "loadingMore": function(){
                    return "Načítavajú sa ďalšie výsledky.";
                },
                "searching": function(){
                    return "Hľadám ... ";
                },
                "maximumSelected": function(){
                    return "Chyba pri načítaní výsledkov ";
                },
            },
            ajax: {
                url: '{{route('cargo.live-data.search')}}',
                method: 'post',
                dataType: 'json',
                data: function (params) {
                    console.log(params);
                    return {
                        q: $.trim(params.term),
                        type: 1,
                        _token: CSRF_TOKEN,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },

                cache: true
            }
        });
        $('#live_search_service_list_no_alko').select2({
            placeholder: "Vyhľadať dodávateľa *",
            selectionCssClass : "form-control",
            allowClear: true,
            escapeMarkup: function (markup) { return markup; },
            width: '100%',
            height: '38px',
            // minimumInputLength: 2,
            "language": {
                "noResults": function(){
                    return "<b>Dodávateľ neexistuje.<br><a href='{{route('supplier.index')}}' target='_blank' >Pridať dodávateľa</a> ";
                },
                "inputTooShort": function(){
                    return "Zadajte minimálne 2 znaky.";
                },
                "inputTooLong": function(){
                    return "Zadali ste príliš veľa znakov.";
                },
                "errorLoading": function(){
                    return "Chyba pri načítaní výsledkov. <b>Skús to napísať znova</b>";
                },
                "loadingMore": function(){
                    return "Načítavajú sa ďalšie výsledky.";
                },
                "searching": function(){
                    return "Hľadám ... ";
                },
                "maximumSelected": function(){
                    return "Chyba pri načítaní výsledkov ";
                },
            },
            ajax: {
                url: '{{route('supplier.live-data.search')}}',
                method: 'post',
                dataType: 'json',
                data: function (params) {
                    console.log(params);
                    return {
                        q: $.trim(params.term),
                        _token: CSRF_TOKEN,
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },

                cache: true
            }
        });
        $('#DataTableItem').DataTable({
            "aoColumns": [
                null,
                null,
                null,
                null,
                { "bSearchable": false },
            ],
            "lengthMenu": [
                [50, 100, 200, 500, -1],
                [50, 100, 200, 500, "All"],
            ],
        });
        $('#DataTableItemHome').DataTable({
            "aoColumns": [
                null,
                null,
                null,
            ],
            "lengthMenu": [
                [50, 100, 200, 500, -1],
                [50, 100, 200, 500, "All"],
            ],
        });
        $('#dataTableServicesList').DataTable({
            "aoColumns": [
                null,
                null,
                null,
                null,
                null,
                { "bSearchable": false },
            ],
            "lengthMenu": [
                [50, 100, 200, 500, -1],
                [50, 100, 200, 500, "All"],
            ],
        });
        $('#DataTableInvDetail').DataTable({
            "aoColumns": [
                null,
                null,
                null,
                { "bSearchable": false },
                { "bSearchable": false },
                { "bSearchable": false },
            ],
            "lengthMenu": [
                [50, 100, 200, 500, -1],
                [50, 100, 200, 500, "All"],
            ],
        });
        $('#DataTableInvPrehld').DataTable({
            "aoColumns": [
                null,
                null,
                null,
                null,
                { "bSearchable": false },
            ],
            "language": {
                "emptyTable": "No data available in table"
            },
            "lengthMenu": [
                [50, 100, 200, 500, -1],
                [50, 100, 200, 500, "All"],
            ],
            ordering: true,
            "order":[[2, 'desc']]
        });

    });

</script>
@yield('js')
</body>

</html>
