@extends('app.layouts.app')
@section('css')
    <style>
        .fade_table{
            width: 100%;
            background-color: black;
            height: 100%;
            position: absolute;
            opacity: 0.5;
            z-index: 10;

        }
        .fide_table_i {
            position: absolute;
            left: 50%;
            top: 35%;
            z-index: 1000;
            height: 62px;
            width: 62px;
        }
        .tooltip-inner {
            white-space:pre;
            max-width: none;
        }

    </style>
@endsection
@section('content')
{{--    {{dd($stocktake->api_key)}}--}}
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div id="alert_wight_null" class="alert alert-warning" style="display: none"><b>Pomôž nám zlepšiť túto službu.</b> V inventúre sa nachádzajú produkty ktoré nemajú vyplnené potrebné údaje, ktoré sú potrebné pre správny výpočet objemu. <b>Údaje môžete doplniť kliknutím na oranžové tlačidlo "Doplniť údaje", tlačidlo sa nachádza pri každom produkte (stĺpec Aktuálne skladom (ks / Bal.) / (ks)) ktorý je potrebné aktualizovať.</b></div>


                <!-- Page Heading -->

                <h1 class="h3 mb-2 text-gray-800">Prehľad inventúry
                    @if($stocktake->open == 1)<button class="btn btn-info" data-toggle="modal" data-target="#closeInvModal" style="margin-left: 50px">Uzavrieť inventúru</button>@endif
                    @if($stocktake->open == 1)<button class="btn btn-danger" data-toggle="modal" data-target="#deleteInvModal" style="margin-left: 50px">Vymazať inventúru</button>@endif
                </h1>
                <div class="row">
                    @if($mine_user)
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body py-2">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1">
                                            <div class="text-uppercase text-muted small mb-1">
                                                Meno zamestnanca
                                            </div>
                                            <div class="h6 mb-0 text-gray-900">
                                                {{ $mine_user->name }} {{ $mine_user->surname }}
                                            </div>
                                        </div>
                                        <i class="fas fa-id-badge text-gray-300" style="font-size:1.25rem;"></i>
                                    </div>

                                    {{-- Prihlasovací kód --}}
                                    <div class="mb-1">
                                        <span class="text-uppercase font-weight-bold small text-primary">
                                            Prihlasovací kód do aplikácie
                                        </span>
                                    </div>
                                    <div class="input-group input-group-sm mb-2">
                                        <input id="loginCodeInput"
                                               type="text"
                                               class="form-control text-monospace bg-light"
                                               value="{{ $mine_user->api }}"
                                               readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"
                                                    type="button"
                                                    data-copy-target="#loginCodeInput">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- API key (heslo) --}}
                                    <div class="mb-1">
                                        <span class="text-uppercase font-weight-bold small text-primary">
                                            Prihlasovacie heslo do aplikácie
                                        </span>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <input id="apiKeyInput"
                                               type="password"
                                               class="form-control text-monospace bg-light"
                                               value="{{ $stocktake->api_key ?? '' }}"
                                               readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-light border"
                                                    type="button"
                                                    title="Zobraziť/Skrýť"
                                                    data-toggle-visibility="#apiKeyInput">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-primary"
                                                    type="button"
                                                    data-copy-target="#apiKeyInput">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endif
                    @if(isset($users))
                            @foreach($users as $user)
                                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body py-2">

                                            {{-- Hlavička: meno + delete --}}
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="flex-grow-1">
                                                    <div class="text-uppercase text-muted small mb-1">
                                                Meno zamestnanca
                                                    </div>
                                                    <div class="h6 mb-0 text-gray-900 text-truncate" title="{{ $user->name }} {{ $user->surname }}">
                                                        {{ $user->name }} {{ $user->surname }}
                                                    </div>
                                                </div>
                                                <a href="#"
                                                   class="ml-2"
                                                   data-toggle="modal"
                                                   data-target="#deleteUserModal_{{ $user->id }}"
                                                   aria-label="{{ __('admin.delete') ?? 'Delete' }}">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </a>
                                            </div>

                                            {{-- Prihlasovací kód --}}
                                            <div class="mb-1">
                                                <span class="text-uppercase small font-weight-bold text-primary">
                                            Prihlasovací kód do aplikácie
                                                </span>
                                            </div>
                                            <div class="input-group input-group-sm mb-2">
                                                <input
                                                    id="loginCodeInput_{{ $user->id }}"
                                                    type="text"
                                                    class="form-control text-monospace bg-light"
                                                    value="{{ $user->api }}"
                                                    readonly>
                                                <div class="input-group-append">
                                                    <button type="button"
                                                            class="btn btn-primary"
                                                            data-copy-target="#loginCodeInput_{{ $user->id }}">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- API key (heslo) --}}
                                            <div class="mb-1">
                                                <span class="text-uppercase small font-weight-bold text-primary">
                                            Prihlasovacie heslo do aplikácie
                                                </span>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <input
                                                    id="apiKeyInput_{{ $user->id }}"
                                                    type="password"
                                                    class="form-control text-monospace bg-light"
                                                    value="{{ $stocktake->api_key ?? '' }}"
                                                    readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-light border"
                                                            type="button"
                                                            title="{{ __('admin.show_hide') ?? 'Zobraziť/Skrýť' }}"
                                                            data-toggle-visibility="#apiKeyInput_{{ $user->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-primary"
                                                            type="button"
                                                            data-copy-target="#apiKeyInput_{{ $user->id }}">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        @endif
                        {{--                    <div class="col-lg-3">--}}
                        {{--                        <div class="card shadow mb-3">--}}
                        {{--                            <div class="card-body">--}}
                        {{--                                <p class="text-gray-900 h3 p-0 m-0" style="font-weight: bold">Tržba celkom: <i id="trzba_celkom_spolu"></i> €</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        <div class="col-lg-3" id="hodnota_celkom_spolu_card" style="display: none;">
                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <p class="text-gray-900 h3 p-0 m-0" style="font-weight: bold">Hodnota skladu celkom<br><i id="hodnota_celkom_spolu"></i> €</p>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="fade_table">
                        <img src="{{asset('/img/2.gif')}}" class="fide_table_i">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div style="display: none" id="updateDataArray">
                            </div>
                            <table class="table table-bordered" id="DataTableInvDetail" width="99%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Názov (Objem, Alk.) / (Váha)</th>
                                    <th>Aktuálne skladom (ks / Bal.) / (ks) [Obsah spolu]</th>
                                    <th>Naskenoval</th>
                                    <th>EAN</th>
                                    <th>Zisk/Strata</th>
                                    <th style="width: 80px;"></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Názov (Objem, Alk.) / (Váha)</th>
                                    <th>Aktuálne skladom (ks / Bal.) / (ks) [Obsah spolu]</th>
                                    <th>Naskenoval</th>
                                    <th>EAN</th>
                                    <th>Zisk/Strata</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- End of Footer -->

    </div>


@endsection
@section('js')
    @if(auth()->user()->email_info == null)
        <script>
            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            Swal.fire({
                title: 'Nastavenie e-mailu',
                html: `
                    <div style="text-align:left">
                      <label for="swal-email" style="display:block;margin-bottom:6px;font-weight:600;">
                        Nastavte si e-mail, na ktorý vám bude odoslané PDF inventúry po jej uzavretí.<br>
                        Nastavenie môžeš zmeniť kliknutím na svoje meno v pravom hornom rohu a následným výberom položky Nastavenia.
                      </label>
                      <input id="swal-email" type="email" class="swal2-input" value="{{auth()->user()->email ?? ''}}" placeholder="meno@example.com" autocomplete="email" style="width:80%">
                      <label for="swal-close-notif" style="display:flex;align-items:center;gap:.5rem;margin-top:.5rem;">
                        <input id="swal-close-notif" type="checkbox" checked>
                        <span>Zasielať ukončenie inventúry na e-mail</span>
                      </label>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Uložiť',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const email = document.getElementById('swal-email').value.trim();
                    const closeNotif = document.getElementById('swal-close-notif').checked;

                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (email && !re.test(email)) {
                        Swal.showValidationMessage('Zadaj platný e-mail alebo nechaj pole prázdne.');
                        return false;
                    }

                    return fetch('{{route('setting.update.email')}}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            email_info: email || null,
                            close_stocktake_notification: closeNotif ? '1' : '0'
                        })
                    })
                        .then(res => res.json().catch(() => ({})))
                        .then(data => {
                            if (!data) {
                                throw new Error('Prázdna odpoveď zo servera');
                            }
                            return data;
                        })
                        .catch(err => {
                            Swal.showValidationMessage(err.message || 'Nepodarilo sa odoslať požiadavku.');
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (!result.isConfirmed) return;

                const code = (typeof result.value?.return !== 'undefined') ? result.value.return : 0;

                if (code === 0) {
                    Swal.fire({ icon: 'success', title: 'Uložené', text: 'Nastavenia boli aktualizované.' });
                } else if (code === 3) {
                    Swal.fire({ icon: 'info', title: 'Overenie e-mailu', text: 'Poslali sme ti overovací e-mail. Dokonči overenie.' });
                } else {
                    Swal.fire({ icon: 'error', title: 'Chyba', text: 'Nepodarilo sa uložiť nastavenia.' });
                }
            });
        </script>
    @endif
    <script>

        document.addEventListener('click', function (e) {
            const copyBtn = e.target.closest('[data-copy-target]');
            if (copyBtn) {
                const sel = copyBtn.getAttribute('data-copy-target');
                const input = document.querySelector(sel);
                if (!input) return;

                // dočasne odkryť, ak je to password
                const wasPassword = input.type === 'password';
                if (wasPassword) input.type = 'text';

                input.focus();
                input.select();
                input.setSelectionRange(0, input.value.length);
                try { document.execCommand('copy'); } catch (err) {}

                if (wasPassword) input.type = 'password';

                // spätná väzba
                const original = copyBtn.innerHTML;
                copyBtn.classList.remove('btn-primary'); copyBtn.classList.add('btn-success');
                copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(() => {
                    copyBtn.classList.remove('btn-success'); copyBtn.classList.add('btn-primary');
                    copyBtn.innerHTML = original;
                }, 1200);
            }

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
        });
        $(document).ready(function() {
            const t = $('#DataTableInvDetail').DataTable();
            const tokenInput = $('input[name=_token]');
            const updateDataInputs = $('input[name="updateDataArrayInput[]"]');
            const fadeTable = $('.fade_table');
            const detailScanModalContainer = $('#detailScanModaladdItem');
            const totalRevenueElement = $("#trzba_celkom_spolu");
            const totalStockPrice = $("#hodnota_celkom_spolu");
            const totalStockPriceCard = $("#hodnota_celkom_spolu_card");
            let totalStockPriceValue = 0;
            const updateDataArray = $('#updateDataArray');
            const alertWeightNull = $('#alert_wight_null');

            totalStockPriceCard.hide();

            // Helper functions
            const hideLoading = () => setTimeout(() => fadeTable.hide(), 1000);
            const initTooltips = () => $('[data-toggle="tooltip"]').tooltip();
            const formatMoney = (value) => value ? (Number(value) || 0).toFixed(2) + ' €' : '- €';
            const formatVolume = (value) => value ? value.toFixed(0) + ' ml' : '- ml';

            // Generate warning icons
            const getWarningIcon = (condition, message) =>
                condition ? `<i class="fas fa-exclamation-triangle text-warning" data-toggle="tooltip" title="${message}"></i>` : '';

            // ----------------------------
            // DETAIL SCAN MODAL
            // ----------------------------
            const detailModalHtml = `
    <div class="modal fade" id="detailScanModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upraviť počet kusov</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="detailScanForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Počet neotvorených kusov</label>
                            <input type="number" name="full_pack" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id">
                        <input type="hidden" name="stocktake">
                        <input type="hidden" name="_token" value="${tokenInput.val()}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                        <button type="submit" class="btn btn-primary">Uložiť</button>
                    </div>
                </form>
            </div>
        </div>
    </div>`;
            $('body').append(detailModalHtml);

            // Event pre načítanie hodnôt do modalu
            $(document).on('show.bs.modal', '#detailScanModal', function (event) {
                const button = $(event.relatedTarget);
                const fullPack = button.data('full-pack');
                const itemId = button.data('item-id');
                const stocktakeId = button.data('stocktake');

                const modal = $(this);
                modal.find('input[name="full_pack"]').val(fullPack);
                modal.find('input[name="id"]').val(itemId);
                modal.find('input[name="stocktake"]').val(stocktakeId);
            });

            // Event pre odoslanie formulára
            $(document).on('submit', '#detailScanForm', function(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = form.find('[type="submit"]');

                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Ukladám...');

                $.ajax({
                    url: '{{ route('stocktake.data.update.full-pack') }}',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#detailScanModal').modal('hide');
                            getData();
                            showToast('Úspešne uložené', 'success');
                        } else {
                            showToast(response.message || 'Chyba pri ukladaní', 'error');
                        }
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Serverová chyba';
                        showToast(msg, 'error');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html('Uložiť');
                    }
                });
            });

            // ----------------------------
            // CARGO DATA MODAL
            // ----------------------------
            const cargoModalHtml = `
    <div class="modal fade" id="addCargoDataModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pomôž nám zlepšiť túto službu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addCargoDataForm">
                    <div class="modal-body" id="cargoModalBody">
                        <!-- Dynamicky sa naplní -->
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ean">
                        <input type="hidden" name="_token" value="${tokenInput.val()}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                        <button type="submit" class="btn btn-danger">Aktualizovať</button>
                    </div>
                </form>
            </div>
        </div>
    </div>`;
            $('body').append(cargoModalHtml);

            // Event pre načítanie hodnôt do cargo modalu
            $(document).on('show.bs.modal', '#addCargoDataModal', function (event) {
                const button = $(event.relatedTarget);
                const ean = button.data('ean');
                const itemName = button.data('item-name');
                const hasWeightFull = button.data('has-weight-full');
                const hasWeightEmpty = button.data('has-weight-empty');

                let modalBody = `
            <p>
                <span style="color: red; font-weight: bold">
                    Údaje zadávajte pravdivo, v prípade zlého vyplnenie vám to môže
                    spôsobiť zlé výsledky inventury / uzávierky..
                </span>
                <br><br>
                Pre produkt: <b>${itemName}</b> nemáme doplnené nasledujúce údaje:<br>
            </p>
            <div class="form-group">
                <div class="row">`;

                if (!hasWeightFull) {
                    modalBody += `
                <div class="col-12">
                    Zadajte váhu plnej fľaša (v gramoch)<br>
                    <input type="number" name="weight_full" class="form-control">
                </div>`;
                }

                if (!hasWeightEmpty) {
                    modalBody += `
                <div class="col-12"><br>
                    Zadajte váhu prázdnej fľaša (v gramoch)<br>
                    <input type="number" name="weight_empty" class="form-control">
                </div>`;
                }

                modalBody += `</div></div>`;

                const modal = $(this);
                modal.find('#cargoModalBody').html(modalBody);
                modal.find('input[name="ean"]').val(ean);
            });
            $(document).on('click', '.delete-product', function() {
                const button = $(this);
                const scanId = button.data('scan-id');
                const stocktakeId = button.data('stocktake-id');

                if (!confirm('Naozaj chcete odstrániť tento produkt?')) {
                    return;
                }

                button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Odstraňujem...');

                $.ajax({
                    url: '{{ route('stocktake.data.delete.scan') }}',
                    type: 'POST',
                    data: {
                        _token: tokenInput.val(),
                        scan_id: scanId,
                        stocktake_id: stocktakeId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showToast('Produkt bol odstránený', 'success');
                        } else {
                            showToast(response.message || 'Chyba pri odstraňovaní', 'error');
                        }
                        setTimeout(() => {
                            getData();
                        }, 500);
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Serverová chyba';
                        showToast(msg, 'error');
                    },
                    complete: function() {
                        button.prop('disabled', false).html('Odstrániť');
                    }
                });
            });
            // Event pre odoslanie cargo formulára
            $(document).on('submit', '#addCargoDataForm', function(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = form.find('[type="submit"]');

                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Ukladám...');

                $.ajax({
                    url: '{{ route('stocktake.data.update.weight') }}',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#addCargoDataModal').modal('hide');
                            getData();
                            showToast('Údaje boli aktualizované', 'success');
                        } else {
                            showToast(response.message || 'Chyba pri ukladaní', 'error');
                        }
                    },
                    error: function(xhr) {
                        const msg = xhr.responseJSON?.message || 'Serverová chyba';
                        showToast(msg, 'error');
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html('Aktualizovať');
                    }
                });
            });

            // ----------------------------
            // DATA PROCESSING FUNCTIONS
            // ----------------------------
            const processMoneyState = (moneyState, item, scanData) => {
                let totalStockPriceCalc = 0;
                if(item.type === 0){
                    const volumeWeight = item.weight_full - item.weight_empty;
                    const tolerance = scanData.weight_tolerance || 10;
                    let fullPack = scanData.full_pack;

                    if (scanData.weight >= (item.weight_full - tolerance)) {
                        fullPack++;
                        volume = scanData.weight - (item.weight_full - tolerance);
                        if (volume >= (item.weight_full - tolerance)) {
                            fullPack++;
                            volume = volume - (item.weight_full - tolerance);
                        }
                        volume = (0).toFixed(0);
                    } else {
                        volume = ((scanData.weight - item.weight_empty) / (volumeWeight / item.volume)).toFixed(0);
                    }
                    const totalVolume = (item.volume * fullPack) + parseInt(volume);
                    totalStockPriceCalc = totalVolume * moneyState.hodnota_ml;
                } else {
                    totalStockPriceCalc = scanData.full_pack * moneyState.hodnota_ml;
                }


                const bottleWarning = getWarningIcon(
                    !moneyState.bottle_data_set,
                    "Dáta nie su správne => Doplň údaje"
                );

                const invWarning = getWarningIcon(
                    moneyState.last_inv_exist,
                    "Nedostatok dát, ešte nebola vykonaná inventúra."
                );

                const content = moneyState.predany_obsah ?
                    `Predaný obsah: ${formatVolume(moneyState.predany_obsah)}` :
                    'Nie sú vyplnené potrebné údaje';
                totalStockPriceValue += Number(totalStockPriceCalc ?? 0);


                const costs = moneyState.naklady_spolu ?
                    `<b>Náklady: ${formatMoney(moneyState.naklady_spolu)}</b>` :
                    'Náklady: - €';
                const costsMl = moneyState.hodnota_ml ?
                    `<b>Hodnota: ${formatMoney(totalStockPriceCalc)}</b>` :
                    'Hodnota: - €';

                const revenue = moneyState.trzba_spolu ?
                    `<b>Tržba: ${formatMoney(moneyState.trzba_spolu)}</b>` :
                    'Tržba: - €';
                let priceDetailBuy = '';
                let priceDetail = '';
                if(moneyState.naklady_spolu || moneyState.trzba_spolu){
                    priceDetailBuy += `<small style="font-size: 10px;">`
                    if(moneyState.naklady_spolu){
                        priceDetailBuy += costs+` | `
                    }
                    if(moneyState.trzba_spolu){
                        priceDetailBuy += revenue+` | `
                    }
                    priceDetailBuy += `</small>`
                }

                priceDetail += priceDetailBuy;

                if(moneyState.hodnota_ml){
                    if(priceDetail){
                        priceDetail += `<br>`;
                    }
                    priceDetail += `<small style="font-size: 10px;">${costsMl}</small>`
                }


                if (moneyState.trzba_spolu) {
                    const profit = moneyState.zisk_spolu;
                    const color = profit > 0 ? 'green' : 'red';
                    return `${invWarning}${bottleWarning}<b style="color: ${color}" data-toggle="tooltip" title="${content}">${formatMoney(profit)}</b><br>${priceDetail}`;
                }

                return `${invWarning}${bottleWarning}<b style="color: red" data-toggle="tooltip" title="${content}">- €</b><br>${priceDetail}`;
            };

            const getData = () => {
                const searchArray = updateDataInputs.map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '{{ route('stocktake.data.update') }}',
                    data: {
                        '_token': tokenInput.val(),
                        'q': searchArray,
                        'stocktake_id': "{{ $stocktake->id }}"
                    },
                    success: processDataResponse,
                    error: hideLoading
                });
            };

            const processDataResponse = (data) => {
                totalStockPriceValue = 0;
                data.item.forEach(item => {
                    const ean = String(item.ean);
                    const scanData = data.data_scan[ean] || {};
                    const moneyStateHtml = processMoneyState(scanData.money_state || {}, item, scanData);

                    if (totalRevenueElement.length) {
                        totalRevenueElement.text(data.zisky_spolu ? Number(data.zisky_spolu).toFixed(2) : '0');
                    }
                    totalStockPrice.text(totalStockPriceValue ? totalStockPriceValue.toFixed(2) : '0');

                    if(totalStockPriceValue > 0){
                        totalStockPriceCard.show();
                    }
                    if (item.type === 1) {
                        processType1Item(item, scanData, ean, moneyStateHtml);
                    } else {
                        processType0Item(item, scanData, ean, moneyStateHtml);
                    }
                });

                initTooltips();
                hideLoading();
            };

            const safeEanSelector = (ean) => {
                const escaped = $.escapeSelector(ean);
                return `[data-ean="${escaped}"]`;
            };

            const processType1Item = (item, scanData, ean, moneyStateHtml) => {
                $(safeEanSelector(ean)).remove();
                updateDataArray.append(`<input type="hidden" data-ean="${ean}" name="updateDataArrayInput[]" value="${ean}">`);

                t.row(`#table_${ean}`).remove().draw(false);
                t.row.add([
                    `${item.name} (${item.alcohol} %)`,
                    `<b style="color: green">${scanData.full_pack} ks</b>
         <button class="btn btn-sm btn-success float-right"
                 data-toggle="modal"
                 data-target="#detailScanModal"
                 data-item-id="${scanData.scan_id}"
                 data-stocktake="${scanData.stocktake_id}"
                 data-full-pack="${scanData.full_pack}">
             +
         </button>`,
                    scanData.scan_user,
                    ean,
                    moneyStateHtml,
                    `<button class="btn btn-danger delete-product"
                 data-scan-id="${scanData.scan_id}"
                 data-stocktake-id="${scanData.stocktake_id}">
            Odstrániť
        </button>`
                ]).node().id = `table_${ean}`;
                t.draw(false);
            };

            const processType0Item = (item, scanData, ean, moneyStateHtml) => {
                $(safeEanSelector(ean)).remove();
                updateDataArray.append(`<input type="hidden" data-ean="${ean}" name="updateDataArrayInput[]" value="${ean}">`);

                if (item.weight_full && item.weight_empty) {
                    processValidWeights(item, scanData, ean, moneyStateHtml);
                } else {
                    processMissingWeights(item, scanData, ean, moneyStateHtml);
                }
            };

            const processValidWeights = (item, scanData, ean, moneyStateHtml) => {
                const volumeWeight = item.weight_full - item.weight_empty;
                const tolerance = scanData.weight_tolerance || 10;
                let fullPack = scanData.full_pack;
                let volume = scanData.weight;

                if (scanData.weight >= (item.weight_full - tolerance)) {
                    fullPack++;
                    volume = scanData.weight - (item.weight_full - tolerance);
                    if (volume >= (item.weight_full - tolerance)) {
                        fullPack++;
                        volume = volume - (item.weight_full - tolerance);
                    }
                    volume = (0).toFixed(0);
                } else {
                    volume = ((scanData.weight - item.weight_empty) / (volumeWeight / item.volume)).toFixed(0);
                }

                const totalVolume = (item.volume * fullPack) + parseInt(volume);
                const color = volume >= 0 ? 'green' : 'red';
                const nameDisplay = volume >= 0 ?
                    `${item.name} (${item.volume} ml, ${item.alcohol} %)` :
                    `<b style="color: red">${item.name} (${item.volume} ml, ${item.alcohol} %)</b>`;

                t.row(`#table_${ean}`).remove().draw(false);
                t.row.add([
                    nameDisplay,
                    `<b style="color: ${color}">${volume} ml (${fullPack} ks) [Spolu: ${totalVolume/1000} l]</b>
             <button class="btn btn-sm btn-success float-right"
                     data-toggle="modal"
                     data-target="#detailScanModal"
                     data-item-id="${scanData.scan_id}"
                     data-stocktake="${scanData.stocktake_id}"
                     data-full-pack="${scanData.full_pack}">
                 +
             </button>`,
                    scanData.scan_user,
                    ean,
                    moneyStateHtml,
                    `<button class="btn btn-danger delete-product"
                             data-scan-id="${scanData.scan_id}"
                             data-stocktake-id="${scanData.stocktake_id}">
                        Odstrániť
                    </button>`
                ]).node().id = `table_${ean}`;
                t.draw(false);
            };

            const processMissingWeights = (item, scanData, ean, moneyStateHtml) => {
                alertWeightNull.show();

                const tolerance = scanData.weight_tolerance || 10;
                let fullPack = scanData.full_pack;
                let weight = scanData.weight;

                if (scanData.weight >= (item.weight_full - tolerance) && scanData.weight > 0) {
                    fullPack++;
                    weight = 0;
                } else {
                    weight = ((scanData.weight - item.weight_empty) /
                        ((item.weight_full - item.weight_empty) / item.volume)).toFixed(0);
                }

                t.row(`#table_${ean}`).remove().draw(false);
                t.row.add([
                    `${item.name} (${item.volume} ml, ${item.alcohol} %)`,
                    `<b style="color: red">${weight} g (${fullPack} ks)</b>
             <button class="btn btn-sm btn-success float-right"
                     data-toggle="modal"
                     data-target="#detailScanModal"
                     data-item-id="${scanData.scan_id}"
                     data-stocktake="${scanData.stocktake_id}"
                     data-full-pack="${scanData.full_pack}">
                 +
             </button>
             <button class="btn btn-sm btn-warning float-right" style="margin-right: 10px"
                     data-toggle="modal"
                     data-target="#addCargoDataModal"
                     data-ean="${ean}"
                     data-item-name="${item.name}"
                     data-has-weight-full="${!!item.weight_full}"
                     data-has-weight-empty="${!!item.weight_empty}">
                 Doplniť údaje
             </button>`,
            scanData.scan_user,
            ean,
            moneyStateHtml,
            `<button class="btn btn-danger delete-product"
                     data-scan-id="${scanData.scan_id}"
                     data-stocktake-id="${scanData.stocktake_id}">
                Odstrániť
            </button>`
        ]).node().id = `table_${ean}`;
        t.draw(false);
    };

    const checkForUpdates = () => {
        const searchArray = updateDataInputs.map(function() {
            return $(this).val();
        }).get();

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '{{ route('stocktake.data.check.update') }}',
            data: {
                '_token': tokenInput.val(),
                'q': searchArray,
                'stocktake_id': "{{ $stocktake->id }}"
            },
            success: function(data) {
                if (data.reload) {
                    getData();
                    hideLoading();
                }
            },
            error: function(error) {
                console.error('Error checking for updates:', error);
                hideLoading();
            }
        });
    hideLoading();
    };

    // Initialize
      hideLoading();
        const updateInterval = setInterval(checkForUpdates, 1000);
        getData();
});
</script>
@endsection
