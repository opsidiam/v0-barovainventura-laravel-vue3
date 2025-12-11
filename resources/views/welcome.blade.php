@extends('layouts.app')
@section('content')
    <div class="page-header header-filter" data-parallax="true" style="background-image: url({{asset('web/assets/img/sidebar_img.jpg')}})">
        @include('layouts.partials.slider')
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section text-center" style="padding: 20px 0;">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="title">Maj svoj podnik pod kontrolou</h2>
                        <h5 class="description">Inventúra nebola nikdy rýchlejšia a presnejšia. V aplikácii máš všetko prehľadne pod kontrolou, po ukončení inventúry máš k dispozícii výpis v PDF a históriu inventúr.</h5>
                    </div>
                </div>
                <div class="features">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-info">
                                    <i class="material-icons">visibility</i>
                                </div>
                                <h4 class="info-title">Maj prehlaď o produktoch</h4>
                                <p>Maj prehlaď o produktoch, tržbách a stratách vo svojom podniku hneď ako sa na to príde, a to z pohodlia domova.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="material-icons">balance</i>
                                </div>
                                <h4 class="info-title">Meranie s 99% presnosťou</h4>
                                <p>Meranie objemu s 99% presnosťou. Nič ti nebude chýbať, maj všetko pod drobnohľadom.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-danger">
                                    <i class="material-icons">fingerprint</i>
                                </div>
                                <h4 class="info-title">Presne vieš, kto čo urobil</h4>
                                <p>Presne vieš, kto čo urobil. Kto naskenoval produkt, kto mal na starosti inventarizáciu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-10 ml-auto mr-auto">
                            <video width="100%" height="100%" controls>
                                <source src="{{asset('web/video/hl_video.mp4')}}" type="video/mp4">
                                <source src="{{asset('web/video/hl_video.webm')}}" type="video/webm">
                                Táto stránka nepodporuje prehrávanie videa.
                            </video>
                        </div>
                    </div>
                </div>

            </div>
            <div class="section text-center" style="padding: 20px 0;">
                <h2 class="title">Ako to funguje?</h2>
                <div class="team">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="team-player">
                                <div class="card card-plain">
                                    <div class="col-md-6 ml-auto mr-auto">
                                        <img src="{{asset('img/postup_1.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                                    </div>
                                    <h4 class="card-title">Priprav produkty
                                    </h4>
                                    <div class="card-body">
                                        <p class="card-description">Prichystaj si produkty na inventúru, v prípade rozlievaného alkoholu, maj len otvorene fľaše. Neotvorene fľaše len spočítaj.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-player">
                                <div class="card card-plain">
                                    <div class="col-md-6 ml-auto mr-auto">
                                        <img src="{{asset('img/postup_2.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                                    </div>
                                    <h4 class="card-title">Odváž a naskenuj
                                    </h4>
                                    <div class="card-body">
                                        <p class="card-description">Načatú flauš aj s originálnym vrchnákom poloz na stred váhy a skener nasmeruj na čiarový kód fľaše, naskenuj kód a zadaj počet neotvorených fliaš.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-player">
                                <div class="card card-plain">
                                    <div class="col-md-6 ml-auto mr-auto">
                                        <img src="{{asset('img/postup_3.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                                    </div>
                                    <h4 class="card-title">Hotovo
                                    </h4>
                                    <div class="card-body">
                                        <p class="card-description">Tento postup opakuj so všetkými fľašami, poprípade pridaj aj kusový tovar (dobošky, minerálky....). keď budeš mat všetko tak už len uzavri inventúru a pozri si výpis v PDF, alebo si ho nechaj automaticky zasielať na tvoj email.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--        <div class="section section-contacts">--}}
            {{--            <div class="row">--}}
            {{--                <div class="col-md-8 ml-auto mr-auto">--}}
            {{--                    <h2 class="text-center title">Work with us</h2>--}}
            {{--                    <h4 class="text-center description">Divide details about your product or agency work into parts. Write a few lines about each one and contact us about any further collaboration. We will responde get back to you in a couple of hours.</h4>--}}
            {{--                    <form class="contact-form">--}}
            {{--                        <div class="row">--}}
            {{--                            <div class="col-md-6">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="bmd-label-floating">Your Name</label>--}}
            {{--                                    <input type="email" class="form-control">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-6">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="bmd-label-floating">Your Email</label>--}}
            {{--                                    <input type="email" class="form-control">--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="form-group">--}}
            {{--                            <label for="exampleMessage" class="bmd-label-floating">Your Message</label>--}}
            {{--                            <textarea type="email" class="form-control" rows="4" id="exampleMessage"></textarea>--}}
            {{--                        </div>--}}
            {{--                        <div class="row">--}}
            {{--                            <div class="col-md-4 ml-auto mr-auto text-center">--}}
            {{--                                <button class="btn btn-primary btn-raised">--}}
            {{--                                    Send Message--}}
            {{--                                </button>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </form>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
        </div>
    </div>
@endsection
