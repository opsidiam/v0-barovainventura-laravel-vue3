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
                        <h2><span>{{ __('auth.reset.title') }}</span></h2>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.reset.status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('auth.reset.email_label') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="{{ __('auth.reset.email_placeholder') }}">

                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn puprple_btn">
                                {{ __('auth.reset.submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
@endsection

