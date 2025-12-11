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
    <meta property="og:description" content="Aplikácia Barová inventúra slúži pre vytvorenie inventúry baru s pomocou váženia otvorených fliaš a EAN skenera.">
    <meta property="og:image" content="https://barovainventura.sk/web/assets/img/sidebar_img.jpg">
    <meta property="og:url" content="https://barovainventura.sk">
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="WebPlace s.r.o.">

    <meta name="twitter:title" content="Barová inventúra">
    <meta name="twitter:description" content="Aplikácia Barová inventúra slúži pre vytvorenie inventúry baru s pomocou váženia otvorených fliaš a EAN skenera.">
    <meta name="twitter:image" content="https://barovainventura.sk/web/assets/img/sidebar_img.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@BarovaInventura">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <link rel="stylesheet" href="{{asset('web/css/icofont.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}">

    <script src="https://kit.fontawesome.com/b74d5fe3b4.js" crossorigin="anonymous"></script>
</head>

<body class="index-page sidebar-collapse">
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PH6PCZ3L"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<div class="page_wrapper">

    <div id="preloader">
        <div id="loader"></div>
    </div>
    @yield('content')
    <div class="purple_backdrop"></div>
</div>

<script src="{{asset('web/js/jquery.js')}}"></script>
<script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/js/aos.js')}}"></script>
<script src="{{asset('web/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>

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
    const notyf = new Notyf({
        duration: 5000,
        position: {
            x: 'right',
            y: 'bottom',
        },
        background: 'indianred'
    });

    @if($message = Session::get('message'))
    notyf.success("{{ $message }}");
    @endif
    @if ($message = Session::get('success'))
    notyf.success("{{ $message }}");
    @endif


    @if ($message = Session::get('error'))
    notyf.error("{{ $message }}");
    @endif


    @if ($message = Session::get('warning'))
    notyf.warning("{{ $message }}");
    @endif


    @if ($message = Session::get('info'))
    notyf.info("{{ $message }}");
    @endif
    @if ($errors->any())
    notyf.info("{{ $errors->first('error') }}");
    @endif
</script>
{{--<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="1f7f911b-9bcf-4466-8ce1-608d9e72f703" data-blockingmode="auto" type="text/javascript"></script>--}}
</body>

</html>
