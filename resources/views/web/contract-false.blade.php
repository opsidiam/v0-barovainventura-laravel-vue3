<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Non-indexed -->
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">

    <title>Žiadosť odmietnutá</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >

    <style>
        body {
            background: radial-gradient(1200px 600px at 50% -10%, #fff5f5, #ffffff);
        }
        .error-icon {
            width: 88px;
            height: 88px;
        }
        .card {
            border: 0;
            box-shadow: 0 0.25rem 1rem rgba(0,0,0,.06);
            border-radius: 1rem;
        }
    </style>
</head>
<body>

<main class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card text-center p-4 p-md-5">
            <div class="mx-auto mb-4">
                <!-- Red cross icon (inline SVG) -->
                <svg class="error-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="12" r="11" fill="#fee2e2" stroke="#dc2626" stroke-width="2"/>
                    <path d="M8 8l8 8M16 8l-8 8" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
            </div>

            <h1 class="h3 fw-semibold mb-2">Žiadosť bola odmietnutá</h1>
            <p class="text-muted mb-4">
                Vaša žiadosť nemohla byť prijatá, pretože už bola v minulosti podaná. Ak si myslíte, že ide o omyl,
                kontaktujte nás, prosím.
            </p>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="/" class="btn btn-danger">
                    Prejsť na úvod
                </a>
                <a href="/support/contact/form" class="btn btn-outline-secondary">
                    Kontaktovať podporu
                </a>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-0" style="font-size:.9rem;">
            Potrebujete pomoc? Napíšte nám na <a href="mailto:support@barovainventura.sk">sales@barovainventura.sk</a>.
        </p>
    </div>
</main>

<!-- Bootstrap JS (optional) -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
></script>
</body>
</html>
