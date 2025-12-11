<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Non-indexed -->
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">

    <title>Žiadosť odoslaná</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >

    <style>
        body {
            background: radial-gradient(1200px 600px at 50% -10%, #f0fff4, #ffffff);
        }
        .success-icon {
            width: 88px;
            height: 88px;
        }
        .card {
            border: 0;
            box-shadow: 0 0.25rem 1rem rgba(0,0,0,.05);
            border-radius: 1rem;
        }
    </style>
</head>
<body>

<main class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card text-center p-4 p-md-5">
            <div class="mx-auto mb-4">
                <svg class="success-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="11" fill="#dcfce7" stroke="#16a34a" stroke-width="2"/>
                    <path d="M7 12.5l3.2 3.2L17 8.9" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <h1 class="h3 fw-semibold mb-2">Žiadosť bola úspešne prijatá</h1>
            <p class="text-muted mb-4">
                Ďakujeme. Vašu požiadavku sme zaznamenali a čoskoro vás budeme kontaktovať s ďalšími informáciami.
            </p>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="/" class="btn btn-success">
                    Prejsť na úvod
                </a>
                <button class="btn btn-outline-secondary" type="button" onclick="window.close()">
                    Zavrieť okno
                </button>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-0" style="font-size:.9rem;">
            Ak ste e-mail neobdržali, skontrolujte priečinok <em>Spam</em> alebo <em>Reklama</em>.
        </p>
    </div>
</main>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
></script>
</body>
</html>
