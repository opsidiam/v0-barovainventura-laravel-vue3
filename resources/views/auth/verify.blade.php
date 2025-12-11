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
                        <h2><span>{{ __('auth.verify.title') }}</span></h2>
                    </div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('auth.verify.fresh_link_sent') }}
                            </div>
                        @endif

                        {{ __('auth.verify.check_email') }}
                        {{ __('auth.verify.not_received') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn puprple_btn">{{ __('auth.verify.request_another') }}</button>.
                        </form>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

