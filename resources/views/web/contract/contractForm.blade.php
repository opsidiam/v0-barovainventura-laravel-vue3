@extends('web.layouts.app')
@section('content')

    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"> <img src="{{asset('web/images/banner-shape1.png')}}" alt="image"> </span>
            <span class="banner_shape2"> <img src="{{asset('web/images/banner-shape2.png')}}" alt="image"> </span>
            <span class="banner_shape3"> <img src="{{asset('web/images/banner-shape3.png')}}" alt="image"> </span>

            <div class="bred_text">
                <h1>{{ __('web.contract.title') }}</h1>
                <p>{{ __('web.contract.text') }}</p>
            </div>
        </div>
    </div>
    @if($contract->name == null)
        <section class="contact_page_section pb-5">
        <div class="container">
            <div class="contact_inner">
                <div class="contact_form col-12">
                    <div class="section_title">
                        <h2>{!! __('web.contract.form_title') !!}</h2>
                        <p>{{ __('web.contract.form_text') }}</p>
                    </div>
                    <form id="contractForm" method="POST" action="{{ route('contract.contact.submit') }}" validate>
                        @csrf
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                        <input type="hidden" id="hash" name="hash" value="{{$contract->hash}}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="company">Názov firmy (voliteľné)</label>
                                <input
                                    type="text"
                                    id="company"
                                    name="company"
                                    class="form-control @error('company') is-invalid @enderror"
                                    value="{{ old('company') }}"
                                    maxlength="100"
                                    autocomplete="organization">
                                @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím platný názov firmy (max. 100 znakov).</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="name">Meno *</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    required minlength="2" maxlength="50" autocomplete="given-name">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím platné meno (2–50 znakov).</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="surname">Priezvisko *</label>
                                <input
                                    type="text"
                                    id="surname"
                                    name="surname"
                                    class="form-control @error('surname') is-invalid @enderror"
                                    value="{{ old('surname') }}"
                                    required minlength="2" maxlength="50" autocomplete="family-name">
                                @error('surname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím platné priezvisko (2–50 znakov).</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date_ico">IČO / dátum narodenia *</label>
                                <input
                                    type="text"
                                    id="date_ico"
                                    name="date_ico"
                                    class="form-control @error('date_ico') is-invalid @enderror"
                                    value="{{ old('date_ico') }}"
                                    required maxlength="50" autocomplete="off"
                                    placeholder="napr. 12345678 alebo 01.01.1990">
                                @error('date_ico')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím IČO alebo dátum narodenia.</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address">Adresa (ulica a číslo) *</label>
                                <input
                                    type="text"
                                    id="address"
                                    name="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address') }}"
                                    required minlength="3" maxlength="120" autocomplete="address-line1">
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím adresu.</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="delivery_city">Mesto *</label>
                                <input
                                    type="text"
                                    id="city"
                                    name="city"
                                    class="form-control @error('city') is-invalid @enderror"
                                    value="{{ old('city') }}"
                                    required minlength="2" maxlength="60" autocomplete="shipping address-level2">
                                @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím mesto.</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="postal">PSČ *</label>
                                <input
                                    type="text"
                                    id="postal"
                                    name="postal"
                                    class="form-control @error('postal') is-invalid @enderror"
                                    value="{{ old('postal') }}"
                                    required maxlength="10" autocomplete="shipping postal-code"
                                    placeholder=" napr. 811 01">
                                @error('postal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím PSČ.</div>
                                    @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country">Krajina *</label>
                                <input
                                    type="text"
                                    id="country"
                                    name="country"
                                    class="form-control @error('country') is-invalid @enderror"
                                    value="{{ old('country', 'Slovensko') }}"
                                    required maxlength="60" autocomplete="shipping country-name">
                                @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím krajinu.</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="phone">Telefón *</label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}"
                                    required maxlength="30" autocomplete="tel"
                                    placeholder="+421 9xx xxx xxx">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím platné telefónne číslo.</div>
                                    @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Doručovacie údaje --}}
                        <h5 class="mb-3">Doručovacie údaje</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="delivery_name">Kontaktná osoba *</label>
                                <input
                                    type="text"
                                    id="delivery_name"
                                    name="delivery_name"
                                    class="form-control @error('delivery_name') is-invalid @enderror"
                                    value="{{ old('delivery_name') }}"
                                    required minlength="2" maxlength="80" autocomplete="name">
                                @error('delivery_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím meno a priezvisko.</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="delivery_phone">Telefón na doručenie *</label>
                                <input
                                    type="tel"
                                    id="delivery_phone"
                                    name="delivery_phone"
                                    class="form-control @error('delivery_phone') is-invalid @enderror"
                                    value="{{ old('delivery_phone') }}"
                                    required maxlength="30" autocomplete="tel">
                                @error('delivery_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím telefón.</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="delivery_address">Adresa (ulica a číslo) *</label>
                                <input
                                    type="text"
                                    id="delivery_address"
                                    name="delivery_address"
                                    class="form-control @error('delivery_address') is-invalid @enderror"
                                    value="{{ old('delivery_address') }}"
                                    required minlength="3" maxlength="120" autocomplete="shipping address-line1">
                                @error('delivery_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím doručovaciu adresu.</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="delivery_city">Mesto *</label>
                                <input
                                    type="text"
                                    id="delivery_city"
                                    name="delivery_city"
                                    class="form-control @error('delivery_city') is-invalid @enderror"
                                    value="{{ old('delivery_city') }}"
                                    required minlength="2" maxlength="60" autocomplete="shipping address-level2">
                                @error('delivery_city')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím mesto.</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="delivery_postal">PSČ *</label>
                                <input
                                    type="text"
                                    id="delivery_postal"
                                    name="delivery_postal"
                                    class="form-control @error('delivery_postal') is-invalid @enderror"
                                    value="{{ old('delivery_postal') }}"
                                    required maxlength="10" autocomplete="shipping postal-code"
                                    placeholder=" napr. 811 01">
                                @error('delivery_postal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím PSČ.</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="delivery_country">Krajina *</label>
                                <input
                                    type="text"
                                    id="delivery_country"
                                    name="delivery_country"
                                    class="form-control @error('delivery_country') is-invalid @enderror"
                                    value="{{ old('delivery_country', 'Slovensko') }}"
                                    required maxlength="60" autocomplete="shipping country-name">
                                @error('delivery_country')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím krajinu.</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="form-check-input @error('vop') is-invalid @enderror" type="checkbox" id="VOP" name="vop" value="1" required>
                            <label class="form-check-label" for="VOP">
                                Súhlasím so spracovaním osobných údajov podľa <a href="{{ route('gdpr') }}" target="_blank" rel="noopener">GDPR</a>
                            </label>
                            @error('vop')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn puprple_btn">Odoslať</button>
                    </form>


                </div>
            </div>
        </div>
    </section>
    @elseif($contract->signed == false)
        <section class="contact_page_section pb-5">
            <div class="container">
                <div class="contact_inner">
                    <div class="contact_form col-12">
                        <div class="section_title">
                            <h2>{!! __('web.contract.form_done_title') !!}</h2>
                            <p>{{ __('web.contract.form_done_text') }}</p>
                        </div>

                        {{-- Akčný riadok: stiahnuť zmluvu --}}
                        <div class="mb-4 d-flex flex-wrap align-items-center">
                            <a
                                href="{{route('contract.download',['hash' => $contract->hash])}}"
                                class="btn puprple_btn mr-3"
                                target="_blank" rel="noopener"
                            >
                                <i class="fas fa-file-download mr-1"></i>
                                {{ __('web.contract.download_pdf_button') ?? 'Stiahnuť zmluvu (PDF)' }}
                            </a>
                            <small class="text-muted">
                                {{ __('web.contract.download_help') ?? 'Stiahnite si zmluvu, vytlačte ju a podpíšte.' }}
                            </small>
                        </div>

                        {{-- Upload podpisanej zmluvy --}}
                        <form id="contractForm"
                              method="POST"
                              action="{{ route('contract.upload.submit') }}"
                              enctype="multipart/form-data"
                              validate>
                            @csrf
                            <input type="hidden" name="hash" value="{{ $hash ?? request('hash') }}">

                            <p class="mb-3">
                                {{ __('web.contract.upload_hint') ?? 'Naskenujte podpísanú zmluvu a nahrajte ju nižšie (PDF alebo obrázok).' }}
                            </p>

                            <div class="form-group">
                                <label for="signed_contract">{{ __('web.contract.upload_label') ?? 'Podpísaná zmluva (PDF/JPG/PNG)' }} *</label>
                                <input
                                    type="file"
                                    id="signed_contract"
                                    name="signed_contract"
                                    class="form-control-file @error('signed_contract') is-invalid @enderror"
                                    accept="application/pdf,image/*"
                                    required
                                >
                                @error('signed_contract')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @else
                                    <small class="form-text text-muted">
                                        {{ __('web.contract.upload_note') ?? 'Max. 10 MB. Povolené formáty: PDF, JPG, PNG.' }}
                                    </small>
                                    @enderror
                            </div>

                            <button type="submit" class="btn puprple_btn">
                                <i class="fas fa-paper-plane mr-1"></i>
                                {{ __('web.contract.submit_button') ?? 'Odoslať' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="contact_page_section pb-5">
            <div class="container">
                <div class="contact_inner">
                    <div class="contact_form col-12">
                        <div class="section_title">
                            <h2>{!! __('web.contract.form_done_title') !!}</h2>
                        </div>

                        <div class="align-items-center pt-5">
                           <p class="text-center">
                               {!! __('web.contract.upload_done') !!}
                           </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('scripts')
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                const form = document.querySelector('form[validate]');
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }, false);
        })();
    </script>
@endsection
