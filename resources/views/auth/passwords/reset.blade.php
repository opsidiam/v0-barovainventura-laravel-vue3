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
                        <h2><span>{{ __('auth.reset_password.title') }}</span></h2>
                    </div>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email">{{ __('auth.reset_password.email_label') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly autofocus
                                   placeholder="{{ __('auth.reset_password.email_placeholder') }}">

                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('auth.reset_password.new_password_label') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="{{ __('auth.reset_password.new_password_placeholder') }}">

                            @error('password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @else
                                <small class="form-text text-muted">
                                    {{ __('auth.reset_password.password_requirements') }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('auth.reset_password.confirm_password_label') }}</label>
                            <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="{{ __('auth.reset_password.confirm_password_placeholder') }}">

                            @error('password_confirmation')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn puprple_btn">
                                {{ __('auth.reset_password.submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        // Frontend password match validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                const password = document.getElementById('password');
                const passwordConfirm = document.getElementById('password-confirm');
                const passwordMatchMessage = "{{ __('auth.reset_password.password_match_error') }}";

                passwordConfirm.addEventListener('input', function() {
                    if (password.value !== passwordConfirm.value) {
                        passwordConfirm.setCustomValidity(passwordMatchMessage);
                    } else {
                        passwordConfirm.setCustomValidity("");
                    }
                });
            }, false);
        })();
    </script>
@endsection
