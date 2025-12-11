<div class="modal fade youtube-video" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button id="close-video" type="button" class="button btn btn-default text-right" data-dismiss="modal">
                <i class="icofont-close-line-circled"></i>
            </button>
            <div class="modal-body">
                <div id="video-container" class="video-container">
                    <iframe id="youtubevideo" src="" width="640" height="360" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="modal-footer">
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
