@extends('web.layouts.app')

@section('content')
    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"><img src="{{ asset('web/images/banner-shape1.png') }}" alt="image"></span>
            <span class="banner_shape2"><img src="{{ asset('web/images/banner-shape2.png') }}" alt="image"></span>
            <span class="banner_shape3"><img src="{{ asset('web/images/banner-shape3.png') }}" alt="image"></span>

            <div class="bred_text">
                <h1>{{ __('web.pricelist.title') }}</h1>
                <ul>
                    <li><a href="{{ url('/') }}">{{ __('web.pricelist.breadcrumbs.home') }}</a></li>
                    <li><span>»</span></li>
                    <li>{{ __('web.pricelist.breadcrumbs.pricelist') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="row_am pricing_section" id="pricing">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                <h2>{!! __('web.pricelist.section.title') !!}</h2>
            </div>

            <div class="toggle_block" data-aos="fade-up" data-aos-duration="1500">
                <span class="month active">{{ __('web.pricelist.section.toggle.month') }}</span>
                <div class="tog_block"><span class="tog_btn"></span></div>
                <span class="years">{{ __('web.pricelist.section.toggle.year') }}</span>
                <span class="offer">{{ __('web.pricelist.section.toggle.offer') }}</span>
            </div>

            {{-- monthly --}}
            <div class="pricing_pannel monthly_plan active" data-aos="fade-up" data-aos-duration="1500">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pricing_block">
                            <div class="icon"><img src="{{ asset('web/images/standard.png') }}" alt="plan-icon"></div>
                            <div class="pkg_name">
                                <h3>{{ __('web.pricelist.plans.monthly.name') }}</h3>
                                <span>{{ __('web.pricelist.plans.monthly.tagline') }}</span>
                            </div>
                            <span class="price">
                                {{ number_format($licenses[0]['price'], 0, ',', ' ') }} €
                                <small>{{ __('web.pricelist.per_outlet') }}</small>
                            </span>
                            <ul class="benifits">
                                <li><p>{{ __('web.pricelist.features.duration') }}: {{ __('web.pricelist.plans.monthly.name') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.locations') }}: <b>1</b></p></li>
                                <li><p>{{ __('web.pricelist.features.access') }}: {{ __('web.pricelist.features.access_full') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.email_notif') }}: {{ __('web.pricelist.features.yes') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.pdf_export') }}: {{ __('web.pricelist.features.yes') }}</p></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="pricing_block">
                            <div class="icon"><img src="{{ asset('web/images/standard.png') }}" alt="plan-icon"></div>
                            <div class="pkg_name">
                                <h3>{{ __('web.pricelist.plans.monthly.name') }}</h3>
                                <span>{{ __('web.pricelist.plans.monthly.tagline') }}</span>
                            </div>
                            <span class="price">
                                {{ number_format($licenses[0]['price'] * 0.95, 0, ',', ' ') }} €
                                <small>{{ __('web.pricelist.per_outlet') }}</small>
                            </span>
                            <ul class="benifits">
                                <li><p>{{ __('web.pricelist.features.duration') }}: {{ __('web.pricelist.plans.monthly.name') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.locations') }}: <b>2+</b></p></li>
                                <li><p>{{ __('web.pricelist.features.access') }}: {{ __('web.pricelist.features.access_full') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.email_notif') }}: {{ __('web.pricelist.features.yes') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.pdf_export') }}: {{ __('web.pricelist.features.yes') }}</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- yearly --}}
            <div class="pricing_pannel yearly_plan">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pricing_block highlited_block">
                            <div class="icon"><img src="{{ asset('web/images/unlimited.png') }}" alt="plan-icon"></div>
                            <div class="pkg_name">
                                <h3>{{ __('web.pricelist.plans.yearly.name') }}</h3>
                                <span>{{ __('web.pricelist.plans.yearly.tagline') }}</span>
                            </div>
                            <span class="price">
                                {{ number_format($licenses[1]['price'], 0, ',', ' ') }} €
                                <small>{{ __('web.pricelist.per_outlet') }}</small>
                            </span>
                            <ul class="benifits">
                                <li><p>{{ __('web.pricelist.features.duration') }}: {{ __('web.pricelist.plans.yearly.name') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.locations') }}: <b>1</b></p></li>
                                <li><p>{{ __('web.pricelist.features.access') }}: {{ __('web.pricelist.features.access_full') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.email_notif') }}: {{ __('web.pricelist.features.yes') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.pdf_export') }}: {{ __('web.pricelist.features.yes') }}</p></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="pricing_block highlited_block">
                            <div class="icon"><img src="{{ asset('web/images/unlimited.png') }}" alt="plan-icon"></div>
                            <div class="pkg_name">
                                <h3>{{ __('web.pricelist.plans.yearly.name') }}</h3>
                                <span>{{ __('web.pricelist.plans.yearly.tagline') }}</span>
                            </div>
                            <span class="price">
                                {{ number_format($licenses[1]['price'] * 0.95, 0, ',', ' ') }} €
                                <small>{{ __('web.pricelist.per_outlet') }}</small>
                            </span>
                            <ul class="benifits">
                                <li><p>{{ __('web.pricelist.features.duration') }}: {{ __('web.pricelist.plans.yearly.name') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.locations') }}: <b>2+</b></p></li>
                                <li><p>{{ __('web.pricelist.features.access') }}: {{ __('web.pricelist.features.access_full') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.email_notif') }}: {{ __('web.pricelist.features.yes') }}</p></li>
                                <li><p>{{ __('web.pricelist.features.pdf_export') }}: {{ __('web.pricelist.features.yes') }}</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="row_am pricing_section" id="pricing">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                <h2>{!! __('web.pricelist.title_devices') !!}</h2>
                <p class="mt-2" style="max-width: 860px; margin: 0 auto;">
                    {!! __('web.pricelist.borrow_info_html') !!}
                </p>
            </div>

            <div class="pricing_pannel active" data-aos="fade-up" data-aos-duration="1500">
                <div class="row">
                    {{-- SCALE --}}
                    <div class="col-md-6">
                        <div class="pricing_block" style="min-height: 20rem !important;">
                            <div class="pkg_name">
                                <h3>{{ __('web.pricelist.devices.scale.name') }}</h3>
                                <small style="display:block; padding:2rem;">
                                    {!! __('web.pricelist.devices.scale.desc_html') !!}
                                    <br><br>
                                    {!! __('web.pricelist.devices.scale.note_html') !!}
                                </small>
                            </div>
                            <span class="price">
              {{ number_format(120, 0, ',', ' ') }} {{ __('web.pricelist.devices.scale.price_label') }}
            </span>
                        </div>
                    </div>

                    {{-- SCANNER --}}
                    <div class="col-md-6">
                        <div class="pricing_block" style="min-height: 20rem !important;">
                            <div class="pkg_name">
                                <h3>{{ __('web.pricelist.devices.scanner.name') }}</h3>
                                <small style="display:block; padding:2rem;">
                                    {!! __('web.pricelist.devices.scanner.desc_html') !!}
                                    <br><br>
                                    {!! __('web.pricelist.devices.scanner.tip_html') !!}
                                </small>
                            </div>
                            <span class="price">
              {{ number_format(80, 0, ',', ' ') }} {{ __('web.pricelist.devices.scanner.price_label') }}
            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- Pricing FAQ pulled from translations --}}
    <section class="row_am faq_section">
        <div class="container">
            <div class="faq_panel">
                <div class="accordion" id="accordionExample">
                    @php
                        $faqItems = __('web.pricelist.faq.items');
                        $count = is_array($faqItems) ? count($faqItems) : 0;
                    @endphp

                    @for($i = 0; $i < $count; $i++)
                        @php
                            $num = $i + 1;
                            $headingId = "pricingHeading{$num}";
                            $collapseId = "pricingCollapse{$num}";
                            $isFirst = $i === 0;
                        @endphp

                        <div class="card" data-aos="fade-up">
                            <div class="card-header" id="{{ $headingId }}">
                                <h2 class="mb-0">
                                    <button type="button"
                                            class="btn btn-link {{ $isFirst ? 'active' : 'collapsed' }}"
                                            data-toggle="collapse"
                                            data-target="#{{ $collapseId }}"
                                            aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                                            aria-controls="{{ $collapseId }}">
                                        <i class="icon_faq icofont-plus"></i>
                                        {{ __("web.pricelist.faq.items.$i.q") }}
                                    </button>
                                </h2>
                            </div>
                            <div id="{{ $collapseId }}"
                                 class="collapse {{ $isFirst ? 'show' : '' }}"
                                 aria-labelledby="{{ $headingId }}"
                                 data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! __("web.pricelist.faq.items.$i.a", [
                                        'price' => number_format($licenses[0]['price'], 0, ',', ' ')
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    @endfor

                </div>
            </div>
        </div>
    </section>

    @include('web.layouts.partials.newsletter')
@endsection
