@extends('web.layouts.app')

@section('content')
    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"> <img src="{{ asset('web/images/banner-shape1.png') }}" alt="image"> </span>
            <span class="banner_shape2"> <img src="{{ asset('web/images/banner-shape2.png') }}" alt="image"> </span>
            <span class="banner_shape3"> <img src="{{ asset('web/images/banner-shape3.png') }}" alt="image"> </span>

            <div class="bred_text">
                <h1>{{ __('web.faq.title') }}</h1>
                <ul>
                    <li><a href="{{ url('/') }}">{{ __('web.faq.breadcrumbs.home') }}</a></li>
                    <li><span>»</span></li>
                    <li>{{ __('web.faq.breadcrumbs.faq') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="row_am faq_section">
        <div class="container">
            <div class="faq_panel">
                <div class="accordion" id="accordionExample">
                    @php
                        $items = __('web.faq.items');
                        if (!is_array($items)) { $items = []; }
                    @endphp

                    @foreach($items as $i => $item)
                        @php
                            $num = $i + 1;
                            $open = $i === 0 ? 'show' : '';
                            $expanded = $i === 0 ? 'true' : 'false';
                            $headingId = "heading{$num}";
                            $collapseId = "collapse{$num}";
                        @endphp

                        <div class="card" data-aos="fade-up">
                            <div class="card-header" id="{{ $headingId }}">
                                <h2 class="mb-0">
                                    <button type="button"
                                            class="btn btn-link {{ $i === 0 ? 'active' : 'collapsed' }}"
                                            data-toggle="collapse"
                                            data-target="#{{ $collapseId }}"
                                            aria-expanded="{{ $expanded }}"
                                            aria-controls="{{ $collapseId }}">
                                        <i class="icon_faq icofont-plus"></i>
                                        {{ $item['q'] ?? '' }}
                                    </button>
                                </h2>
                            </div>
                            <div id="{{ $collapseId }}" class="collapse {{ $open }}"
                                 aria-labelledby="{{ $headingId }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $item['a'] ?? '' !!}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    @include('web.layouts.partials.newsletter')
@endsection
