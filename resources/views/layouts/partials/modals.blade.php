<div class="modal fade" id="contactModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 0; border: none; box-shadow: 0 0 rgb(0 0 0 / 0%); background-color: transparent ">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card card-login">
                    <div class="card-header card-header-primary text-center">
                        <h4 class="card-title">{{ __('Kontakt') }}</h4>
                    </div>
                    <div class="card-body" style="padding: 0px 30px;">
                        <div class="container text-center">
                            <div class="row">
                                <div class="ml-auto mr-auto">
                                    <h3 class="title">
                                        <a class="my-link-mail" href="mailto:info@barovainventura.sk?subject=Klient Barová inventúra" target="_blank">info@barovainventura.sk</a>
                                    </h3>
                                    <h3 class="title">
                                        <a  href="tel:+421948357763" target="_blank">0948 357 763</a>
                                    </h3>
                                    <h4 class="description" >
                                        <span style="font-weight: bold">PO - PI: 9:00 - 18:00</span><br><br>
                                        <span style="font-weight: bold">WebPlace s.r.o.</span><br>
                                        Trnovo 74, 038 41<br>
                                        Košťany nad Turcom<br>
                                        IČO: 52 646 181
                                    </h4>

                                    <h3 class="title">
                                        <a href="{{route('about')}}">
                                            <butto class="btn btn-primary">
                                                Náš tím
                                            </butto>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="downloadsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 0; border: none; box-shadow: 0 0 rgb(0 0 0 / 0%); background-color: transparent ">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card card-login">
                    <div class="card-header card-header-primary text-center">
                        <h4 class="card-title">{{ __('Na stiahnutie') }}</h4>
                    </div>
                    <div class="card-body" style="padding: 0px 30px;">
                        <div class="container text-center">
                            <div class="row">
                                <div class="ml-auto mr-auto">
                                    <h3 class="title">
                                        Počítačová aplikácia<br>
                                        <a class="h5" style="color: blue" href="{{asset('BarovaInventura.exe')}}" target="_blank">
                                            <span class="material-icons">download</span> BarovaInventura.exe
                                        </a>
                                    </h3>
                                    <h3 class="title">
                                        Užívateľská príručka<br>
                                        <a class="h5" style="color: blue" href="{{asset('Uzivatelska_prirucka.pdf')}}" target="_blank">
                                            <span class="material-icons">download</span> Užívateľská príručka
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="priceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0; border: none; box-shadow: 0 0 rgb(0 0 0 / 0%); background-color: transparent">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card card-login">
                    <div class="card-header card-header-primary text-center">
                        <h4 class="card-title">{{ __('Cenník') }}</h4>
                    </div>
                    <div class="card-body" style="padding: 0px 30px;">
                        <div class="table-responsive" align="center">
                            <p></p>
                            <hr>
                            <h3 class="text-success text-center">30 dní úplne zadarmo</h3>

                            <div class="mt-4">
                                <h5 class="text-center">Požiadať o cenovú ponuku na mieru</h5>
                                <form id="customQuoteForm" method="POST" action="{{ route('request.quote') }}">
                                    @csrf
                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">email</i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control" name="email"
                                                   placeholder="Váš email" required>
                                        </div>
                                        <small class="text-muted">Zadajte váš email a my vám pošleme cenovú ponuku</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-round">
                                        Odoslať žiadosť
                                    </button>
                                </form>
                                <div id="quoteSuccess" class="alert alert-success mt-3" style="display:none;">
                                    Ďakujeme! Čoskoro vás budeme kontaktovať s cenovou ponukou.
                                </div>
                            </div>
                            <p class="text-center"><small>Spoločnosť WebPlace s.r.o. nie je platcom DPH</small></p>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="button" class="btn btn-primary btn-link btn-wd" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Cookie" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cookie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                <script id="CookieDeclaration" src="https://consent.cookiebot.com/1f7f911b-9bcf-4466-8ce1-608d9e72f703/cd.js" type="text/javascript" async></script>
            </div>
            <div class="footer text-center">
                <button type="button" class="btn btn-primary btn-link btn-wd" data-dismiss="modal">Zavrieť</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                // Pridanie hidden inputu ak neexistuje
                if (!form.querySelector('input[name="g-recaptcha-response"]')) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'g-recaptcha-response';
                    form.appendChild(input);
                }

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (!window.grecaptcha) {
                        console.error('reCAPTCHA not loaded');
                        form.submit();
                        return;
                    }

                    grecaptcha.ready(function() {
                        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                            action: form.id || 'form'
                        }).then(function(token) {
                            form.querySelector('input[name="g-recaptcha-response"]').value = token;
                            form.submit();
                        }).catch(function(error) {
                            console.error('reCAPTCHA error:', error);
                            form.submit();
                        });
                    });
                });
            });
        });
    </script>
@endpush
