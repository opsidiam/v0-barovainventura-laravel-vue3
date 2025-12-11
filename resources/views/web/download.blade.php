@extends('web.layouts.app')

@section('content')
    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"> <img src="{{ asset('web/images/banner-shape1.png') }}" alt="image"> </span>
            <span class="banner_shape2"> <img src="{{ asset('web/images/banner-shape2.png') }}" alt="image"> </span>
            <span class="banner_shape3"> <img src="{{ asset('web/images/banner-shape3.png') }}" alt="image"> </span>

            <div class="bred_text">
                <h1>{{ __('web.download.title') }}</h1>
                <ul>
                    <li><a href="{{ url('/') }}">{{ __('web.download.breadcrumbs.home') }}</a></li>
                    <li><span>»</span></li>
                    <li>{{ __('web.download.breadcrumbs.title') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="row_am review_list_section">
        <div class="container">
            <div class="row">
                {{-- PC aplikácia (Windows) --}}
                <div class="col-lg-4 col-md-6">
                    <div class="review_box">
                        <h3>
                            {{ __('web.download.cards.pc_win.title') }}
                            <small>{{ __('web.download.cards.pc_win.subtitle') }}</small>
                        </h3>
                        <p>{{ __('web.download.cards.pc_win.desc') }}</p>
                        <div class="reviewer text-center">
                            <a href="{{ route('index') }}/BarovaInventura.exe"
                               class="btn puprple_btn"
                               data-aos="fade-in" data-aos-duration="1500">
                                <i class="icofont-download" aria-hidden="true"></i>
                                {{ __('web.download.cards.pc_win.cta') }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Používateľská príručka (PDF) --}}
                <div class="col-lg-4 col-md-6">
                    <div class="review_box">
                        <h3>
                            {{ __('web.download.cards.manual_pdf.title') }}
                            <small>{{ __('web.download.cards.manual_pdf.subtitle') }}</small>
                        </h3>
                        <p>{{ __('web.download.cards.manual_pdf.desc') }}</p>
                        <div class="reviewer text-center">
                            <a href="{{ route('index') }}/Uzivatelska_prirucka.pdf"
                               class="btn puprple_btn"
                               data-aos="fade-in" data-aos-duration="1500">
                                <i class="icofont-download" aria-hidden="true"></i>
                                {{ __('web.download.cards.manual_pdf.cta') }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- PC aplikácia (macOS) --}}
                <div class="col-lg-4 col-md-6">
                    <div class="review_box">
                        <h3>
                            {{ __('web.download.cards.pc_mac.title') }}
                            <small>{{ __('web.download.cards.pc_mac.subtitle') }}</small>
                        </h3>
                        <p>{{ __('web.download.cards.pc_mac.desc') }}</p>
                        <div class="reviewer text-center">
                            <small>{{ __('web.download.cards.pc_mac.note') }}</small>
                        </div>
                    </div>
                </div>

                {{-- Mobilná aplikácia (Android) --}}
                <div class="col-lg-4 col-md-6">
                    <div class="review_box">
                        <h3>
                            {{ __('web.download.cards.mobile_android.title') }}
                            <small>{{ __('web.download.cards.mobile_android.subtitle') }}</small>
                        </h3>
                        <p>{{ __('web.download.cards.mobile_android.desc') }}</p>
                        <div class="reviewer text-center">
                            <small>{{ __('web.download.cards.mobile_android.note') }}</small>
                        </div>
                    </div>
                </div>

                {{-- Mobilná aplikácia (iOS) --}}
                <div class="col-lg-4 col-md-6">
                    <div class="review_box">
                        <h3>
                            {{ __('web.download.cards.mobile_ios.title') }}
                            <small>{{ __('web.download.cards.mobile_ios.subtitle') }}</small>
                        </h3>
                        <p>{{ __('web.download.cards.mobile_ios.desc') }}</p>
                        <div class="reviewer text-center">
                            <small>{{ __('web.download.cards.mobile_ios.note') }}</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('web.layouts.partials.newsletter')
@endsection
