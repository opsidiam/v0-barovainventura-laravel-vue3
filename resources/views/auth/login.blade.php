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
                        <h2><span>{{ __('auth.login.title') }}</span> </h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}" validate>
                        @csrf
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

                        <div class="form-group">
                            <label for="email">{{ __('auth.login.email') }} *</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required
                                   autocomplete="email" autofocus
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                   placeholder="{{ __('auth.login.email_placeholder') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('auth.validation.email') }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('auth.login.password') }} *</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password"
                                   placeholder="{{ __('auth.login.password_placeholder') }}">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('auth.validation.password') }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="remember"
                                           id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                    {{ __('auth.login.remember_me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn puprple_btn">
                                {{ __('auth.login.submit') }}
                            </button>
                        </div>
                    </form>
                    <p class="or_block">
                        <span>{{ __('auth.or') }}</span>
                    </p>
                    <div class="or_option">
                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a href="{{ route('password.request') }}">
                                    {{ __('auth.login.forgot_password') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>

    </div>
    <style>
        .form-check-input {
            opacity: 1 !important;
            position: relative !important;
            margin-left: 0 !important;
            margin-right: 10px !important;
        }

        .form-check-label {
            margin-left: 25px !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Frontend validation
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
