@extends('web.layouts.auth')

@section('content')

    <div class="full_bg">

        <div class="container">
            <section class="signup_section">

                <div class="top_part">
                    <a href="{{route('home')}}" class="back_btn"><i class="icofont-arrow-left"></i> {{ __('web.header.home') }}</a>
                    <a class="navbar-brand" href="{{route('home')}}">
                        <img src="{{asset('img/V1 alt - W.svg')}}" alt="image">
                    </a>
                </div>

                <!-- Comment Form Section -->
                <div class="signup_form">
                    <div class="section_title">
                        <h2><span>{{ __('auth.register.title') }}</span></h2>
                    </div>
                    <form method="POST" action="{{ route('register') }}" validate>
                        @csrf
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

                        <div class="form-group">
                            <label for="name">{{ __('auth.register.name') }} *</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required
                                   autocomplete="name" autofocus
                                   minlength="2" maxlength="50">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('auth.validation.name') }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="surname">{{ __('auth.register.surname') }} *</label>
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                                   name="surname" value="{{ old('surname') }}" required
                                   autocomplete="surname" autofocus
                                   minlength="2" maxlength="50">
                            @error('surname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('auth.validation.surname') }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('auth.register.email') }} *</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required
                                   autocomplete="email"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('auth.validation.email') }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="reference">{{ __('auth.register.phone') }} ({{ __('auth.register.no_required') }})</label>
                            <input id="reference" type="text" class="form-control"
                                   name="phone">
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('auth.register.password') }} *</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   minlength="8">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('auth.validation.password') }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('auth.register.password_confirm') }} *</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   minlength="8">
                            <div class="invalid-feedback">{{ __('auth.validation.password_match') }}</div>
                        </div>

                        <div class="form-group">
                            <label for="reference">{{ __('auth.register.reference') }} ({{ __('auth.register.no_required') }})</label>
                            <input id="reference" type="text" class="form-control"
                                   name="reference">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn puprple_btn">
                                {{ __('auth.register.submit') }}
                            </button>
                        </div>

                    </form>
                    <p class="or_block">
                        <span>{{ __('auth.or') }}</span>
                    </p>
                    <div class="or_option">
                        {{ __('auth.register.have_account') }} <a href="{{route('login')}}">{{ __('auth.register.login_link') }}</a>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        // Frontend validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                const form = document.querySelector('form[validate]');

                // Password confirmation validation
                const password = document.getElementById('password');
                const passwordConfirm = document.getElementById('password-confirm');

                passwordConfirm.addEventListener('input', function() {
                    if (password.value !== passwordConfirm.value) {
                        passwordConfirm.setCustomValidity('{{ __('auth.validation.password_match') }}');
                    } else {
                        passwordConfirm.setCustomValidity('');
                    }
                });

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
