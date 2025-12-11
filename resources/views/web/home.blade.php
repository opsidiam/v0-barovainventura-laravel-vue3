@extends('web.layouts.app')
@section('content')
    <section class="banner_section">
        <div class="container">
            <div class="anim_line">
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12" data-aos="fade-right" data-aos-duration="1500">
                    <div class="banner_text">
                        <h1>Cloudová <span>inventúra</span> pre bary</h1>
                        <p>Kompletné cloudové riešenie pre rýchlu a presnú inventúru otvorených fliaš.</p>
                    </div>
                    <div class="used_app">
                        <a href="{{route('register')}}" class="btn puprple_btn aos-init aos-animate" data-aos="fade-in" data-aos-duration="1500">30 dní cloud služby zadarmo</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" data-aos="fade-in" data-aos-duration="1500">
                    <div class="banner_slider">
                        <div class="left_icon">
                            <img src="{{asset('web/images/message_icon.png')}}" alt="image">
                        </div>
                        <div class="right_icon">
                            <img src="{{asset('web/images/shield_icon.png')}}" alt="image">
                        </div>
                        <div id="frmae_slider" class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{asset('web/images/screen.png')}}" alt="image" style="padding-top: 5px">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{asset('web/images/screen-1.png')}}" alt="image" style="padding-top: 5px">
                                </div>
                            </div>
                            <div class="item">
                                <div class="slider_img">
                                    <img src="{{asset('web/images/screen-2.png')}}" alt="image" style="padding-top: 5px">
                                </div>
                            </div>
                        </div>
                        <div class="slider_frame">
                            <img src="{{asset('web/images/mobile_frame_svg.svg')}}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row_am features_section" id="features">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                <h2><span>Výhody</span> cloudovej inventúry</h2>
                <p>Hlavná logika beží v cloude, desktop aplikácia zaisťuje presné váženie a okamžitú synchronizáciu údajov.</p>
            </div>
            <div class="feature_detail">
                <div class="left_data feature_box">
                    <div class="data_block" data-aos="fade-right" data-aos-duration="1500">
                        <div class="icon">
                            <img src="{{asset('web/images/secure_data.png')}}" alt="Cloudové úložisko">
                        </div>
                        <div class="text">
                            <h4>Centrálny cloud</h4>
                            <p>Všetky dáta sa ukladajú bezpečne v cloude. K inventúram máte prístup z akéhokoľvek zariadenia, všetky zmeny sú okamžite synchronizované.</p>
                        </div>
                    </div>
                    <div class="data_block" data-aos="fade-right" data-aos-duration="1500">
                        <div class="icon">
                            <img src="{{asset('web/images/functional.png')}}" alt="Okamžitá synchronizácia">
                        </div>
                        <div class="text">
                            <h4>Okamžitá synchronizácia</h4>
                            <p>Desktop aplikácia odosiela údaje priamo do cloudu v reálnom čase. Celý tím vidí aktuálne dáta, žiadne duplicitné záznamy.</p>
                        </div>
                    </div>
                </div>
                <div class="right_data feature_box">
                    <div class="data_block" data-aos="fade-left" data-aos-duration="1500">
                        <div class="icon">
                            <img src="{{asset('web/images/live-chat.png')}}" alt="Automatické zálohovanie">
                        </div>
                        <div class="text">
                            <h4>Automatické zálohovanie</h4>
                            <p>Cloudová služba pravidelne zálohuje všetky vaše dáta. Žiadne riziko straty informácií pri výpadku lokálneho zariadenia.</p>
                        </div>
                    </div>
                    <div class="data_block" data-aos="fade-left" data-aos-duration="1500">
                        <div class="icon">
                            <img src="{{asset('web/images/support.png')}}" alt="Jednoduchá inštalácia">
                        </div>
                        <div class="text">
                            <h4>Jednoduchá inštalácia</h4>
                            <p>Desktop aplikáciu na váženie nainštalujete raz a ďalej sa všetko deje automaticky. Všetky dôležité procesy bežia v cloude.</p>
                        </div>
                    </div>
                </div>
                <div class="feature_img" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                    <img src="{{asset('web/images/screen-1.png')}}" alt="Cloudová inventúra – prehľadové okno">
                </div>
            </div>
        </div>
    </section>

    <section class="row_am modern_ui_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ui_text">
                        <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                            <h2>Moderné cloudové <span>riešenie</span></h2>
                            <p>Hlavná aplikácia beží v cloude, desktopová časť slúži na váženie a odosielanie údajov. Všetky reporty, histórie a nastavenia máte k dispozícii online.</p>
                        </div>
                        <ul class="design_block">
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <h4>Prístup odkiaľkoľvek</h4>
                                <p>Cloudová časť je dostupná z akéhokoľvek zariadenia s internetom. Desktop aplikácia je potrebná len pre priame váženie a skenovanie.</p>
                            </li>
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <h4>Plynulá cloud synchronizácia</h4>
                                <p>Desktop aplikácia odosiela údaje priamo do cloudu. Viac používateľov môže pracovať súčasne, všetky údaje sa automaticky zlučujú.</p>
                            </li>
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <h4>Automatické cloudové exporty</h4>
                                <p>Všetky reporty a výstupy sa generujú priamo z cloudu. PDF, Excel a ďalšie formáty dostupné okamžite pre účtovníctvo a manažment.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ui_images" data-aos="fade-in" data-aos-duration="1500">
                        <div class="left_img">
                            <img class="moving_position_animatin" src="{{asset('web/images/modern01.png')}}" alt="Cloudové rozhranie Barová Inventúra">
                        </div>
                        <div class="right_img">
                            <img class="moving_position_animatin" src="{{asset('web/images/secure_data.png')}}" alt="Bezpečné cloudové úložisko">
                            <img class="moving_position_animatin" src="{{asset('web/images/modern02.png')}}" alt="Prehľad inventúr v cloude">
                            <img class="moving_position_animatin" src="{{asset('web/images/modern03.png')}}" alt="Rýchle akcie v cloud appke">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row_am pricing_section" id="pricing">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                <h2>{!! __('web.pricelist.section.title') !!}</h2>
                <p class="mt-2" style="max-width: 860px; margin: 0 auto;">
                    {!! __('web.pricelist.borrow_info_html') !!}<br>
                    {!! __('web.pricelist.borrow_pricelist') !!}<br>
                </p>
            </div>

            <div class="toggle_block" data-aos="fade-up" data-aos-duration="1500">
                <span class="month active">{{ __('web.pricelist.section.toggle.month') }}</span>
                <div class="tog_block"><span class="tog_btn"></span></div>
                <span class="years">{{ __('web.pricelist.section.toggle.year') }}</span>
                <span class="offer">{{ __('web.pricelist.section.toggle.offer') }}</span>
            </div>

            <div class="pricing_pannel monthly_plan active" data-aos="fade-up" data-aos-duration="1500">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pricing_block">
                            <div class="icon">
                                <img src="{{ asset('web/images/standard.png') }}" alt="plan-icon">
                            </div>
                            <div class="pkg_name">
                                <h3>Cloud služba - Mesačná</h3>
                                <span>Prístup k cloudovej aplikácii</span>
                            </div>
                            <span class="price">{{ number_format($licenses[0]['price'], 0, ',', ' ') }} € <small>/podnik/mesiac</small></span>
                            <ul class="benifits">
                                <li><p>Cloudová služba: Mesačný prístup</p></li>
                                <li><p>Počet prevádzok: <b>1</b> </p></li>
                                <li><p>Plný prístup k cloud aplikácii</p></li>
                                <li><p>Cloudové notifikácie: Áno</p></li>
                                <li><p>Export z cloudu: Áno</p></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pricing_block">
                            <div class="icon">
                                <img src="{{ asset('web/images/standard.png') }}" alt="plan-icon">
                            </div>
                            <div class="pkg_name">
                                <h3>Cloud služba - Mesačná</h3>
                                <span>Prístup k cloudovej aplikácii</span>
                            </div>
                            <span class="price">{{ number_format(($licenses[0]['price'] * 0.95), 0, ',', ' ') }} € <small>/podnik/mesiac</small></span>
                            <ul class="benifits">
                                <li><p>Cloudová služba: Mesačný prístup</p></li>
                                <li><p>Počet prevádzok: <b>2+</b> </p></li>
                                <li><p>Plný prístup k cloud aplikácii</p></li>
                                <li><p>Cloudové notifikácie: Áno</p></li>
                                <li><p>Export z cloudu: Áno</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pricing_pannel yearly_plan">
                <div class="row">
                    <div class="col-md-6">
                        <div class="pricing_block highlited_block">
                            <div class="icon">
                                <img src="{{ asset('web/images/unlimited.png') }}" alt="plan-icon">
                            </div>
                            <div class="pkg_name">
                                <h3>Cloud služba - Ročná</h3>
                                <span>Prístup k cloudovej aplikácii</span>
                            </div>
                            <span class="price">
                                {{ number_format($licenses[1]['price'], 0, ',', ' ') }} € <small>/podnik/rok</small>
                            </span>
                            <ul class="benifits">
                                <li><p>Cloudová služba: Ročný prístup</p></li>
                                <li><p>Počet prevádzok: <b>1</b></p></li>
                                <li><p>Plný prístup k cloud aplikácii</p></li>
                                <li><p>Cloudové notifikácie: Áno</p></li>
                                <li><p>Export z cloudu: Áno</p></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pricing_block highlited_block">
                            <div class="icon">
                                <img src="{{ asset('web/images/unlimited.png') }}" alt="plan-icon">
                            </div>
                            <div class="pkg_name">
                                <h3>Cloud služba - Ročná</h3>
                                <span>Prístup k cloudovej aplikácii</span>
                            </div>
                            <span class="price">
                                {{ number_format(($licenses[1]['price'] * 0.95), 0, ',', ' ') }} € <small>/podnik/rok</small>
                            </span>
                            <ul class="benifits">
                                <li><p>Cloudová služba: Ročný prístup</p></li>
                                <li><p>Počet prevádzok: <b>2+</b></p></li>
                                <li><p>Plný prístup k cloud aplikácii</p></li>
                                <li><p>Cloudové notifikácie: Áno</p></li>
                                <li><p>Export z cloudu: Áno</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row_am how_it_works" id="how_it_work">
        <div class="container">
            <div class="how_it_inner">
                <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                    <h2><span>Ako funguje</span> cloudová inventúra</h2>
                    <p>Kompletný proces kombinuje cloudovú administráciu a desktop aplikáciu na váženie. Všetky dáta sa ukladajú do cloudu v reálnom čase.</p>
                </div>
                <div class="step_block">
                    <ul>
                        <li>
                            <div class="step_text" data-aos="fade-right" data-aos-duration="1500">
                                <h4>Registrácia do cloudu <small>(CLOUD ADMIN)</small></h4>
                                <p>Zaregistrujte sa do cloudovej aplikácie a vytvorte si podnik v cloude. Všetky nastavenia, histórie a reporty sú dostupné online.</p>
                                <p><strong>Cloudová výhoda</strong>: Všetky údaje sa okamžite ukladajú do cloudu, k nim máte prístup z akéhokoľvek zariadenia.</p>
                            </div>
                            <div class="step_number">
                                <h3>01</h3>
                            </div>
                            <div class="step_img" data-aos="fade-left" data-aos-duration="1500">
                                <img src="{{asset('web/images/create_account.jpg')}}" alt="Krok 1 – registrácia do cloudovej aplikácie">
                            </div>
                        </li>

                        <li>
                            <div class="step_text" data-aos="fade-left" data-aos-duration="1500">
                                <h4>Inštalácia a váženie <small>(DESKTOP APLIKÁCIA)</small></h4>
                                <span>Lokálna aplikácia pre presné váženie</span>
                                <p>Nainštalujte si desktop aplikáciu, ktorá komunikuje s cloudom. Použite ju na váženie otvorených fliaš a skenovanie čiarových kódov.</p>
                                <p><strong>Cloudová výhoda</strong>: Každý naskenovaný kód sa okamžite odosiela do cloudu. Žiadne lokálne ukladanie dát.</p>
                            </div>
                            <div class="step_number">
                                <h3>02</h3>
                            </div>
                            <div class="step_img" data-aos="fade-right" data-aos-duration="1500">
                                <img src="{{asset('web/images/download_app.jpg')}}" alt="Krok 2 – inštalácia desktop aplikácie">
                            </div>
                        </li>

                        <li>
                            <div class="step_text" data-aos="fade-right" data-aos-duration="1500">
                                <h4>Reporty a exporty z cloudu <small>(CLOUD ADMIN)</small></h4>
                                <span>Všetky dáta dostupné online</span>
                                <p>Po dokončení inventúry si v cloudovom rozhraní pozrite reporty a stiahnite exporty. Všetky výpočty a analýzy bežia v cloude.</p>
                                <p><strong>Cloudová výhoda</strong>: Dáta sú vždy aktuálne a dostupné z akéhokoľvek zariadenia. Manažment vidí výsledky v reálnom čase.</p>
                            </div>
                            <div class="step_number">
                                <h3>03</h3>
                            </div>
                            <div class="step_img" data-aos="fade-left" data-aos-duration="1500">
                                <img src="{{asset('web/images/enjoy_app.jpg')}}" alt="Krok 3 – reporty a exporty z cloudu">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="yt_video" data-aos="fade-in" data-aos-duration="1500">
                <div class="anim_line dark_bg">
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                    <span><img src="{{asset('web/images/anim_line.png')}}" alt="anim_line"></span>
                </div>
                <div class="thumbnil">
                    <img src="{{asset('web/images/yt_thumb.png')}}" style="border-radius: 30px" alt="Videonávod – cloudová inventúra v praxi">
                    <a class="popup-youtube play-button" data-url="https://www.youtube.com/embed/C3v22PMAwGs?autoplay=1&amp;mute=1" data-toggle="modal" data-target="#myModal" title="Videonávod">
                  <span class="play_btn">
                    <img src="{{asset('web/images/play_icon.png')}}" alt="Prehrať video">
                    <div class="waves-block">
                      <div class="waves wave-1"></div>
                      <div class="waves wave-2"></div>
                      <div class="waves wave-3"></div>
                    </div>
                  </span>
                        Pozrite si cloudovú aplikáciu v akcii
                        <span>Prehrať videonávod</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="row_am trusted_section">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                <h2>Firmy dôverujú našej <span>cloudovej riešeniu</span></h2>
                <p>Podniky, ktoré už využívajú výhody cloudovej inventúry.</p>
            </div>

            <div class="company_logos">
                <div id="company_slider" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="logo">
                            <img src="{{asset('web/images/references/pima.png')}}" alt="PIMA">
                        </div>
                    </div>
                    <div class="item">
                        <div class="logo">
                            <img src="{{asset('web/images/references/pizza-martin.png')}}" alt="Pizza Martin">
                        </div>
                    </div>
                    <div class="item">
                        <div class="logo">
                            <img src="{{asset('web/images/references/rover.gif')}}" alt="ROVER">
                        </div>
                    </div>
                    <div class="item">
                        <div class="logo">
                            <img src="{{asset('web/images/references/web-place.png')}}" alt="Web Place">
                        </div>
                    </div>
                    <div class="item">
                        <div class="logo">
                            <img src="{{asset('web/images/references/selin-lokanta.png')}}" alt="Selin Lokanta">
                        </div>
                    </div>
                    <div class="item">
                        <div class="logo">
                            <img src="{{asset('web/images/references/melis-bar.png')}}" alt="Melis Bar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row_am testimonial_section">
        <div class="container">
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
                <h2>Čo hovoria používatelia <span>cloudovej aplikácie</span></h2>
                <p>Cloudové riešenie urýchľuje inventúru, znižuje straty a zjednodušuje správu dát. Pozrite si hodnotenia našich používateľov.</p>
            </div>

            <div class="testimonial_block" data-aos="fade-in" data-aos-duration="3000">
                <div id="testimonial_slider" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="testimonial_slide_box">
                            <div class="rating">
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                            </div>
                            <p class="review">
                                „Nasadenie nám trvalo asi 15 minút. Odvtedy máme inventúru pod kontrolou a v prehľadoch hneď vidíme rozdiely. Jednoducho – menej strát, viac poriadku.“
                            </p>
                            <h3>Majiteľ baru</h3>
                            <span class="designation">Barová Inventúra – zákazník</span>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial_slide_box">
                            <div class="rating">
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                            </div>
                            <p class="review">
                                „Začali sme bez hardvéru, neskôr sme pridali váhu a skener. Skenovanie fliaš je rýchle a presné a uzavretie inventúry zvládneme na pár klikov.“
                            </p>
                            <h3>Prevádzkar reštaurácie</h3>
                            <span class="designation">Barová Inventúra – zákazník</span>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial_slide_box">
                            <div class="rating">
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                            </div>
                            <p class="review">
                                „Exporty do PDF a ďalších formátov nám uľahčili účtovanie. Keď sme potrebovali prispôsobiť export pre náš systém, podpora to promptne vyriešila.“
                            </p>
                            <h3>Majiteľ baru</h3>
                            <span class="designation">Barová Inventúra – zákazník</span>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial_slide_box">
                            <div class="rating">
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                            </div>
                            <p class="review">
                                „Prihlásenie k inventúre pomocou kódu je jednoduché. Každý zamestnanec má svoj kľúč, takže presne vieme, kto čo skenoval.“
                            </p>
                            <h3>Vedúci zmeny</h3>
                            <span class="designation">Barová Inventúra – zákazník</span>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial_slide_box">
                            <div class="rating">
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                                <span><i class="icofont-star"></i></span>
                            </div>
                            <p class="review">
                                „Máme dve prevádzky a systém zvládam obe bez problémov. Páči sa nám aj množstevná zľava.“
                            </p>
                            <h3>Majiteľ siete prevádzok</h3>
                            <span class="designation">Barová Inventúra – zákazník</span>
                        </div>
                    </div>
                </div>

                <div class="total_review">
                    <div class="rating">
                        <span><i class="icofont-star"></i></span>
                        <span><i class="icofont-star"></i></span>
                        <span><i class="icofont-star"></i></span>
                        <span><i class="icofont-star"></i></span>
                        <span><i class="icofont-star"></i></span>
                        <p>Hodnotenia klientov</p>
                    </div>
                    <h3>—</h3>
                    <p>Veľa ďalších spokojných zákazníkov – pridajte sa medzi nich.</p>
                </div>

                <div class="avtar_faces">
                    <img src="{{asset('web/images/avtar_testimonial.png')}}" alt="Klientske referencie – Barová Inventúra">
                </div>
            </div>
        </div>
    </section>

    <section class="row_am faq_section">
        <div class="container">
            <div class="faq_panel">
                <div class="accordion" id="accordionExample">
                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="pricingHeadingOne">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link active" data-toggle="collapse" data-target="#pricingCollapseOne" aria-expanded="true" aria-controls="pricingCollapseOne">
                                    <i class="icon_faq icofont-plus"></i> Koľko stojí používanie Barovej Inventúry?
                                </button>
                            </h2>
                        </div>
                        <div id="pricingCollapseOne" class="collapse show" aria-labelledby="pricingHeadingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Štandardná cena je <strong>{{ number_format($licenses[0]['price'], 0, ',', ' ') }} € mesačne za jednu prevádzku</strong>.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="pricingHeadingTwo">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#pricingCollapseTwo" aria-expanded="false" aria-controls="pricingCollapseTwo">
                                    <i class="icon_faq icofont-plus"></i> Ako sa počíta cena?
                                </button>
                            </h2>
                        </div>
                        <div id="pricingCollapseTwo" class="collapse" aria-labelledby="pricingHeadingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Cena závisí <strong>iba od počtu prevádzok</strong> vo vašom účte.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="pricingHeadingThree">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#pricingCollapseThree" aria-expanded="false" aria-controls="pricingCollapseThree">
                                    <i class="icon_faq icofont-plus"></i> Ponúkate skúšobné obdobie?
                                </button>
                            </h2>
                        </div>
                        <div id="pricingCollapseThree" class="collapse" aria-labelledby="pricingHeadingThree" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Áno, systém si môžete bezplatne vyskúšať počas skúšobného obdobia.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="pricingHeadingFour">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#pricingCollapseFour" aria-expanded="false" aria-controls="pricingCollapseFour">
                                    <i class="icon_faq icofont-plus"></i> Aké sú možnosti platby a fakturácie?
                                </button>
                            </h2>
                        </div>
                        <div id="pricingCollapseFour" class="collapse" aria-labelledby="pricingHeadingFour" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Platba prebieha <strong>na faktúru</strong>. Po odoslaní objednávky budete presmerovaní na <strong>firemnú platobnú bránu</strong>, kde nájdete <strong>QR kód na platbu</strong> a možnosť <strong>stiahnuť faktúru</strong>. Faktúru dostanete e-mailom <strong>pred aj po úhrade</strong>.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="pricingHeadingFive">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#pricingCollapseFive" aria-expanded="false" aria-controls="pricingCollapseFive">
                                    <i class="icon_faq icofont-plus"></i> Ponúkate zľavy pri viacerých prevádzkach?
                                </button>
                            </h2>
                        </div>
                        <div id="pricingCollapseFive" class="collapse" aria-labelledby="pricingHeadingFive" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Áno. Ak máte <strong>viac ako jednu prevádzku</strong>, získavate <strong>automaticky 5&nbsp;% zľavu</strong> na objednávku licencie.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="pricingHeadingSix">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#pricingCollapseSix" aria-expanded="false" aria-controls="pricingCollapseSix">
                                    <i class="icon_faq icofont-plus"></i> Je v cene zahrnutý aj hardvér (váha, skener)?
                                </button>
                            </h2>
                        </div>
                        <div id="pricingCollapseSix" class="collapse" aria-labelledby="pricingHeadingSix" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Hardvér je <strong>samostatný</strong> a dá sa <strong>zakúpiť priamo v aplikácii</strong>.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="pricingHeadingSeven">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#pricingCollapseSeven" aria-expanded="false" aria-controls="pricingCollapseSeven">
                                    <i class="icon_faq icofont-plus"></i> Je používanie viazané zmluvou alebo minimálnou dobou?
                                </button>
                            </h2>
                        </div>
                        <div id="pricingCollapseSeven" class="collapse" aria-labelledby="pricingHeadingSeven" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Nie. <strong>Žiadna viazanosť</strong> ani povinnosť systém používať. <strong>Licencie sa nepredlžujú automaticky</strong> a môžete skončiť kedykoľvek.</p>
                            </div>
                        </div>
                    </div>

                    <div class="card" data-aos="fade-up">
                        <div class="card-header" id="pricingHeadingEight">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#pricingCollapseEight" aria-expanded="false" aria-controls="pricingCollapseEight">
                                    <i class="icon_faq icofont-plus"></i> Ako je to s DPH a údajmi na faktúre?
                                </button>
                            </h2>
                        </div>
                        <div id="pricingCollapseEight" class="collapse" aria-labelledby="pricingHeadingEight" data-parent="#accordionExample">
                            <div class="card-body">
                                <p>Aktuálne je spoločnosť <strong>neplatcom DPH</strong>, preto sú faktúry <strong>bez DPH</strong>. Ak potrebujete faktúru s DPH, napíšte nám prosím na <strong>info@barovainventura.sk</strong> – po odkomunikovaní to vieme zabezpečiť.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row_am free_app_section" id="getstarted">
        <div class="container">
            <div class="free_app_inner" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="100">
                <div class="anim_line dark_bg">
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                    <span><img src="{{ asset('web/images/anim_line.png') }}" alt="{{ __('web.getstarted.alts.anim') }}"></span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="free_text">
                            <div class="section_title">
                                <h2>{{ __('web.getstarted.title') }}</h2>
                                <p>{{ __('web.getstarted.subtitle') }}</p>
                            </div>
                            <ul class="app_btn">
                                <li>
                                    <a href="{{ url('/download/windows') }}" class="btn store_btn">
                                        {{ __('web.getstarted.btns.download') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/navody') }}" class="btn store_btn">
                                        {{ __('web.getstarted.btns.guides') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="free_img">
                            <img src="{{ asset('web/images/screen-2.png') }}" style="height: 500px;" alt="{{ __('web.getstarted.alts.thumb1') }}">
                            <img class="mobile_mockup" src="{{ asset('web/images/screen-3.png') }}" alt="{{ __('web.getstarted.alts.thumb2') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="row_am latest_story my-5" id="blog">
        <div class="container">
            <div class="section_title" data-aos="fade-in" data-aos-duration="1500" data-aos-delay="100">
                <h2>Aktualizácie produktov pomocou <span>AI</span></h2>
                <p>Aj u nás máme pomocníka – umelú inteligenciu. Tento pomocník sa stará o pravidelnú aktualizáciu produktov. Produkty, ktoré prídu na trh, sú pomocou AI automaticky doplnené do nášho zoznamu.</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="story_box" data-aos="fade-up" data-aos-duration="1500">
                        <div class="story_text">
                            <h3>Pravidelná kontrola</h3>
                            <p>Umelá inteligencia pravidelne aktualizuje všetky produkty.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="story_box" data-aos="fade-up" data-aos-duration="1500">
                        <div class="story_text">
                            <h3>Spolahlivosť</h3>
                            <p>Každý produkt je kontrolovaný a porovnávaný z viacerých zdrojov, vďaka čomu sú údaje vždy presné.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="story_box" data-aos="fade-up" data-aos-duration="1500">
                        <div class="story_text">
                            <h3>Oprava chýb</h3>
                            <p>Ak používateľ pridá produkt manuálne, porovná sa s dostupnými informáciami. Ak sú údaje nepresné, AI ich opraví.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
