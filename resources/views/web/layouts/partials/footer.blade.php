<footer>
    <div class="top_footer" id="contact">
        <div class="anim_line dark_bg">
            @for ($i = 0; $i < 9; $i++)
                <span><img src="{{ asset('web/images/anim_line.png') }}" alt="anim_line"></span>
            @endfor
        </div>

        <div class="container">
            <div class="row">
                <!-- Contact / Logo -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="abt_side">
                        <div class="logo">
                            <img src="{{ asset('img/V1 alt - W.svg') }}" alt="logo">
                        </div>
                        <ul>
                            <li><a href="mailto:info@barovainventura.sk">info@barovainventura.sk</a></li>
                            <li><a href="tel:+421948357763">0948 357 763</a></li>
                        </ul>
                        <ul class="social_media">
                            <li><a href="https://www.facebook.com/barovainventura/"><i class="icofont-facebook"></i></a></li>
                            <li><a href="https://twitter.com/BarovaInventura"><i class="icofont-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/barovainventura.sk/"><i class="icofont-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Useful Links -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="links">
                        <h3>{{ __('web.footer.useful_links') }}</h3>
                        <ul>
                            <li><a href="{{ route('pricelist') }}">{{ __('web.footer.pricing') }}</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#Cookie">{{ __('web.footer.cookie') }}</a></li>
                            <li><a href="{{ route('contact') }}">{{ __('web.footer.contact') }}</a></li>
                            <li><a href="{{ route('tutorial') }}">{{ __('web.footer.tutorials') }}</a></li>
                            <li><a href="{{ route('download') }}">{{ __('web.footer.download') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Help & Support -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="links">
                        <h3>{{ __('web.footer.help_support') }}</h3>
                        <ul>
                            <li><a href="{{ route('contact') }}">{{ __('web.footer.contact') }}</a></li>
                            <li><a href="{{ route('faq') }}">{{ __('web.footer.faq') }}</a></li>
                            <li><a href="{{ route('vop') }}">{{ __('web.footer.vop') }}</a></li>
                            <li><a href="{{ route('gdpr') }}">{{ __('web.footer.gdpr') }}</a></li>
                            <li><a href="{{ route('support.contact.form') }}">{{ __('web.footer.support') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Try Out -->
{{--                <div class="col-lg-2 col-md-6 col-12">--}}
{{--                    <div class="try_out">--}}
{{--                        <h3>{{ __('web.footer.try_out') }}</h3>--}}
{{--                        <ul class="app_btn">--}}
{{--                            <li><a href="#"><img src="{{ asset('web/images/appstore_blue.png') }}" alt="App Store"></a></li>--}}
{{--                            <li><a href="#"><img src="{{ asset('web/images/googleplay_blue.png') }}" alt="Google Play"></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="bottom_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; {{ date('Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="developer_text">{{ __('web.footer.created_by') }} <a href="https://web-place.sk/" target="_blank">WebPlace s.r.o.</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Go top -->
    <div class="go_top">
        <span><img src="{{ asset('web/images/go_top.png') }}" alt="go_top"></span>
    </div>
</footer>
