<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Add new product</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
</head>
<body>
<div id="app">
<div class="container">
<div class="row">
    @if ($message = Session::get('success'))
        <script>
            $( document ).ready(function() {
                setTimeout(function () {
                    window.close();
                }, 3000);
            });
        </script>
        <div class="col-12 m-5 alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($message = Session::get('error'))
        <script>
            $( document ).ready(function() {
                setTimeout(function () {
                    window.close();
                }, 3000);
            });
        </script>
        <div class="col-12 m-5 alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($message = Session::get('warning'))
        <script>
            $( document ).ready(function() {
                setTimeout(function () {
                    window.close();
                }, 3000);
            });
        </script>
        <div class="col-12 m-5 alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($message = Session::get('info'))
        <script>
            $( document ).ready(function() {
                setTimeout(function () {
                    window.close();
                }, 3000);
            });
        </script>
        <div class="col-12 m-5 alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($errors->any())
        <script>
            $( document ).ready(function() {
                setTimeout(function () {
                    window.close();
                }, 3000);
            });
        </script>
        <div class="col-12 m-5 alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Please check the form below for errors
        </div>
    @endif

    @if($typ == 1)
                <form method="post" class="col-12 m-5" action="{{route('send.add.new.alco')}}">
                    @csrf
                    <input type="hidden" name="addNew" value="true">
                    <input type="hidden" name="typ" value="{{$typ}}">
                    <input type="hidden" name="user_token" value="{{$user->token}}">
                        <p>
                            <b>"Otvorená fľaša"</b> - Objem otvorenej fľaše zadajte v mililitroch.<br>
                            <b>"Prázdna fľaša"</b> - Objem prázdnej fľaše zadajte v mililitroch.<br><br>
                            <b>"Nová fľaša"</b> - Objem novej fľaše zadajte v mililitroch.<br><br>
                            <b>"Tolerancia"</b> - Tolerancia rozdilu váhy pre inventuru.<br><br>
                            <b>"EAN"</b> - nacitany ciarovy kod, odporucame skontrolovat spravnost.<br><br>
                            Polia ozančené (<span style="color: red; font-weight: bold;">*</span>) sú povinný údaj.
                        </p>
                        <div class="row md-form">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">nazov <span style="color: red; font-weight: bold;">*</span></label>
                                <input type="text" value="" minlength="1" id="name" name="name" class="form-control input-lg" placeholder="nazov *" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">vyrobca <span style="color: red; font-weight: bold;">*</span></label>
                                <input type="text" value="" minlength="1" id="vyrobca" name="vyrobca" class="form-control input-lg" placeholder="vyrobca *" required>
                            </div>
                        </div><br>
                        <div class="row md-form">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Objem fľaše<span style="color: red; font-weight: bold;">*</span> (ml)</label>
                                <input type="number" value="" minlength="1" id="objem" name="objem" class="form-control input-lg" placeholder="objem flase * (ml)" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">alkohol <span style="color: red; font-weight: bold;">*</span> (%)</label>
                                <input type="number" value="" minlength="1" id="alkohol" name="alkohol" class="form-control input-lg" placeholder="alkohol * (%)" required>
                            </div>
                        </div><br>
                        <div class="row md-form">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Váha prázdnej fľaše (g)</label>
                                <input type="number" value="" minlength="1" id="vaha_prazdna" name="vaha_prazdna" class="form-control input-lg" placeholder="Váha prázdnej fľaše (g)">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Váha plnej fľaše (g)</label>
                                <input type="number" value="" minlength="1" id="vaha_plnej" name="vaha_plnej" class="form-control input-lg" placeholder="Váha plnej fľaše (g)">
                            </div>
                        </div><br>
                        <div class="row md-form">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Tolerancia (ml)</label>
                                <input type="number" value="" minlength="1" id="tolerancia" name="tolerancia" class="form-control input-lg" placeholder="Tolerancia (ml)">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Otvorená fľaša <span style="color: red; font-weight: bold;">*</span> (g)</label>
                                <input type="number" value="" minlength="1" id="weights" name="weight" class="form-control input-lg" placeholder="Otvorená fľaša * (g)" required>
                            </div>
                        </div><br>
                        <div class="row md-form">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">EAN (ciarovy kod) <span style="color: red; font-weight: bold;">*</span></label>
                                <input type="number" minlength="1" id="ean" name="ean" value="{{$ean}}" class="form-control input-lg" placeholder="EAN (ciarovy kod) *" required>
                            </div>
                            <div class="col-md-6">
                                <label for="full_packs">Počet plných fliaš <span style="color: red; font-weight: bold;">*</span></label>
                                <input type="number" minlength="0" id="full_packs" name="full_packs" value="0" class="form-control input-lg" placeholder="Počet plných fliaš *" required>
                            </div>
                        </div>
                    <div class="row m-5">
                        <input class="btn btn-primary col" id="insertModal" type="submit" value="Pridať produkt">
                        <div class="col-sm-4"></div>
                        <button class="btn btn-primary col" type="button" onclick="window.close()">Zavrieť</button>
                    </div>
                </form>
            @else
                <form method="post" class="col-12" action="{{route('send.add.new.noalco')}}">
                    @csrf
                    <input type="hidden" name="addNew" value="true">
                    <input type="hidden" name="typ" value="{{$typ}}">
                    <input type="hidden" name="inv_id" value="{{$inv->id}}">
                    <input type="hidden" name="user_api" value="{{$api}}">
                    <input type="hidden" name="user_token" value="{{$user->token}}">
                    <div class="modal-body">
                        <p>
                            <b>"Otvorená fľaša"</b> - Objem otvorenej fľaše zadajte v mililitroch.<br>
                            <b>"Prázdna fľaša"</b> - Objem prázdnej fľaše zadajte v mililitroch.<br><br>
                            <b>"Nová fľaša"</b> - Objem novej fľaše zadajte v mililitroch.<br><br>
                            <b>"Tolerancia"</b> - Tolerancia rozdilu váhy pre inventuru.<br><br>
                            <b>"EAN"</b> - nacitany ciarovy kod, odporucame skontrolovat spravnost.<br><br>
                            Polia ozančené (<span style="color: red; font-weight: bold;">*</span>) sú povinný údaj.
                        </p>
                        <div class="row md-form">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Názov <span style="color: red; font-weight: bold;">*</span></label>
                                <input type="text" value="" minlength="1" id="name" name="name" class="form-control input-lg" placeholder="Názov *" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">vyrobca <span style="color: red; font-weight: bold;">*</span></label>
                                <input type="text" value="" minlength="1" id="vyrobca" name="vyrobca" class="form-control input-lg" placeholder="vyrobca *" required>
                            </div>
                        </div><br>
                        <div class="row md-form">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Objem / Váha<span style="color: red; font-weight: bold;">*</span> (ml)</label>
                                <input type="number" value="" minlength="1" id="objem" name="objem" class="form-control input-lg" placeholder="objem flase * (ml)" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Počet ks na sklade <span style="color: red; font-weight: bold;">*</span></label>
                                <input type="number" value="" minlength="1"id="weights" name="weight" class="form-control input-lg" placeholder="Počet ks na sklade *" required>
                            </div>
                        </div><br>

                        <div class="row md-form">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">EAN (ciarovy kod) <span style="color: red; font-weight: bold;">*</span></label>
                                <input type="number" minlength="1" id="ean" name="ean" value="{{$ean}}" class="form-control input-lg" placeholder="EAN (ciarovy kod) *">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer row">
                        <input class="btn btn-primary col" id="insertModal" type="submit" value="Pridať produkt">
                        <div class="col-sm-4"></div>
                        <button class="btn btn-primary col" type="button" onclick="window.close()">Zavrieť</button>
                    </div>
                </form>
            @endif



</div>
</div>
</div>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
{{--<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>--}}
{{--<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}" defer></script>
</body>
</html>
