@extends('app.layouts.app')
@section('css')
    <style>

        .funkyradio div {
            clear: both;
            overflow: hidden;
        }

        .funkyradio label {
            width: 100%;
            border-radius: 3px;
            border: 1px solid #D1D3D4;
            font-weight: normal;
        }

        .funkyradio input[type="radio"]:empty,
        .funkyradio input[type="checkbox"]:empty {
            display: none;
        }

        .funkyradio input[type="radio"]:empty ~ label,
        .funkyradio input[type="checkbox"]:empty ~ label {
            position: relative;
            line-height: 2.5em;
            text-indent: 3.25em;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .funkyradio input[type="radio"]:empty ~ label:before,
        .funkyradio input[type="checkbox"]:empty ~ label:before {
            position: absolute;
            display: block;
            top: 0;
            bottom: 0;
            left: 0;
            content: '';
            width: 2.5em;
            background: #D1D3D4;
            border-radius: 3px 0 0 3px;
        }

        .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
        .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
            color: #888;
        }

        .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
        .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
            content: '\2714';
            text-indent: .9em;
            color: #C2C2C2;
        }

        .funkyradio input[type="radio"]:checked ~ label,
        .funkyradio input[type="checkbox"]:checked ~ label {
            color: #777;
        }

        .funkyradio input[type="radio"]:checked ~ label:before,
        .funkyradio input[type="checkbox"]:checked ~ label:before {
            content: '\2714';
            text-indent: .9em;
            color: #333;
            background-color: #ccc;
        }

        .funkyradio input[type="radio"]:focus ~ label:before,
        .funkyradio input[type="checkbox"]:focus ~ label:before {
            box-shadow: 0 0 0 3px #999;
        }

        .funkyradio-success input[type="radio"]:checked ~ label:before,
        .funkyradio-success input[type="checkbox"]:checked ~ label:before {
            color: #fff;
            background-color: #5cb85c;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Nastavenia </h1>
        </div>
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card shadow">
                    <h5 class="card-header">E-Mail pre dôležité informácie</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12">
                            <span style="font-weight: bold; font-size: 12px; color: red;">Povinné údaje sú označené červenou hviezdičkou</span> <span style="color: red">*</span><br>
                        </div>
                        <form action="{{route('setting.update.email')}}" method="post">
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="EA01" class="form-label">E-mailová adresa <span style="color: red">*</span></label>
                                <input type="email" class="form-control" id="EA01" name="email_info" value="@if(Auth::user()->email_info) {{Auth::user()->email_info}}@endif">
                                <div id="emailHelp" class="form-text">Kontaktný email</div>
                            </div>
                            <div class="mb-3 col-12">
                                <div class="funkyradio">
                                    <div class="funkyradio-success">
                                        <input type="checkbox" name="close_stocktake_notification" id="checkbox3" @if(Auth::user()->close_stocktake_notification == 1) checked @endif />
                                        <label for="checkbox3">Zaslať ukončenie inventúry na e-mail</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Uložiť</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="card shadow">
                    <h5 class="card-header">Fakturácia</h5>
                    <div class="card-body">

                        <div class="mb-3 col-12">
                            <span style="font-weight: bold; font-size: 12px; color: red;">Povinné údaje sú označené červenou hviezdičkou</span> <span style="color: red">*</span><br>
                        </div>
                        <form action="{{route('setting.update.invoice')}}" method="post">
                            @csrf
                            <div class="mb-3 col-12 row">
                                <div class="mb-3 col-12">
                                    <label for="EA02" class="form-label">E-mailová adresa <span style="color: red">*</span></label>
                                    <input type="email" class="form-control" id="EA02" name="email_invoice" value="@if(Auth::user()->email_invoice){{Auth::user()->email_invoice}}@endif" required>
                                    <div id="emailHelp" style="color: forestgreen; font-weight: bold; font-size: 14px" class="form-text">E-mailová adresa na ktorú Vám budú zaslané faktúry.</div>
                                </div>
                            </div>
                            <div class="mb-3 col-12 row">
                                <div class="mb-3 col-12">
                                    <label for="EA02" class="form-label">Telefónne číslo <span style="color: red">*</span></label>
                                    <input type="phone" class="form-control" id="EA02" name="invoice_phone" value="@if(Auth::user()->invoice_phone){{Auth::user()->invoice_phone}}@endif" required>
                                </div>
                            </div>
                            <div class="mb-3 col-12 row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="EAF01" class="form-label">Meno (Názov fakturanta) <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="EAF01" name="invoice_name" value="@if(Auth::user()->invoice_name){{Auth::user()->invoice_name}}@endif" required>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="EAF02" class="form-label">Priezvisko <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="EAF02" name="invoice_surname" value="@if(Auth::user()->invoice_surname){{Auth::user()->invoice_surname}}@endif" required>
                                </div>
                            </div>
                            <div class="mb-3 col-12 row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="EAF03" class="form-label">Názov spoločnosti</label>
                                    <input type="text" class="form-control" id="EAF03" name="invoice_company_name" value="@if(Auth::user()->invoice_company_name){{Auth::user()->invoice_company_name}}@endif">
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="EAF05" class="form-label">Adresa <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="EAF05" name="invoice_address" value="@if(Auth::user()->invoice_address){{Auth::user()->invoice_address}}@endif" required>
                                </div>
                            </div>

                            <div class="mb-3 col-12 row">
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="EAF06" class="form-label">PSČ <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="EAF06" name="invoice_psc" value="@if(Auth::user()->invoice_psc){{Auth::user()->invoice_psc}}@endif" required>
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="EAF07" class="form-label">Mesto <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="EAF07" name="invoice_city" value="@if(Auth::user()->invoice_city){{Auth::user()->invoice_city}}@endif" required>
                                </div>
                            </div>

                            <div class="mb-3 col-12 row">
                                <div class="mb-3 col-12 col-xl-6">
                                    <label for="EAF08" class="form-label">Krajina <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="EAF08" name="invoice_stat" value="@if(Auth::user()->invoice_stat){{Auth::user()->invoice_stat}}@endif" required>
                                </div>
                                <div class="mb-3 col-12 col-xl-6">
                                    <label for="EAF09" class="form-label">IČO</label>
                                    <input type="text" class="form-control" id="EAF09" name="invoice_ico" value="@if(Auth::user()->invoice_ico){{Auth::user()->invoice_ico}}@endif">
                                </div>
                            </div>

                            <div class="mb-3 col-12 row">
                                <div class="mb-3 col-12 col-xl-6">
                                    <label for="EAF10" class="form-label">DIČ</label>
                                    <input type="text" class="form-control" id="EAF10" name="invoice_dic" value="@if(Auth::user()->invoice_dic){{Auth::user()->invoice_dic}}@endif">
                                </div>
                                <div class="mb-3 col-12 col-xl-6">
                                    <label for="EAF11" class="form-label">IČ DPH</label>
                                    <input type="text" class="form-control" id="EAF11" name="invoice_icdph" value="@if(Auth::user()->invoice_icdph){{Auth::user()->invoice_icdph}}@endif">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">Uložiť</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
