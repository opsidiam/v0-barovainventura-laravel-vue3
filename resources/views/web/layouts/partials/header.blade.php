<header @if(!request()->routeIs('home')) class="white_header" @endif>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="@if(!request()->routeIs('home'))
                {{ asset('img/V1 alt - W.svg') }}
                @else
                {{ asset('img/V1 alt.svg') }}
                @endif" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <div class="toggle-wrap">
                        <span class="toggle-bar"></span>
                    </div>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('web.header.home') }}</a>
                    </li>
                    <!-- secondery menu start -->
                    <li class="nav-item has_dropdown">
                        <a class="nav-link" href="#">Viac</a>
                        <span class="drp_btn"><i class="icofont-rounded-down"></i></span>
                        <div class="sub_menu">
                            <ul>
                                <li><a href="{{ route('home') }}#features">{{ __('web.header.features') }}</a></li>
                                <li><a href="{{ route('home') }}#how_it_work">{{ __('web.header.how_it_works') }}</a></li>
                                <li><a href="{{ route('tutorial') }}">{{ __('web.header.tutorials') }}</a></li>
                                <li><a href="{{ route('download') }}">{{ __('web.header.download') }}</a></li>
                                <li><a href="{{ route('faq') }}">{{ __('web.footer.faq') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pricelist') }}">{{ __('web.header.pricing') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">{{ __('web.header.contact') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('web.header.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dark_btn" href="{{ route('register') }}">{{ __('web.header.register') }}</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
