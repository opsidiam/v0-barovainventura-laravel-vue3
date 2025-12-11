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

                <div class="signup_form">
                    <div class="section_title">
                        <h2><span>{{ __('auth.confirm.title') }}</span></h2><br>
                        <p class="text-center">{{ __('auth.confirm.message') }}</p>
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group">
                            <label for="password">{{ __('auth.confirm.password_label') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password"
                                   placeholder="{{ __('auth.confirm.password_placeholder') }}">

                            @error('password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn puprple_btn">
                                {{ __('auth.confirm.submit') }}
                            </button>

                            @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a href="{{ route('password.request') }}">
                                        {{ __('auth.confirm.forgot_password') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
@endsection
