@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">

                {{-- Header + späť --}}
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-3">
                    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">
                        {{ __('admin.partner_create_title') ?? 'Pridať obchodníka' }}
                    </h1>
                    <div>
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-light border">
                            <i class="fas fa-arrow-left mr-1"></i> {{ __('admin.back_to_list') ?? 'Späť na zoznam' }}
                        </a>
                    </div>
                </div>

                {{-- Chybové hlášky (global) --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>{{ __('admin.form_has_errors') ?? 'Formulár obsahuje chyby.' }}</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form karta --}}
                <div class="card shadow">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('admin.partner_basic_info') ?? 'Základné údaje' }}
                        </h6>
                        <small class="text-muted d-none d-sm-inline">
                            {{ __('admin.required_hint') ?? 'Polia označené * sú povinné.' }}
                        </small>
                    </div>

                    <form method="POST" action="{{ route('admin.partners.store') }}" novalidate>
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="first_name">{{ __('admin.table.first_name') ?? 'Meno' }} *</label>
                                    <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name') }}"
                                        required
                                        maxlength="100">
                                    @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="last_name">{{ __('admin.table.last_name') ?? 'Priezvisko' }} *</label>
                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name') }}"
                                        required
                                        maxlength="100">
                                    @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="company">{{ __('admin.table.company') ?? 'Firma' }}</label>
                                    <input
                                        type="text"
                                        id="company"
                                        name="company"
                                        class="form-control @error('company') is-invalid @enderror"
                                        value="{{ old('company') }}"
                                        maxlength="150">
                                    @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="email">{{ __('admin.table.mail') ?? 'E-mail' }} *</label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}"
                                        required
                                        maxlength="150">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="phone">{{ __('admin.table.phone') ?? 'Telefón' }}</label>
                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}"
                                        maxlength="40"
                                        placeholder="+421 9xx xxx xxx">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="commission">{{ __('admin.table.commission') ?? 'Odmena za klienta (€)' }}</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="commission"
                                        name="commission"
                                        class="form-control @error('commission') is-invalid @enderror"
                                        value="{{ old('commission', 20) }}">
                                    @error('commission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        {{ __('admin.commission_help') ?? 'Predvolene 20 € za jedného priradeného klienta (vypláca sa po zakúpení licencie).' }}
                                    </small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">{{ __('admin.table.note') ?? 'Poznámka' }}</label>
                                <textarea
                                    id="note"
                                    name="note"
                                    rows="3"
                                    class="form-control @error('note') is-invalid @enderror"
                                    maxlength="1000"
                                >{{ old('note') }}</textarea>
                                @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-light border">
                                <i class="fas fa-times mr-1"></i> {{ __('admin.cancel') ?? 'Zrušiť' }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> {{ __('admin.save') ?? 'Uložiť' }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Bootstrap 4 client-side “was-validated”
        (function(){
            'use strict';
            const forms = document.getElementsByTagName('form');
            Array.prototype.forEach.call(forms, function(form){
                form.addEventListener('submit', function(e){
                    if (form.checkValidity() === false) {
                        e.preventDefault(); e.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
