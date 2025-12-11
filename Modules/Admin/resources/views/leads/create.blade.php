@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Vytvoriť lead</h1>

                <div class="card shadow mb-4">
                    <div class="card-body col-xl-12 col-sm-6">
                        <form id="leadCreateForm" action="{{ route('admin.leads.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12">
                                    <h2>Nový lead</h2>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">Meno <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="lead-first-name" name="first_name" class="form-control" placeholder="Meno" required>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">Priezvisko</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="lead-last-name" name="last_name" class="form-control" placeholder="Priezvisko">
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">E-mail <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="email" id="lead-email" name="email" class="form-control" placeholder="meno@example.com" required>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-12">
                                    <label class="form-label">Telefón</label>
                                    <div class="input-group mb-3">
                                        <input type="tel" id="lead-phone" name="phone" class="form-control" placeholder="+421 9xx xxx xxx">
                                    </div>
                                </div>

                                {{-- NÁZOV FIRMY / PODNIKU --}}
                                <div class="col-xl-4 col-sm-12">
                                    <label class="form-label">Názov firmy / podniku</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="lead-company" name="company" class="form-control" placeholder="Firma alebo podnik">
                                    </div>
                                </div>

                                {{-- ADRESA --}}
                                <div class="col-xl-4 col-sm-12">
                                    <label class="form-label">Adresa</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="lead-address" name="address" class="form-control" placeholder="Ulica a číslo">
                                    </div>
                                </div>

                                {{-- MESTO --}}
                                <div class="col-xl-4 col-sm-12">
                                    <label class="form-label">Mesto</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="lead-city" name="city" class="form-control" placeholder="Mesto">
                                    </div>
                                </div>

                                <div class="col-xl-9 col-sm-12">
                                    <label class="form-label">Poznámka</label>
                                    <div class="input-group mb-3">
                                        <textarea id="lead-note" name="note" class="form-control" rows="3" placeholder="Doplňujúce informácie (voliteľné)"></textarea>
                                    </div>
                                </div>

                                {{-- HIDDEN FIELDS --}}
                                <input type="hidden" name="source" value="admin">
                                <input type="hidden" name="status" value="new">
                                <input type="hidden" name="open" value="1">
                                <input type="hidden" id="lead-data" name="data" value="{}">

                                <div class="col-xl-6 col-sm-12">
                                    <label class="form-label" style="color:white">.</label>
                                    <button type="submit" class="btn btn-block btn-xl btn-success">Uložiť</button>
                                </div>
                            </div>

                            {{-- VALIDATION ERRORS --}}
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- SUCCESS MESSAGE --}}
                            @if (session('success'))
                                <div class="alert alert-success mt-3">{{ session('success') }}</div>
                            @endif
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('leadCreateForm').addEventListener('submit', function (e) {
            const payload = {};

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

            for (const [key, value] of Object.entries(fields)) {
                if (value !== '') {
                    payload[key] = value;
                }
            }

            document.getElementById('lead-data').value = JSON.stringify(payload);
        });
    </script>

@endsection
