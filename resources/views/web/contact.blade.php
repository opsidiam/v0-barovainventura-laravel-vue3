@extends('web.layouts.app')
@section('content')

    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"> <img src="{{asset('web/images/banner-shape1.png')}}" alt="image"> </span>
            <span class="banner_shape2"> <img src="{{asset('web/images/banner-shape2.png')}}" alt="image"> </span>
            <span class="banner_shape3"> <img src="{{asset('web/images/banner-shape3.png')}}" alt="image"> </span>

            <div class="bred_text">
                <h1>{{ __('web.contact.breadcrumb_title') }}</h1>
                <p>{{ __('web.contact.breadcrumb_text') }}</p>
                <ul>
                    <li><a href="{{ route('home') }}">{{ __('web.contact.breadcrumb_home') }}</a></li>
                    <li><span>»</span></li>
                    <li>{{ __('web.contact.breadcrumb_title') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="contact_page_section">
        <div class="container">
            <div class="contact_inner">
                <div class="contact_form">
                    <div class="section_title">
                        <h2>{!! __('web.contact.form_title') !!}</h2>
                        <p>{{ __('web.contact.form_text') }}</p>
                    </div>

                    <form method="POST" action="{{ route('contact.send') }}" validate>
                        @csrf
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

                        <div class="form-group">
                            <label for="name">{{ __('web.contact.name') }} *</label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required minlength="2" maxlength="50">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('web.validation.name') }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('web.contact.email') }} *</label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('web.validation.email') }}</div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">{{ __('web.contact.phone') }}</label>
                            <input id="phone" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message">{{ __('web.contact.message') }} *</label>
                            <textarea id="message"
                                      class="form-control @error('message') is-invalid @enderror"
                                      name="message" required>{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">{{ __('web.validation.message') }}</div>
                                @enderror
                        </div>

                        <div class="form-group term_check">
                            <input type="checkbox" id="term" name="agree" value="1" required>
                            <label for="term">{{ __('web.contact.agree') }}</label>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn puprple_btn">{{ __('web.contact.send') }}</button>
                        </div>
                    </form>
                </div>
                <div class="contact_info">
                    <div class="icon"><img src="{{asset('web/images/contact_message_icon.png')}}" alt="image"></div>
                    <div class="section_title">
                        <h2>{!! __('web.contact.info_title') !!}</h2>
                        <p>{!! __('web.contact.info_text') !!} <a href="{{route('faq')}}">FAQ.</a></p>
                    </div>
                    <a href="{{route('faq')}}" class="btn puprple_btn">{{ __('web.contact.read_faq') }}</a>
                    <ul class="contact_info_list">
                        <li>
                            <div class="img"><img src="{{asset('web/images/mail_icon.png')}}" alt="image"></div>
                            <div class="text">
                                <span>{{ __('web.contact.email_us') }}</span>
                                <a href="mailto:info@barovainventura.sk">info@barovainventura.sk</a>
                            </div>
                        </li>
                        <li>
                            <div class="img"><img src="{{asset('web/images/call_icon.png')}}" alt="image"></div>
                            <div class="text">
                                <span>{{ __('web.contact.call_us') }}</span>
                                <a href="tel:+421948357763">0948 357 763</a>
                            </div>
                        </li>
                        <li>
                            <div class="img"><img src="{{asset('web/images/location_icon.png')}}" alt="image"></div>
                            <div class="text">
                                <span>{{ __('web.contact.visit_us') }}</span>
                                <p>Trnovo 74, 038 41 Trnovo, Slovensko</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@include('web.layouts.partials.newsletter')
@endsection
