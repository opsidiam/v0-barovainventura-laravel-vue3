@extends('web.layouts.app')
@section('content')

    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"> <img src="{{asset('web/images/banner-shape1.png')}}" alt="image"> </span>
            <span class="banner_shape2"> <img src="{{asset('web/images/banner-shape2.png')}}" alt="image"> </span>
            <span class="banner_shape3"> <img src="{{asset('web/images/banner-shape3.png')}}" alt="image"> </span>

            <div class="bred_text">
                <h1>{{ __('web.support.title') }}</h1>
                <p>{{ __('web.support.text') }}</p>
                <ul>
                    <li><a href="{{ route('home') }}">{{ __('web.support.breadcrumbs.home') }}</a></li>
                    <li><span>»</span></li>
                    <li>{{ __('web.support.breadcrumbs.title') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="contact_page_section">
        <div class="container">
            <div class="contact_inner">
                <div class="contact_form col-12">
                    <div class="section_title">
                        <h2>{!! __('web.contact.form_title') !!}</h2>
                        <p>{{ __('web.contact.form_text') }}</p>
                    </div>
                    <form id="supportForm" method="POST" action="{{ route('support.contact.submit') }}" validate>
                        @csrf
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="support_name">Meno *</label>
                                <input
                                    type="text"
                                    id="support_name"
                                    name="support_name"
                                    class="form-control @error('support_name') is-invalid @enderror"
                                    value="{{ old('support_name', Auth::check() ? Auth::user()->name : '') }}"
                                    required minlength="2" maxlength="50" autocomplete="given-name">
                                @error('support_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím platné meno (2–50 znakov).</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="support_surname">Priezvisko *</label>
                                <input
                                    type="text"
                                    id="support_surname"
                                    name="support_surname"
                                    class="form-control @error('support_surname') is-invalid @enderror"
                                    value="{{ old('support_surname', Auth::check() ? Auth::user()->surname : '') }}"
                                    required minlength="2" maxlength="50" autocomplete="family-name">
                                @error('support_surname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím platné priezvisko (2–50 znakov).</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="support_email">E-mail *</label>
                                <input
                                    type="email"
                                    id="support_email"
                                    name="support_email"
                                    class="form-control @error('support_email') is-invalid @enderror"
                                    value="{{ old('support_email', Auth::check() ? Auth::user()->email : '') }}"
                                    required autocomplete="email">
                                @error('support_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím platný e-mail.</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="support_phone">Telefón</label>
                                <input
                                    type="tel"
                                    id="support_phone"
                                    name="support_phone"
                                    class="form-control @error('support_phone') is-invalid @enderror"
                                    value="{{ old('support_phone') }}" autocomplete="tel">
                                @error('support_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Zadajte prosím platné telefónne číslo.</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="where">Kde je problém *</label>
                                <select id="where" class="form-control @error('where') is-invalid @enderror" name="where" required>
                                    <option value="" disabled {{ old('where') ? '' : 'selected' }}>Vyberte možnosť</option>
                                    <option value="Prihlásenie" {{ old('where')=='Prihlásenie'?'selected':'' }}>Prihlásenie</option>
                                    <option value="Registrácia" {{ old('where')=='Registrácia'?'selected':'' }}>Registrácia</option>
                                    <option value="Vytváranie baru" {{ old('where')=='Vytváranie baru'?'selected':'' }}>Vytváranie baru</option>
                                    <option value="Inventúra" {{ old('where')=='Inventúra'?'selected':'' }}>Inventúra</option>
                                    <option value="Inventár baru" {{ old('where')=='Inventár baru'?'selected':'' }}>Inventár baru</option>
                                    <option value="Počítačová aplikácia (Windows)" {{ old('where')=='Počítačová aplikácia (Windows)'?'selected':'' }}>Počítačová aplikácia (Windows)</option>
                                    <option value="Počítačová aplikácia (Linux)" {{ old('where')=='Počítačová aplikácia (Linux)'?'selected':'' }}>Počítačová aplikácia (Linux)</option>
                                    <option value="Mobilná aplikácia (Android)" {{ old('where')=='Mobilná aplikácia (Android)'?'selected':'' }}>Mobilná aplikácia (Android)</option>
                                    <option value="Mobilná aplikácia (iOS)" {{ old('where')=='Mobilná aplikácia (iOS)'?'selected':'' }}>Mobilná aplikácia (iOS)</option>
                                    <option value="Webová aplikácia (mobilná verzia)" {{ old('where')=='Webová aplikácia (mobilná verzia)'?'selected':'' }}>Webová aplikácia (mobilná verzia)</option>
                                    <option value="Zariadenie (váha, skener)" {{ old('where')=='Zariadenie (váha, skener)'?'selected':'' }}>Zariadenie (váha, skener)</option>
                                    <option value="Iné" {{ old('where')=='Iné'?'selected':'' }}>Iné</option>
                                </select>
                                @error('where')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Vyberte prosím, kde je problém.</div>
                                    @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="what">Aký je problém *</label>
                                <select id="what" class="form-control @error('what') is-invalid @enderror" name="what" required>
                                    <option value="" disabled {{ old('what') ? '' : 'selected' }}>Vyberte možnosť</option>
                                    <option value="Nefunguje" {{ old('what')=='Nefunguje'?'selected':'' }}>Nefunguje</option>
                                    <option value="Chýba funkcionalita" {{ old('what')=='Chýba funkcionalita'?'selected':'' }}>Chýba funkcionalita</option>
                                    <option value="Je to zbytočné" {{ old('what')=='Je to zbytočné'?'selected':'' }}>Je to zbytočné</option>
                                    <option value="Chybové hlášky" {{ old('what')=='Chybové hlášky'?'selected':'' }}>Chybové hlášky</option>
                                    <option value="Iné" {{ old('what')=='Iné'?'selected':'' }}>Iné</option>
                                </select>
                                @error('what')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="invalid-feedback">Vyberte prosím, aký je problém.</div>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="support_message">Správa *</label>
                            <textarea
                                class="form-control @error('support_message') is-invalid @enderror"
                                id="support_message" name="support_message"
                                rows="5" required minlength="10" maxlength="1000">{{ old('support_message') }}</textarea>
                            @error('support_message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">Správa musí obsahovať 10–1000 znakov.</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <input class="form-check-input @error('vop') is-invalid @enderror" type="checkbox" id="VOP" name="vop" value="1" required>
                            <label class="form-check-label" for="VOP">
                                Súhlas so spracovaním osobných údajov podľa <a href="{{ route('gdpr') }}" target="_blank" rel="noopener">GDPR</a>
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
    @include('web.layouts.partials.newsletter')
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
