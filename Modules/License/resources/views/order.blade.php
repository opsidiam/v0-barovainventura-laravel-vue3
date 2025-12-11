@extends('app.layouts.app')

@section('content')
    <div id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <!-- Compact Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4 mb-0">Nákupný košík</h1>
                    <a href="{{ route('license.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Pokračovať v nákupe
                    </a>
                </div>

                <div class="row">
                    <!-- Left column - License Info -->
                    <div class="col-lg-7 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white py-2">
                                <h4 class="mb-0">{{ $license_custome['name'] ?? $license['name'] }}</h4>
                            </div>
                            <div class="card-body">
                                <h2 class="card-title pricing-card-title mb-3">{{ ($license_custome['price'] ?? $license['price']) }}€</h2>

                                @if($license_custome && $license_custome['price_off'] > 0)
                                    <div class="alert alert-success py-2 mb-3 small">
                                        <i class="fas fa-tag mr-1"></i> Množstevná zľava: <strong>{{ $license_custome['price_off'] }}%</strong>
                                    </div>
                                @endif

                                @if(isset($license_custome['time']))
                                    @if($license_custome['time'] == 31104000)
                                    <div class="alert alert-success py-2 mb-3 small">
                                        <i class="fas fa-tag mr-1"></i> Zľava za obdobie: <strong>10 %</strong>
                                    </div>
                                    @endif
                                @else
                                    @if(isset($license['time']))
                                        @if($license['time'] == 31104000)
                                        <div class="alert alert-success py-2 mb-3 small">
                                            <i class="fas fa-tag mr-1"></i> Zľava za obdobie: <strong>10 %</strong>
                                        </div>
                                        @endif
                                    @endif
                                @endif

                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2"><i class="fas fa-calendar-alt mr-2 text-primary"></i> Doba: {{ ($license_custome['time'] ?? $license['time']) / 86400 }} dní</li>
                                    <li class="mb-2"><i class="fas fa-check-circle mr-2 text-primary"></i> Prístup: Plný</li>
                                    <li class="mb-2"><i class="fas fa-store mr-2 text-primary"></i> Počet podnikov: {{ $license_custome['count'] ?? '1' }}</li>
                                    <li class="mb-2"><i class="fas fa-envelope mr-2 text-primary"></i> Notifikácie e-mailom: Áno</li>
                                    <li class="mb-2"><i class="fas fa-file-pdf mr-2 text-primary"></i> PDF výstup: Áno</li>
                                </ul>

                                <div class="d-flex justify-content-between border-top pt-3">
                                    <h4 class="mb-0">Celkom:</h4>
                                    <h4 class="mb-0 text-primary">{{ format_price($total_price) }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-3 py-2 small">
                            <i class="fas fa-info-circle mr-1"></i> Nákup neodkladajte. Pridanie položiek do košíka neznamená ich rezerváciu.
                        </div>
                    </div>

                    <!-- Right column - Billing Form -->
                    <div class="col-lg-5">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white py-2">
                                <h4 class="mb-0">Fakturačné údaje</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('license.checkout') }}" method="post" id="orderForm">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order_id }}">

                                    <div class="alert alert-warning small py-2 mb-3">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Povinné údaje sú označené <span class="text-danger">*</span>
                                    </div>

                                    <!-- Personal Info -->
                                    <h6 class="mb-3 border-bottom pb-1 small">Osobné údaje</h6>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Meno <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="invoice_name"
                                                   value="{{ old('invoice_name', $user['invoice_name']) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Priezvisko <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="invoice_surname"
                                                   value="{{ old('invoice_surname', $user['invoice_surname']) }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">E-mail <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email_invoice"
                                               value="{{ old('email_invoice', $user['email_invoice']) }}" required>
                                        <small class="form-text text-success">
                                            <i class="fas fa-check-circle mr-1"></i> Na túto adresu bude zaslaná faktúra
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Telefón <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" name="invoice_phone"
                                               value="{{ old('invoice_phone', $user['invoice_phone']) }}" required>
                                    </div>

                                    <!-- Company purchase checkbox -->
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="companyPurchase" name="company_purchase"
                                               @if($user['invoice_company_name']) checked @endif>
                                        <label class="form-check-label" for="companyPurchase">
                                            Nákup na IČO
                                        </label>
                                    </div>

                                    <!-- Company fields -->
                                    <div id="companyFields" class="mb-3" @if(!$user['invoice_company_name']) style="display: none;" @endif>
                                        <div class="mb-3">
                                            <label class="form-label">Názov spoločnosti</label>
                                            <input type="text" class="form-control" name="invoice_company_name"
                                                   value="{{ old('invoice_company_name', $user['invoice_company_name']) }}">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">IČO</label>
                                                <input type="text" class="form-control" name="invoice_ico"
                                                       value="{{ old('invoice_ico', $user['invoice_ico']) }}">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">DIČ</label>
                                                <input type="text" class="form-control" name="invoice_dic"
                                                       value="{{ old('invoice_dic', $user['invoice_dic']) }}">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label">IČ DPH</label>
                                                <input type="text" class="form-control" name="invoice_icdph"
                                                       value="{{ old('invoice_icdph', $user['invoice_icdph']) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address Info -->
                                    <h6 class="mt-3 mb-3 border-bottom pb-1 small">Doručovacia adresa</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Adresa <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="invoice_address"
                                               value="{{ old('invoice_address', $user['invoice_address']) }}" required>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Mesto <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="invoice_city"
                                                   value="{{ old('invoice_city', $user['invoice_city']) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">PSČ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="invoice_psc"
                                                   value="{{ old('invoice_psc', $user['invoice_psc']) }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Krajina <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="invoice_stat"
                                               value="{{ old('invoice_stat', $user['invoice_stat']) }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100 py-2 mt-2">
                                        <i class="fas fa-check-circle me-1"></i> Dokončiť objednávku
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle company fields
            const companyCheckbox = document.getElementById('companyPurchase');
            const companyFields = document.getElementById('companyFields');

            function toggleCompanyFields() {
                companyFields.style.display = companyCheckbox.checked ? 'block' : 'none';
            }

            companyCheckbox.addEventListener('change', toggleCompanyFields);
            toggleCompanyFields(); // Initialize

            // Form validation
            document.getElementById('orderForm').addEventListener('submit', function(e) {
                const ico = document.querySelector('input[name="invoice_ico"]').value;
                const icdph = document.querySelector('input[name="invoice_icdph"]').value;

                if (ico && !/^[0-9]{8}$/.test(ico)) {
                    alert('IČO musí obsahovať presne 8 číslic');
                    e.preventDefault();
                    return false;
                }

                if (icdph && !icdph.startsWith('SK')) {
                    alert('IČ DPH musí začínať "SK"');
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection

@section('css')
    <style>
        /* Consistent styling with the cart design */
        .card {
            overflow: visible;
            margin-bottom: 1rem;
        }

        .card-header {
            padding: 0.5rem 1rem;
        }

        .form-label {
            margin-bottom: 0.2rem;
            font-size: 0.875rem;
        }

        .alert {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Two-column layout */
        @media (min-width: 992px) {
            .col-lg-7 {
                padding-right: 15px;
            }
            .col-lg-5 {
                padding-left: 15px;
            }
        }

        /* Checkbox styling */
        .form-check-input {
            margin-top: 0.25rem;
        }

        /* Price display */
        .text-primary {
            color: #4e73df !important;
        }

        /* List items */
        .list-unstyled li {
            padding: 0.25rem 0;
        }
    </style>
@endsection
