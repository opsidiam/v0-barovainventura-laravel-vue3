@extends('layouts.app')
@section('content')
    <div class="page-header" data-parallax="true" style="background-image: url({{asset('web/assets/img/sidebar_img.jpg')}}); height: 30vh;">
    </div>
    <div class="main main-raised">
        <div class="container">
{{--            <div class="section text-center">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-8 ml-auto mr-auto">--}}
{{--                        <h2 class="title">O nás</h2>--}}
{{--                        <h5 class="description">Trochu informácii o nás</h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="features">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="info">--}}
{{--                                <div class="icon icon-info">--}}
{{--                                    <i class="material-icons">visibility</i>--}}
{{--                                </div>--}}
{{--                                <h4 class="info-title">Prehľad</h4>--}}
{{--                                <p>Maj prehlaď o produktoch, tržbách a stratách vo svojom podniku hneď ako sa na to príde, a to z pohodlia domova.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="info">--}}
{{--                                <div class="icon icon-success">--}}
{{--                                    <i class="material-icons">verified_user</i>--}}
{{--                                </div>--}}
{{--                                <h4 class="info-title">Presnosť</h4>--}}
{{--                                <p>Meranie objemu s 99% presnosťou. Nič ti nebude chýbať, maj všetko pod drobnohľadom.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="info">--}}
{{--                                <div class="icon icon-danger">--}}
{{--                                    <i class="material-icons">fingerprint</i>--}}
{{--                                </div>--}}
{{--                                <h4 class="info-title">Identifikácia</h4>--}}
{{--                                <p>Presne vieš, kto čo urobil. Kto naskenoval produkt, kto mal na starosti inventarizáciu.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="section text-center">
                <h2 class="title">Náš tím</h2>
                <div class="team">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="team-player">
                                <div class="card card-plain">
                                    <div class="col-md-6 ml-auto mr-auto">
                                        <img src="https://web-place.sk/public/img/pato.jpg" alt="Patrik Karaba" class="img-raised rounded-circle img-fluid">
                                    </div>
                                    <h4 class="card-title">
                                        <a href="https://web-place.sk/" target="_blank">
                                            <i class="fa-sharp fa-solid fa-link"></i>
                                            Patrik Karaba
                                        </a>
                                    </h4>
                                    <div class="card-body">
                                        <p class="card-description">Autor projektu a vývojár WEB aplikácie</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-player">
                                <div class="card card-plain">
                                    <div class="col-md-6 ml-auto mr-auto">
                                        <img src="https://www.trsek.com/pascal/images/f/fb/Trsek_thumb.jpg" alt="Zdenko Sekerák" class="img-raised rounded-circle img-fluid">
                                    </div>
                                    <h4 class="card-title">
                                        <a href="https://trsek.com/curriculum" target="_blank">
                                            <i class="fa-sharp fa-solid fa-link"></i>
                                            Zdenko Sekerák
                                        </a>
                                    </h4>
                                    <div class="card-body">
                                        <p class="card-description">Vývojár PC aplikácie</p>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-md-4">--}}
{{--                            <div class="team-player">--}}
{{--                                <div class="card card-plain">--}}
{{--                                    <div class="col-md-6 ml-auto mr-auto">--}}
{{--                                        <img src="{{asset('public/img/postup_3.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">--}}
{{--                                    </div>--}}
{{--                                    <h4 class="card-title">Hotovo--}}
{{--                                    </h4>--}}
{{--                                    <div class="card-body">--}}
{{--                                        <p class="card-description">Tento postup opakuj so všetkými fľašami, poprípade pridaj aj kusový tovar (dobošky, minerálky....). keď budeš mat všetko tak už len uzavri inventúru a pozri si výpis v PDF, alebo si ho nechaj automaticky zasielať na tvoj email.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
