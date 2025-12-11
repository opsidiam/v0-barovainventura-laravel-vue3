@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Upraviť lead</h1>

                <div class="card shadow mb-4">
                    <div class="card-body col-xl-12 col-sm-6">
                        <form id="leadEditForm" action="{{ route('admin.leads.update', $lead) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @php
                                $d = is_array($lead->data) ? $lead->data : (json_decode($lead->data ?? '{}', true) ?? []);
                                $reserved = ['meno','priezvisko','email','telefon','firma','adresa','mesto','poznamka'];
                                $custom = collect($d)->filter(fn($v,$k)=>!in_array($k,$reserved))->toArray();
                            @endphp

                            <div class="row">
                                <div class="col-sm-12">
                                    <h2>Lead #{{ $lead->id }}</h2>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">Meno <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input
                                            type="text"
                                            id="lead-first-name"
                                            class="form-control"
                                            placeholder="Meno"
                                            value="{{ old('first_name', $d['meno'] ?? '') }}"
                                            required
                                        >
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">Priezvisko</label>
                                    <div class="input-group mb-3">
                                        <input
                                            type="text"
                                            id="lead-last-name"
                                            class="form-control"
                                            placeholder="Priezvisko"
                                            value="{{ old('last_name', $d['priezvisko'] ?? '') }}"
                                        >
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">E-mail <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input
                                            type="email"
                                            id="lead-email"
                                            class="form-control"
                                            placeholder="meno@example.com"
                                            value="{{ old('email', $d['email'] ?? '') }}"
                                            required
                                        >
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">Telefón</label>
                                    <div class="input-group mb-3">
                                        <input
                                            type="tel"
                                            id="lead-phone"
                                            class="form-control"
                                            placeholder="+421 9xx xxx xxx"
                                            value="{{ old('phone', $d['telefon'] ?? '') }}"
                                        >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-sm-12">
                                    <label class="form-label">Názov firmy / podniku</label>
                                    <div class="input-group mb-3">
                                        <input
                                            type="text"
                                            id="lead-company"
                                            class="form-control"
                                            placeholder="Firma alebo podnik"
                                            value="{{ old('company', $d['firma'] ?? '') }}"
                                        >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-sm-12">
                                    <label class="form-label">Adresa</label>
                                    <div class="input-group mb-3">
                                        <input
                                            type="text"
                                            id="lead-address"
                                            class="form-control"
                                            placeholder="Ulica a číslo"
                                            value="{{ old('address', $d['adresa'] ?? '') }}"
                                        >
                                    </div>
                                </div>

                                <div class="col-xl-4 col-sm-12">
                                    <label class="form-label">Mesto</label>
                                    <div class="input-group mb-3">
                                        <input
                                            type="text"
                                            id="lead-city"
                                            class="form-control"
                                            placeholder="Mesto"
                                            value="{{ old('city', $d['mesto'] ?? '') }}"
                                        >
                                    </div>
                                </div>

                                <div class="col-xl-12 col-sm-12">
                                    <label class="form-label">Poznámka</label>
                                    <div class="input-group mb-3">
                                        <textarea
                                            id="lead-note"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Doplňujúce informácie (voliteľné)"
                                        >{{ old('note', $d['poznamka'] ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">Stav</label>
                                    <div class="input-group mb-3">
                                        @php $curr = old('status', $lead->status); @endphp
                                        <select name="status" class="form-control">
                                            <option value="new"     {{ $curr === 'new' ? 'selected' : '' }}>new</option>
                                            <option value="contact" {{ $curr === 'contact' ? 'selected' : '' }}>contact</option>
                                            <option value="waiting" {{ $curr === 'waiting' ? 'selected' : '' }}>waiting</option>
                                            <option value="close"   {{ $curr === 'close' ? 'selected' : '' }}>close</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label d-block">Otvorený</label>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="lead-open" name="open" value="1"
                                            {{ old('open', $lead->open) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lead-open">Lead je otvorený</label>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-sm-12">
                                    <h5 class="mb-3">Notifikácie
                                        @if((int)$lead->send_mail === 2)
                                            <span class="badge badge-danger">
                                              Odosielanie je vypnuté
                                            </span>
                                        @endif
                                    </h5>

                                    @php
                                        $getFlag = function($key) use ($lead, $d) {
                                            return !empty($lead?->{$key.'_sent'})
                                                || !empty($lead?->{$key.'_at'})
                                                || (!is_null($lead?->{$key}) && $lead?->{$key})
                                                || (!empty($d[$key]));
                                        };

                                        $sentMail         = $getFlag('send_mail');
                                        $sentLeadMessage  = $getFlag('send_lead_message');
                                        $sentCp           = $getFlag('send_cp');
                                    @endphp

                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <div class="mr-3 mb-2">
                                            <div class="small text-muted mb-1">Povolenie odoslania</div>

                                            @if((int)$lead->send_mail === 2)
                                                <a href="{{ route('admin.leads.resend', $lead->id) }}?type=send_mail"
                                                   class="btn btn-sm btn-outline-primary"
                                                   onclick="return confirm('Povoliť odosielanie e-mailov pre tento lead?');">
                                                    <i class="fas fa-check-circle mr-1"></i> Povoliť odoslanie
                                                </a>
                                            @else
                                                <a href="{{ route('admin.leads.resend', $lead->id) }}?type=send_mail_off"
                                                   class="btn btn-sm btn-outline-danger"
                                                   onclick="return confirm('Blokovať odosielanie e-mailov pre tento lead?');">
                                                    <i class="fas fa-times-circle mr-1"></i> Blokovať odoslanie
                                                </a>
                                            @endif
                                        </div>

                                        <div class="mr-3 mb-2">
                                            <div class="small text-muted mb-1">Poďakovanie za kontakt</div>
                                            @if((int)$lead->send_lead_message === 2)
                                                <a href="{{ route('admin.leads.resend', $lead->id) }}?type=send_lead_message"
                                                   class="btn btn-sm btn-outline-info"
                                                   onclick="return confirm('Odoslať poďakovací e-mail klientovi?');">
                                                    <i class="fas fa-envelope-open-text mr-1"></i> Odoslať poďakovanie
                                                </a>
                                            @elseif((int)$lead->send_lead_message === 0)
                                                <span class="badge badge-warning">
                                                  <i class="fas fa-paper-plane mr-1"></i> Odosielam
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                  <i class="fas fa-paper-plane mr-1"></i> Odoslané
                                                </span>
                                            @endif
                                        </div>

                                        <div class="mr-3 mb-2">
                                            <div class="small text-muted mb-1">Cenová ponuka</div>
                                            @if((int)$lead->send_cp === 2)
                                                <a href="{{ route('admin.leads.resend', $lead->id) }}?type=send_cp"
                                                   class="btn btn-sm btn-outline-secondary"
                                                   onclick="return confirm('Odoslať cenovú ponuku klientovi?');">
                                                    <i class="fas fa-file-invoice-dollar mr-1"></i> Odoslať ponuku
                                                </a>

                                            @elseif((int)$lead->send_cp === 0)
                                                <span class="badge badge-warning">
                                                  <i class="fas fa-paper-plane mr-1"></i> Odosielam
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                  <i class="fas fa-check mr-1"></i> Odoslané
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                    <small class="text-muted">
                                        Poznámka: <code>E-maily sa odosielajú len v čase od 7:00 do 20:00.</code>
                                    </small>
                                </div>

                                <div class="col-12">
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">Ďalšie údaje (voliteľné)</h5>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-custom-row">
                                            + Pridať položku
                                        </button>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered align-middle mb-3" id="custom-table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th style="width: 30%">Kľúč</th>
                                                <th>Hodnota</th>
                                                <th style="width: 1%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($custom as $k => $v)
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control custom-key" placeholder="napr. ico" value="{{ $k }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control custom-value" placeholder="hodnota" value="{{ is_scalar($v) ? $v : json_encode($v) }}">
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-row">&times;</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <small class="text-muted">
                                        Poznámka: vyhni sa kľúčom <code>meno, priezvisko, email, telefon, firma, adresa, mesto, poznamka</code> – tie sú vyhradené.
                                    </small>
                                </div>

                                <input type="hidden" name="source" value="{{ old('source', $lead->source) }}">
                                <input type="hidden" id="lead-data" name="data" value="{}">

                                <div class="col-xl-6 col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-block btn-xl btn-primary">Uložiť zmeny</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        (function(){
            const reservedKeys = ['meno','priezvisko','email','telefon','firma','adresa','mesto','poznamka'];

            // Pridanie nového riadku custom
            document.getElementById('add-custom-row').addEventListener('click', function(){
                const tbody = document.querySelector('#custom-table tbody');
                const tr = document.createElement('tr');
                tr.innerHTML = `
            <td><input type="text" class="form-control custom-key" placeholder="napr. ico"></td>
            <td><input type="text" class="form-control custom-value" placeholder="hodnota"></td>
            <td class="text-nowrap"><button type="button" class="btn btn-sm btn-outline-danger remove-row">&times;</button></td>
        `;
                tbody.appendChild(tr);
            });

            // Odstránenie riadku
            document.getElementById('custom-table').addEventListener('click', function(e){
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('tr').remove();
                }
            });

            // Zbalenie dát do JSON
            document.getElementById('leadEditForm').addEventListener('submit', function(){
                const payload = {};

                // statické polia
                const fields = {
                    meno:      document.getElementById('lead-first-name').value.trim(),
                    priezvisko:document.getElementById('lead-last-name').value.trim(),
                    email:     document.getElementById('lead-email').value.trim(),
                    telefon:   document.getElementById('lead-phone').value.trim(),
                    firma:     document.getElementById('lead-company').value.trim(),
                    adresa:    document.getElementById('lead-address').value.trim(),
                    mesto:     document.getElementById('lead-city').value.trim(),
                    poznamka:  document.getElementById('lead-note').value.trim()
                };
                for (const [k,v] of Object.entries(fields)) if (v !== '') payload[k] = v;

                // custom polia (len ak má key aj value a key nie je rezervovaný)
                const rows = document.querySelectorAll('#custom-table tbody tr');
                rows.forEach(row => {
                    const key = row.querySelector('.custom-key')?.value?.trim() || '';
                    const val = row.querySelector('.custom-value')?.value?.trim() || '';
                    if (!key || !val) return;
                    if (reservedKeys.includes(key)) return;
                    payload[key] = val;
                });

                document.getElementById('lead-data').value = JSON.stringify(payload);
            });
        })();
    </script>
@endsection
