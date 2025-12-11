<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-471JME5D7G"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-471JME5D7G');
    </script>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PH6PCZ3L');</script>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= env('RECAPTCHA_SITE_KEY') ?>"></script>
    <title>Domov | Barová inventúra</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('web/fav/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <meta name="facebook-domain-verification" content="0v4p837u7o69z3i29pfw6d1oejta7j" />
    <meta property="og:title" content="Barová inventúra">
    <meta property="og:description" content="Cloud aplikácia Barová inventúra slúži pre vytvorenie inventúry baru s pomocou váženia otvorených fliaš a EAN skenera.">
    <meta property="og:image" content="https://barovainventura.sk/web/assets/img/sidebar_img.jpg">
    <meta property="og:url" content="https://barovainventura.sk">
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="WebPlace s.r.o.">

    <meta name="twitter:title" content="Barová inventúra">
    <meta name="twitter:description" content="Cloud aplikácia Barová inventúra slúži pre vytvorenie inventúry baru s pomocou váženia otvorených fliaš a EAN skenera.">
    <meta name="twitter:image" content="https://barovainventura.sk/web/assets/img/sidebar_img.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@BarovaInventura">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{asset('web/assets/css/material-kit.css?v=2.0.7')}}" rel="stylesheet" />
    <link href="{{asset('web/assets/demo/demo.css')}}" rel="stylesheet" />
    <style>
        .hide-logo{
            display: none;
        }
    </style>
    <script src="https://kit.fontawesome.com/b74d5fe3b4.js" crossorigin="anonymous"></script>
</head>

<body class="index-page sidebar-collapse">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PH6PCZ3L"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@include('layouts.partials.header')
@yield('content')
@include('layouts.partials.footer')
@include('layouts.partials.modals')

<script src="{{asset('web/assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('web/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('web/assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('web/assets/js/plugins/moment.min.js')}}"></script>
<script src="{{asset('web/assets/js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('web/assets/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
<script src="{{asset('web/assets/js/material-kit.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>

    function scrollToDownload() {
        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }

    $('a.my-link-mail').each(function(index) {
        var href = $(this).attr('href');
        $(this).attr('href', href + ' Ticket [#'+Math.floor((Math.random() * 1000000000) + 1)+']');
    });
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            let recaptchaInput = form.querySelector('input[name="g-recaptcha-response"]');
            if (!recaptchaInput) {
                recaptchaInput = document.createElement('input');
                recaptchaInput.type = 'hidden';
                recaptchaInput.name = 'g-recaptcha-response';
                form.appendChild(recaptchaInput);
            }

            grecaptcha.ready(() => {
                grecaptcha.execute('<?= env('RECAPTCHA_SITE_KEY') ?>', { action: 'submit' })
                    .then(token => {
                        recaptchaInput.value = token;
                        form.submit();
                    })
                    .catch(error => {
                        console.error('Chyba reCAPTCHA:', error);
                        alert('Nepodarilo sa overiť CAPTCHA. Skúste znova.');
                    });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('company_slider');
        const logos  = slider.querySelectorAll('.logo img');

        function setUniformHeight(){
            let maxH = 0;
            logos.forEach(img => {
                const h = img.naturalHeight || img.clientHeight || 0;
                if (h > maxH) maxH = h;
            });
            slider.querySelectorAll('.logo').forEach(box => {
                box.style.height = (maxH ? maxH : 80) + 'px';
            });
        }

        logos.forEach(img => img.addEventListener('load', setUniformHeight));
        setUniformHeight();

        if (window.jQuery && jQuery.fn.owlCarousel) {
            jQuery(slider).on('initialized.owl.carousel resized.owl.carousel refreshed.owl.carousel', setUniformHeight);
        }

        window.addEventListener('resize', setUniformHeight);
    });
</script>

<script>
    toastr.options =
        {
            "closeButton" : true,
            "positionClass": "toast-top-full-width",
            "progressBar" : true
        }
    @if($message = Session::get('message'))
    toastr.success("{{ $message }}");
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
    toastr.info("{{ $errors->first('error') }}");
    @endif
</script>
<script>
    $(document).ready(function() {
        $('a[data-target="#priceModal"]').click(function(e) {
            e.preventDefault();
            $('#priceModal').modal('show');
        });
    });
</script>
<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="1f7f911b-9bcf-4466-8ce1-608d9e72f703" data-blockingmode="auto" type="text/javascript"></script>
</body>

</html>
