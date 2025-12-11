@extends('app.layouts.app')

@section('content')
    <div id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <!-- Compact Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4 mb-0">Nákupný košík</h1>
                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Pokračovať v nákupe
                    </a>
                </div>

                @if($cart && count($cart) > 0)
                    <!-- Two-column layout with fixed heights -->
                    <div class="row">
                        <!-- Left column - Products (fixed height) -->
                        <div class="col-lg-7 mb-4">
                            <div class="card shadow-sm" style="height: fit-content;">
                                <div class="card-body">
                                    <h5 class="mb-3">Produkty ({{ count($cart) }})</h5>

                                    @foreach($cart as $key => $item)
                                        <div class="cart-item mb-3 pb-3 border-bottom">
                                            <div class="row align-items-center">
                                                <div class="col-2 col-md-1">
                                                    <div class="product-image-container rounded">
                                                        <img src="{{ $item['img'] }}" class="img-fluid" alt="{{ $item['name'] }}">
                                                    </div>
                                                </div>

                                                <div class="col-5 col-md-5">
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                                                        <div class="d-flex">
                                                            <small class="text-muted me-2">{{ $item['price'] }} €/ks</small>
                                                            <small class="text-muted">{{ $item['count'] }} ks</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-5 col-md-6 text-end">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <p class="mb-0 fw-bold me-3 pr-2">{{ $item['total_price'] }} €</p>
                                                        @if($key != 0)
                                                            <form action="{{ route('product.remove-to-cart') }}" method="post" class="d-inline">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $key }}">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Right column - Order form -->
                        <div class="col-lg-5">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Sumár objednávky</h5>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Celkom za tovar:</span>
                                        <strong>{{ $money - 8 }} €</strong>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Doprava:</span>
                                        <strong>8 €</strong>
                                    </div>

                                    <div class="d-flex justify-content-between border-top pt-2 mb-3">
                                        <strong>Celková suma:</strong>
                                        <strong class="text-primary">{{ $money }} €</strong>
                                    </div>

                                    <div class="alert alert-info py-2 mb-3 small">
                                        <i class="fas fa-info-circle me-1"></i> Nákup neodkladajte. Košík nie je rezerváciou.
                                    </div>

                                    <form action="{{ route('product.checkout') }}" method="post" id="orderForm">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order_id }}">

                                        <!-- Personal info -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Meno <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="invoice_name"
                                                       value="{{ old('invoice_stat', $user->invoice_name ?? '') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Priezvisko <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="invoice_surname"
                                                       value="{{ old('invoice_stat', $user->invoice_surname ?? '') }}" required>
                                            </div>
                                        </div>

                                        <!-- Contact info -->
                                        <div class="mb-3">
                                            <label class="form-label">E-mail <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email_invoice"
                                                   value="{{ old('invoice_stat', $user->email_invoice ?? '') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Telefón <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="invoice_phone"
                                                   value="{{ old('invoice_stat', $user->invoice_phone ?? '') }}" required>
                                        </div>

                                        <!-- Company purchase checkbox -->
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" @if($user->invoice_company_name) checked @endif id="companyPurchase" name="company_purchase">
                                            <label class="form-check-label" for="companyPurchase">
                                                Nákup na IČO
                                            </label>
                                        </div>

                                        <!-- Company fields (hidden by default) -->
                                        <div id="companyFields" class="mb-3" @if(!$user->invoice_company_name) style="display: none;" @endif >
                                            <div class="mb-3">
                                                <label class="form-label">Názov spoločnosti</label>
                                                <input type="text" class="form-control" name="invoice_company_name"
                                                       value="{{ old('invoice_stat', $user->invoice_company_name ?? '') }}">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">IČO</label>
                                                    <input type="text" class="form-control" name="invoice_ico"
                                                           value="{{ old('invoice_stat', $user->invoice_ico ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">DIČ</label>
                                                    <input type="text" class="form-control" name="invoice_dic"
                                                           value="{{ old('invoice_stat', $user->invoice_dic ?? '') }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">IČ DPH</label>
                                                    <input type="text" class="form-control" name="invoice_icdph"
                                                           value="{{ old('invoice_stat', $user->invoice_icdph ?? '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Address fields -->
                                        <div class="mb-3">
                                            <label class="form-label">Adresa <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="invoice_address"
                                                   value="{{ old('invoice_stat', $user->invoice_address ?? '') }}" required>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Mesto <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="invoice_city"
                                                       value="{{ old('invoice_stat', $user->invoice_city ?? '') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">PSČ <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="invoice_psc"
                                                       value="{{ old('invoice_stat', $user->invoice_psc ?? '') }}" required>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Krajina <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="invoice_stat"
                                                   value="{{ old('invoice_stat', $user->invoice_psc ?? '') }}" required>
                                        </div>
                                        <button @if(count($cart) <= 1) disabled @endif type="submit" class="btn btn-success w-100 py-2">
                                            <i class="fas fa-check-circle me-1"></i> Dokončiť objednávku
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Empty Cart -->
                    <div class="empty-cart text-center py-4">
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <h5 class="text-danger mb-3">Košík je prázdny</h5>
                        <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left me-1"></i> Späť do obchodu
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const companyCheckbox = document.getElementById('companyPurchase');
            const companyFields = document.getElementById('companyFields');

            // Initialize based on current checkbox state
            toggleCompanyFields();

            // Add event listener
            companyCheckbox.addEventListener('change', toggleCompanyFields);

            function toggleCompanyFields() {
                companyFields.style.display = companyCheckbox.checked ? 'block' : 'none';
            }
        });
    </script>
@endsection

@section('css')
    <style>
        .product-image-container {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 3px;
            overflow: hidden;
            padding: 2px;
        }

        .product-image-container img {
            max-height: 100%;
            width: auto;
            max-width: 100%;
        }

        .cart-item {
            padding: 0.5rem 0;
        }

        @media (min-width: 768px) {
            .product-image-container {
                height: 80px;
            }
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

        /* Price and delete button alignment */
        .text-end .d-flex {
            justify-content: flex-end;
        }

        /* Checkbox styling */
        .form-check-input {
            margin-top: 0.25rem;
        }

        /* Fixed height for left column */
        .card {
            overflow: visible;
        }
    </style>
@endsection
