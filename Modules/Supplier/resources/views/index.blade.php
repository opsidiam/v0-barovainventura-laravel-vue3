@extends('app.layouts.app')
@section('css')
    <style>
        .soft-warning {
            background-color: rgba(255, 193, 7, 0.12);
            border: 1px solid rgba(255, 193, 7, 0.35);
            border-radius: .35rem;
        }
        .soft-warning .card-header {
            background: transparent;
            border: 0;
        }
        .soft-warning .btn.btn-link {
            color: #7a5a00;
            text-decoration: none;
            width: 100%;
        }
        .soft-warning .btn.btn-link:hover {
            color: #5d4600;
        }
        .soft-warning .card-body {
            background-color: rgba(255, 193, 7, 0.08);
            border-top: 1px dashed rgba(255, 193, 7, 0.35);
        }

        /* Ikona – otočenie pri otvorení */
        .soft-warning .fa-chevron-down {
            transition: transform .2s ease;
        }
        .soft-warning .btn[aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
        }
    </style>
@endsection
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Prehľad dodávateľov</h1>
                    <button class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#supplierAddNew">
                    <span class="icon text-white-50 pt-2">
                        <i class="fas fa-plus"></i>
                    </span>
                        <span class="text">Pridať dodávateľa</span>
                    </button>
                </div>
                <div class="accordion" id="faqAccordion">
                    <div class="card border-0 soft-warning mb-2">
                        <div class="card-header p-0" id="faqHeading1">
                            <button class="btn btn-link btn-block text-left px-3 py-2 d-flex justify-content-between align-items-center"
                                    type="button" data-toggle="collapse" data-target="#faq1"
                                    aria-expanded="false" aria-controls="faq1">
                                Ako funguje prehľad dodávateľov?
                                <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                        </div>
                        <div id="faq1" class="collapse" aria-labelledby="faqHeading1" data-parent="#faqAccordion">
                            <div class="card-body pt-2 pb-3">
                                <h6 class="mb-2">Čo je <em>Dodávateľ</em>?</h6>
                                <p class="mb-3">
                                    Dodávateľ je partner, od ktorého objednávate tovar. V systéme slúži na
                                    <strong>automatické objednávanie</strong>, preto je dôležité vyplniť
                                    <strong>kontaktný e-mail dodávateľa</strong>, na ktorý bude po potvrdení odoslaná objednávka.
                                </p>

                                <h6 class="mb-2">Ako pridať dodávateľa</h6>
                                <ol class="mb-3 pl-3">
                                    <li>Klikni na <strong>Pridať dodávateľa</strong>.</li>
                                    <li>Vyplň <strong>názov firmy</strong> a <strong>e-mail</strong> (povinné pre odosielanie objednávok).</li>
                                    <li>Voliteľne doplň telefón, IČO, poznámku.</li>
                                    <li>Ulož formulár. Dodávateľ sa zobrazí v prehľade.</li>
                                </ol>

                                <h6 class="mb-2">Priradenie dodávateľa k produktom</h6>
                                <ol class="mb-3 pl-3">
                                    <li>V <strong>Sklade produktov</strong> otvor úpravu produktu.</li>
                                    <li>Vyber <strong>dodávateľa</strong> zo zoznamu (môžeš označiť preferovaného, ak ich je viac).</li>
                                    <li>Nastav <strong>minimálne množstvo</strong> na sklade (hranica, pri ktorej sa odporučí doobjednať).</li>
                                    <li>Ulož zmeny.</li>
                                </ol>

                                <h6 class="mb-2">Automatické objednávanie – ako to funguje</h6>
                                <ol class="mb-3 pl-3">
                                    <li>Po vykonaní <strong>inventúry</strong> systém porovná aktuálny stav s tvojím minimom na každom produkte.</li>
                                    <li>Ak je stav <strong>nižší ako minimum</strong>, systém pripraví <strong>sumár objednávok</strong> a pošle ho
                                        na <strong>tvoj kontaktný e-mail</strong> (nie priamo dodávateľovi).</li>
                                    <li>V e-maile uvidíš, <strong>aké množstvo odporúča systém objednať</strong> pre jednotlivé produkty.</li>
                                    <li><strong>Potvrď</strong> alebo <strong>stornuj</strong> objednávku kliknutím na odkaz v e-maile.</li>
                                    <li>Až po tvojom <strong>potvrdení</strong> systém odošle objednávku na <strong>e-mail dodávateľa</strong>
                                        priradeného k daným produktom.</li>
                                </ol>

                                <h6 class="mb-2">Tipy a poznámky</h6>
                                <ul class="mb-0 pl-3">
                                    <li>Bez vyplneného <strong>e-mailu dodávateľa</strong> nie je možné objednávku odoslať.</li>
                                    <li>Ak má produkt viac dodávateľov, označ <strong>preferovaného</strong>, aby systém vedel, komu poslať objednávku.</li>
                                    <li>Minimálne množstvo nastav realisticky – zohľadni spotrebu a dodacie lehoty.</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Suppliers Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Zoznam dodávateľov</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTablesuppliersList" width="99%"
                                   cellspacing="0">
                                <thead class="thead-light">
                                <tr>
                                    <th>Názov</th>
                                    <th>Adresa</th>
                                    <th>Mesto</th>
                                    <th>Poznámka</th>
                                    <th>Kontakt</th>
                                    <th class="text-center" style="width: 150px">Akcie</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($suppliers as $supplier)
                                    <tr>
                                        <td class="font-weight-bold">{{ $supplier->name_supplier }}</td>
                                        <td>{{ $supplier->address }} {{ $supplier->address_number }}</td>
                                        <td>{{ $supplier->city }} <small class="text-muted">{{ $supplier->psc }}</small>
                                        </td>
                                        <td>
                                            @if($supplier->note)
                                                <span class="d-inline-block text-truncate" style="max-width: 200px;"
                                                      title="{{ $supplier->note }}">
                                                {{ $supplier->note }}
                                            </span>
                                            @else
                                                <span class="text-muted">Žiadna poznámka</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a href="mailto:{{ $supplier->email }}" class="text-primary mb-1">
                                                    <i class="fas fa-envelope mr-1"></i> {{ $supplier->email }}
                                                </a>
                                                @if($supplier->phone)
                                                    <a href="tel:{{ $supplier->phone }}" class="text-success">
                                                        <i class="fas fa-phone-alt mr-1"></i> {{ $supplier->phone }}
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('supplier.edit', $supplier->id)}}" class="btn btn-sm btn-primary mr-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger delete-supplier"
                                                    data-toggle="modal"
                                                    data-target="#deleteSupplierModal"
                                                    data-supplier-id="{{ $supplier->id }}"
                                                    data-supplier-name="{{ $supplier->name_supplier }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
@endsection

@include('supplier::modals.create')
@include('supplier::modals.delete')
@section('js')
    <script>
        $(document).ready(function() {
            $('.delete-supplier').click(function() {
                const supplierId = $(this).data('supplier-id');
                const supplierName = $(this).data('supplier-name');

                // Nastavíme obsah modalu
                $('#supplierNameToDelete').text(supplierName);

                // Upravíme action atribút formulára
                $('#deleteSupplierForm').attr('action', '/app/supplier/' + supplierId);
            });
        });
    </script>
@endsection
