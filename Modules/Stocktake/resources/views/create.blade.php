@extends('app.layouts.app')

@section('css')
    <style>
        .select2-container--default .select2-search--inline .select2-search__field{
            display:block;width:100%;height:calc(1.5em + 2px);padding:2px .75rem;color:#6e707e;
            transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .form-hint{font-size:.875rem;color:#6c757d;}
    </style>
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">

                <h1 class="h3 mb-3 text-gray-800">Začať inventúru</h1>

                {{-- Úvodné vysvetlenie prehľadne --}}
                <div class="alert alert-info shadow-sm">
                    <div class="d-flex">
                        <div class="mr-3"><i class="fas fa-info-circle fa-lg"></i></div>
                        <div>
                            <strong>Na čo slúži toto rozhranie?</strong>
                            <ul class="mb-2 mt-2">
                                <li><strong>Majiteľ/prevádzkar</strong> tu inventúru <u>otvorí</u> a neskôr <u>uzavrie</u>, vidí kontroly a generuje prihlasovacie údaje.</li>
                                <li><strong>Inventúra sa robí v PC/mobilnej aplikácii</strong> – nie tu v prehliadači.</li>
                                <li><strong>Prihlasovacie heslo</strong> zadané nižšie je potrebné pre prihlásenie do <u>PC/mobilnej aplikácie</u> k <u>tejto jednej inventúre</u>.</li>
                                <a href="{{ route('index') }}/BarovaInventura.exe"
                                   class="btn btn-success mr-1"
                                   data-aos="fade-in" data-aos-duration="1500">
                                    <i class="fas fa-download mr-1"></i>
                                    Stiahnuť PC aplikáciu
                                </a>
                                <button class="btn btn-info" type="button" data-tutorial="#inventoryPassword" title="Zobraziť/Skrýť">
                                    <i class="fas fa-eye mr-1"></i> Návod
                                </button>
                            </ul>
                            <a class="small" data-toggle="collapse" href="#howItWorks" role="button" aria-expanded="false" aria-controls="howItWorks">
                                Ako presne prebieha inventúra?
                            </a>
                            <div class="collapse mt-2" id="howItWorks">
                                <ol class="mb-0">
                                    <li>Tu otvoríš inventúru a vytvoríš prihlasovacie údaje.</li>
                                    <li>Zamestnanci sa prihlásia v PC/mobilnej aplikácii <strong>kódom</strong> a <strong>heslom</strong>.</li>
                                    <li>Skenujú položky v aplikácii.</li>
                                    <li>Tu v rozhraní sleduješ progress a inventúru uzavrieš.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulár --}}
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Skontroluj údaje:</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="post" action="{{ route('stocktake.store') }}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="bar" value="{{ session('bar') }}">

                            {{-- KROK 1: Zodpovedná osoba --}}
                            <div class="mb-3">
                                <h6 class="text-primary mb-2"><span class="badge badge-primary mr-2">1</span>Zodpovedná osoba <span class="text-danger">*</span></h6>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="small mb-1">Meno a priezvisko</label>
                                        <input type="text" minlength="1" name="leader" class="form-control" placeholder="Zodpovedná osoba *" required>
                                        <div class="form-hint">Osoba zodpovedná za inventúru (môže tiež dostať prihlasovací kód, ak bude skenovať).</div>
                                    </div>
                                </div>
                            </div>

                            {{-- KROK 2: Prihlasovacie heslo pre aplikáciu --}}
                            <div class="mb-3">
                                <h6 class="text-primary mb-2"><span class="badge badge-primary mr-2">2</span>Prihlasovacie heslo pre aplikáciu <span class="text-danger">*</span></h6>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="small mb-1">Heslo pre prihlásenie v PC/mobilnej aplikácii</label>
                                        <div class="input-group">
                                            <input id="inventoryPassword" type="password" minlength="1" name="password" class="form-control" placeholder="Prihlasovacie heslo *" required pattern="[A-Za-z0-9]+" inputmode="latin" autocomplete="off" spellcheck="false">
                                            <div class="input-group-append">
                                                <button class="btn btn-light border" type="button" data-toggle-visibility="#inventoryPassword" title="Zobraziť/Skrýť">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-light border" type="button" data-generate-password="#inventoryPassword" title="Vygenerovať silné heslo">
                                                    <i class="fas fa-magic"></i>
                                                </button>
                                                <button class="btn btn-primary" type="button" data-copy-target="#inventoryPassword" title="Skopírovať">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="pwdFeedback" class="invalid-feedback d-block" style="display:none;">
                                            Povolené sú len znaky <strong>A–Z, a–z, 0–9</strong> (bez diakritiky a medzier).
                                        </div>
                                        <div class="form-hint">
                                            Toto heslo sa používa <strong>iba</strong> v PC/mobilnej aplikácii na prihlásenie k tejto inventúre.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- KROK 3: Výber zamestnancov --}}
                            <div class="mb-3">
                                <h6 class="text-primary mb-2"><span class="badge badge-primary mr-2">3</span>Výber zamestnancov</h6>
                                <label class="small mb-1">Zamestnanci, ktorí sa zúčastnia inventúry</label>
                                <div class="input-group">
                                    <select class="js-example-basic-multiple" name="stocktake_users[]" multiple="multiple"></select>
                                </div>
                                <div class="form-hint">
                                    Pre nového zamestnanca napíš celé meno a stlač <strong>ENTER</strong>. Každému sa vygeneruje <strong>prihlasovací kód</strong> pre appku.
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-top pt-3">
                                <div class="text-muted small">
                                    Polia označené (<span class="text-danger">*</span>) sú povinné.
                                </div>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-boxes mr-1"></i> Začať inventúru
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Neuzavreté inventúry --}}
                @if($open_stocktakes->isNotEmpty())
                    <h2 class="h4 mb-2 text-gray-800">Neuzavreté inventúry</h2>
                    <p class="text-muted mb-3">Tu môžeš pokračovať v rozpracovaných inventúrach alebo ich uzavrieť.</p>
                    <div class="row">
                        @foreach($open_stocktakes as $open)
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="px-3 pt-2 d-flex justify-content-between">
                                        <a href="{{ route('stocktake.process', $open->id) }}" class="btn btn-success btn-sm">
                                            Otvoriť
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#deleteInventureModal_{{ $open->id }}" class="text-danger ml-2" title="Zmazať">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    #{{ $open->id }} Počet produktov :
                                                    {{ $scans[$open->api] ?? 0 }}
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ date('d.m.Y', strtotime($open->created_at)) }}
                                                    ({{ date('H:i', strtotime($open->created_at)) }})
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@include('stocktake::layouts.modal')

@section('js')
    @if($tutorial_show)
        <script>
            Swal.fire({
                title: "<strong>Prvá inventúra?</strong>",
                html: `Prvým krokom, ktorý treba spraviť, je nainštalovať si PC aplikáciu.
               Ak ju ešte nemáš, môžeš si ju stiahnuť po zatvorení tohto okna.`,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `
                    <i class="fa fa-thumbs-up"></i> Chápem
                `,
                icon: "question"
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('.js-example-basic-multiple').select2({
                placeholder: "Výber zamestnancov",
                tags: true,
                width: '100%',
                escapeMarkup: function (m) { return m; },
                language: {
                    noResults: function(){ return "<b>Užívateľ neexistuje. Napíš celé meno a stlač ENTER.</b>"; },
                    inputTooLong: function(){ return "Zadali ste príliš veľa znakov."; },
                    errorLoading: function(){ return "Chyba pri načítaní výsledkov. Skúste znova."; },
                    loadingMore: function(){ return "Načítavam ďalšie výsledky..."; },
                    searching: function(){ return "Hľadám..."; },
                    maximumSelected: function(){ return "Dosiahnutý maximálny počet."; },
                },
                ajax: {
                    url: '{{ route('stocktake.users.search') }}',
                    method: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return { q: $.trim(params.term), _token: CSRF_TOKEN };
                    },
                    processResults: function (data) { return { results: data }; },
                    cache: true
                }
            });
            (function(){
                const pwdInput   = document.getElementById('inventoryPassword');
                const pwdFeedback= document.getElementById('pwdFeedback');
                const form       = document.querySelector('form[action="{{ route('stocktake.store') }}"]');
                const allowedRe  = /^[A-Za-z0-9]+$/; // len ASCII písmená a číslice

                if (!pwdInput || !form) return;

                function checkPwd() {
                    const val = pwdInput.value || '';
                    const ok  = val.length > 0 && allowedRe.test(val);
                    // vizuálny stav + hláška
                    if (ok) {
                        pwdInput.classList.remove('is-invalid');
                        if (pwdFeedback) pwdFeedback.style.display = 'none';
                    } else {
                        pwdInput.classList.add('is-invalid');
                        if (pwdFeedback) pwdFeedback.style.display = 'block';
                    }
                    return ok;
                }

                // živá validácia počas písania
                pwdInput.addEventListener('input', checkPwd);
                pwdInput.addEventListener('blur', checkPwd);

                // zablokuj odoslanie, ak heslo nevyhovuje
                form.addEventListener('submit', function(e){
                    if (!checkPwd()) {
                        e.preventDefault();
                        e.stopPropagation();
                        // posuň fokus na pole hesla
                        pwdInput.focus();
                    }
                });

                // ak používaš generátor hesla – vygenerované heslo bude validné,
                // no pre istotu po generovaní validuj:
                document.addEventListener('click', function(ev){
                    const genBtn = ev.target.closest('[data-generate-password]');
                    if (genBtn) {
                        setTimeout(checkPwd, 0);
                    }
                });
            })();
        });

        // show/hide password
        document.addEventListener('click', function(e){
            const toggleBtn = e.target.closest('[data-toggle-visibility]');
            if (toggleBtn) {
                const sel = toggleBtn.getAttribute('data-toggle-visibility');
                const input = document.querySelector(sel);
                if (!input) return;
                const icon = toggleBtn.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    if (icon) { icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
                } else {
                    input.type = 'password';
                    if (icon) { icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
                }
            }
            const tutorialBtn = e.target.closest('[data-tutorial]');
            if (tutorialBtn) {
                Swal.fire({
                    title: '<strong>Začiatok a prihlásenie</strong>',
                    icon: 'info',
                    width: '50rem',
                    html:
                    '<iframe width="560" height="315" src="https://www.youtube.com/embed/9p0-TTMRJ8g?autoplay=1&mute=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Chápem',
                })
            }

            // copy to clipboard
            const copyBtn = e.target.closest('[data-copy-target]');
            if (copyBtn) {
                const sel = copyBtn.getAttribute('data-copy-target');
                const input = document.querySelector(sel);
                if (!input) return;
                const wasPassword = input.type === 'password';
                if (wasPassword) input.type = 'text';
                input.focus(); input.select(); input.setSelectionRange(0, input.value.length);
                try { document.execCommand('copy'); } catch (err) {}
                if (wasPassword) input.type = 'password';

                const original = copyBtn.innerHTML;
                copyBtn.classList.remove('btn-primary'); copyBtn.classList.add('btn-success');
                copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(()=>{ copyBtn.classList.remove('btn-success'); copyBtn.classList.add('btn-primary'); copyBtn.innerHTML = original; }, 1200);
            }

            // generate strong password
            const genBtn = e.target.closest('[data-generate-password]');
            if (genBtn) {
                const sel = genBtn.getAttribute('data-generate-password');
                const input = document.querySelector(sel);
                if (!input) return;
                input.value = generateStrongPassword();
            }
        });

        // simple strong password generator: 12–16 mix
        function generateStrongPassword() {
            const lower = "abcdefghijkmnopqrstuvwxyz";
            const nums  = "123456789";
            const all = lower + nums;
            const len = Math.floor(Math.random()*5) + 3; // 12-16

            let pwd = [
                lower[Math.floor(Math.random()*lower.length)],
                nums[Math.floor(Math.random()*nums.length)],
            ];
            while (pwd.length < len) {
                pwd.push(all[Math.floor(Math.random()*all.length)]);
            }
            // shuffle
            for (let i = pwd.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [pwd[i], pwd[j]] = [pwd[j], pwd[i]];
            }
            return pwd.join('');
        }
    </script>
@endsection
