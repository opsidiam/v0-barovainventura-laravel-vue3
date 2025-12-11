@extends('web.layouts.app')

@section('content')
    <div class="bred_crumb">
        <div class="container">
            <span class="banner_shape1"> <img src="{{asset('web/images/banner-shape1.png')}}" alt="image"> </span>
            <span class="banner_shape2"> <img src="{{asset('web/images/banner-shape2.png')}}" alt="image"> </span>
            <span class="banner_shape3"> <img src="{{asset('web/images/banner-shape3.png')}}" alt="image"> </span>

            <div class="bred_text">
                <h1>{{ __('web.tutorial.title') }}</h1>
                <ul>
                    <li><a href="{{ url('/') }}">{{ __('web.tutorial.breadcrumbs.home') }}</a></li>
                    <li><span>»</span></li>
                    <li>{{ __('web.tutorial.breadcrumbs.title') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="row_am features_section" id="tutorials">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                <h2><span>Video</span> návody</h2>
                <p>Pozri si rýchle ukážky práce so systémom Barová Inventúra – od registrácie po kalibráciu a exporty.</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-duration="1500">
                <!-- 1 -->
                <div class="col-lg-3 col-md-6 text-center pb-5">
                    <div class="pricing_block">
                        <div class="icon" style="height: 120px"><img src="{{asset('web/images/standard.png')}}" alt="Registrácia"></div>
                        <div class="pkg_name mb-4">
                            <h3>Začiatok a prihlásenie</h3>
                            <small>Prihlásenie do aplikácie</small>
                        </div>
                        <ul class="benifits mb-3">
                            <li>- Prihlásenie do administrácie</li>
                            <li>- Vytvorenie inventúry</li>
                            <li>- Prihlásenie do aplikácie</li>
                        </ul>
                        <a href="#"
                           class="popup-youtube play-button"
                           data-url="https://www.youtube.com/embed/9p0-TTMRJ8g?autoplay=1&mute=0"
                           data-toggle="modal" data-target="#myModal" title="Video návod – Úvod" style="cursor:pointer">
                              <span class="play_btn">
                                <img src="{{ asset('web/images/play_icon.png') }}" alt="Spustiť video">
                              </span>
                           <span>Pustiť video</span>
                        </a>
                    </div>
                </div>

                <!-- 2 -->
                <div class="col-lg-3 col-md-6 text-center pb-5">
                    <div class="pricing_block">
                        <div class="icon" style="height: 120px"><img src="{{asset('web/images/unlimited.png')}}" alt="Inštalácia"></div>
                        <div class="pkg_name mb-4">
                            <h3>Inštalácia</h3>
                            <small>Inštalácia PC aplikácie</small>
                        </div>
                        <ul class="benifits mb-3">
                            <li>- Stiahnutie PC aplikácie</li>
                            <li>- Povolenie defenderu</li>
                            <li>- Inštalácia PC aplikácie</li>
                        </ul>
                        <a href="#"
                           class="popup-youtube play-button"
                           data-url="https://www.youtube.com/embed/-CT2UDn5JjY?autoplay=1&mute=0"
                           data-toggle="modal" data-target="#myModal" title="Video návod – Inštalácia" style="cursor:pointer">
                          <span class="play_btn">
                            <img src="{{ asset('web/images/play_icon.png') }}" alt="Spustiť video">
                          </span>
                            <span>Pustiť video</span>
                        </a>
                    </div>
                </div>

                <!-- 3 -->
                <div class="col-lg-3 col-md-6 text-center pb-5">
                    <div class="pricing_block">
                        <div class="icon" style="height: 120px"><img src="{{asset('web/images/premium.png')}}" alt="Váha"></div>
                        <div class="pkg_name mb-4">
                            <h3>Váha</h3>
                            <small>Kalibrácia váhy</small>
                        </div>
                        <ul class="benifits mb-3">
                            <li>- Predstavenie váhy BI V2</li>
                            <li>- Kalibrácia váhy</li>
                            <li>- Kontrola kalibrácie</li>
                        </ul>
                        <a href="#"
                           class="popup-youtube play-button"
                           data-url="https://www.youtube.com/embed/_nCp19VkxzQ?autoplay=1&mute=0"
                           data-toggle="modal" data-target="#myModal" title="Video návod – Kalibrácia váhy" style="cursor:pointer">
                          <span class="play_btn">
                            <img src="{{ asset('web/images/play_icon.png') }}" alt="Spustiť video">
                          </span>
                            <span>Pustiť video</span>
                        </a>
                    </div>
                </div>

                <!-- 3 -->
                <div class="col-lg-3 col-md-6 text-center pb-5">
                    <div class="pricing_block">
                        <div class="icon" style="height: 120px"><img src="{{asset('web/images/secure_data.png')}}" alt="Inventúra"></div>
                        <div class="pkg_name mb-4">
                            <h3>Inventúra</h3>
                            <small>Proces celej inventúry</small>
                        </div>
                        <ul class="benifits mb-3">
                            <li>– Začiatok inventúry</li>
                            <li>– Proces inventúry</li>
                            <li>– Ukončenie a export</li>
                        </ul>
                        <a href="#"
                           class="popup-youtube play-button"
                           data-url="https://www.youtube.com/embed/we6Atvh1aSw?autoplay=1&mute=0"
                           data-toggle="modal" data-target="#myModal" title="Video návod – Inventúra" style="cursor:pointer">
                          <span class="play_btn">
                            <img src="{{ asset('web/images/play_icon.png') }}" alt="Spustiť video">
                          </span>
                            <span>Pustiť video</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="row_am faq_section">
        <div class="container">
            <div class="faq_panel">
                <div class="accordion" id="accordionExample">

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="faq1">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link active" data-toggle="collapse" data-target="#faqc1">
                                    <i class="icon_faq icofont-plus"></i> Čo robiť, ak neviem nájsť návod, ktorý potrebujem?
                                </button>
                            </h2>
                        </div>
                        <div id="faqc1" class="collapse show" aria-labelledby="faq1" data-parent="#accordionExample">
                            <div class="card-body">
                                Ak neviete nájsť návod, ktorý potrebujete, kontaktujte nás na
                                <a href="mailto:info@barovainventura.sk">info@barovainventura.sk</a> a s radosťou vám
                                pripravíme návod na mieru.
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="faq2">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#faqc2">
                                    <i class="icon_faq icofont-plus"></i> Mám problém, ktorý je vo videu len čiastočne spomenutý.
                                </button>
                            </h2>
                        </div>
                        <div id="faqc2" class="collapse" aria-labelledby="faq2" data-parent="#accordionExample">
                            <div class="card-body">
                                Pokojne nás kontaktujte – radi vám všetko doplníme a vysvetlíme. Komunikovať môžeme e-mailom,
                                telefonicky, prípadne poskytujeme podporu aj cez vzdialený prístup k ploche (AnyDesk).
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="faq3">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#faqc3">
                                    <i class="icon_faq icofont-plus"></i> Koľko stojí podpora a pomoc?
                                </button>
                            </h2>
                        </div>
                        <div id="faqc3" class="collapse" aria-labelledby="faq3" data-parent="#accordionExample">
                            <div class="card-body">
                                Podpora cez telefón alebo e-mail, prípadne zdieľanie plochy, je zadarmo. Našich zákazníkov si
                                vážime a radi investujeme náš čas do pomoci.
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="faq4">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#faqc4">
                                    <i class="icon_faq icofont-plus"></i> Čo mám spraviť, ak chcem, aby mi to niekto prišiel vysvetliť na prevádzku?
                                </button>
                            </h2>
                        </div>
                        <div id="faqc4" class="collapse" aria-labelledby="faq4" data-parent="#accordionExample">
                            <div class="card-body">
                                Dohodnite si prosím osobnú asistenciu e-mailom na
                                <a href="mailto:info@barovainventura.sk">info@barovainventura.sk</a>. Následne dohodneme
                                vyslanie technika priamo k vám na prevádzku v dohodnutom termíne.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('web.layouts.partials.newsletter')
@endsection

