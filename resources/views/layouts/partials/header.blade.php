<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand hide-logo white-logo" href="{{route('home')}}">
                <img src="{{asset('img/V1 alt.svg')}}" style="height: 100%" alt="" />
            </a>
            <a class="navbar-brand black-logo" href="{{route('home')}}">
                <img src="{{asset('img/V1 alt - W.svg')}}" style="height: 100%" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="padding: 5px 15px;"
                       onclick="event.preventDefault(); $('#priceModal').modal('show');">
                        Cenník
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="    padding: 5px 15px;" data-toggle="modal" data-target="#contactModal">
                        Kontakt
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="    padding: 5px 15px;" data-toggle="modal" data-target="#downloadsModal">
                        Na stiahnutie
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tutorial')}}" style="padding: 5px 15px;">
                        Návody
                    </a>
                </li>
                @if (Route::has('register'))
                    @if (Route::has('login'))
                        <li class="nav-item">
                            {{--                            {{ route('login') }}--}}
                            <a class="nav-link" href="{{route('login')}}" style="    padding: 5px 15px;">
                                <i class="material-icons">login</i> Prihlásiť sa
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link btn btn-default btn-raised btn-round text-white" style="padding: 5px 10px;" href="{{route('register')}}">
                            <span class="material-icons">how_to_reg</span> Registrovať sa
                        </a>
                    </li>

                @endif
                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" style="    padding: 5px 15px;" title="" data-placement="bottom" href="https://twitter.com/BarovaInventura" target="_blank" data-original-title="Sleduj nás na Twitteri" rel="nofollow">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" style="    padding: 5px 15px;" title="" data-placement="bottom" href="https://www.facebook.com/barovainventura/" target="_blank" data-original-title="Sleduj nás na Facebooku" rel="nofollow">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" rel="tooltip" style="    padding: 5px 15px;" title="" data-placement="bottom" href="https://www.instagram.com/barovainventura.sk/" target="_blank" data-original-title="Sleduj nás na Instagrame" rel="nofollow">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
