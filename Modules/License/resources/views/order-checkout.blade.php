@extends('app.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Objednávka dokončená</h1>
                    <div class="btn-group">
                        <a href="{{ route('license.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i> Licencie
                        </a>
                        @if(isset($url) && !$payed)
                            <a href="{{ $url }}" target="_blank" class="btn btn-primary ml-2">
                                Zaplatiť online <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Alert Notification -->
                <div class="alert alert-success shadow-sm">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x text-success mr-3"></i>
                        <div>
                            <h5 class="alert-heading mb-1">Ďakujeme za váš nákup!</h5>
                            Na e-mailovú adresu <strong>{{ $invoice_data['fa_email'] }}</strong> sme vám zaslali inštrukcie k platbe.
                            @isset($items->products)
                                Zakúpené produkty budú odoslané po prijatí platby.
                            @else
                                Vaša licencia bude aktivovaná po prijatí platby.
                            @endisset
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="row">
                    <!-- Billing Information -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="m-0 font-weight-bold">
                                    <i class="fas fa-file-invoice mr-2"></i> Fakturačné údaje
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-2"><strong>Meno:</strong></p>
                                        <p class="mb-2"><strong>Adresa:</strong></p>
                                        <p class="mb-2"><strong>Mesto:</strong></p>
                                        <p class="mb-2"><strong>Štát:</strong></p>
                                        <p class="mb-2"><strong>E-mail:</strong></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-2">{{ $invoice_data['fa_name'] }}</p>
                                        <p class="mb-2">{{ $invoice_data['fa_address'] }}</p>
                                        <p class="mb-2">{{ $invoice_data['fa_psc'] }} {{ $invoice_data['fa_city'] }}</p>
                                        <p class="mb-2">{{ $invoice_data['fa_stat'] }}</p>
                                        <p class="mb-2">{{ $invoice_data['fa_email'] }}</p>
                                    </div>
                                </div>

                                @if($invoice_data['fa_ico'] || $invoice_data['fa_dic'] || $invoice_data['fa_icdph'])
                                    <hr>
                                    <h6 class="font-weight-bold">Firemné údaje</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if($invoice_data['fa_ico'])<p class="mb-2"><strong>IČO:</strong></p>@endif
                                            @if($invoice_data['fa_dic'])<p class="mb-2"><strong>DIČ:</strong></p>@endif
                                            @if($invoice_data['fa_icdph'])<p class="mb-2"><strong>IČ DPH:</strong></p>@endif
                                        </div>
                                        <div class="col-md-6">
                                            @if($invoice_data['fa_ico'])<p class="mb-2">{{ $invoice_data['fa_ico'] }}</p>@endif
                                            @if($invoice_data['fa_dic'])<p class="mb-2">{{ $invoice_data['fa_dic'] }}</p>@endif
                                            @if($invoice_data['fa_icdph'])<p class="mb-2">{{ $invoice_data['fa_icdph'] }}</p>@endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="m-0 font-weight-bold">
                                    <i class="fas fa-shopping-basket mr-2"></i>
                                    Licencia
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">
                                            @isset($items['license_custome'])
                                                {{ $items['license_custome']['name'] }}
                                                <small class="text-muted">({{ $items['license_custome']['count'] }} ks)</small>
                                            @else
                                                {{ $items['license']['name'] }}
                                                <small class="text-muted">(1 ks)</small>
                                            @endisset
                                        </h6>
                                    </div>
                                    <span class="font-weight-bold">
                                        @isset($items['license_custome'])
                                            {{ $items['license_custome']['price'] }} €
                                        @else
                                            {{ $items['license']['price'] }} €
                                        @endisset
                                    </span>
                                </div>

                                <div class="bg-light p-3 mt-4 rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Celková suma:</h5>
                                        <h4 class="mb-0 text-primary font-weight-bold">{{ $price }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('license.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i> Licencie
                    </a>
                    @if(isset($url) && !$payed)
                        <a href="{{ $url }}" target="_blank" class="btn btn-primary">
                            Zaplatiť online <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }
        .border-bottom {
            border-bottom: 1px solid #eee !important;
        }
    </style>
@endsection
