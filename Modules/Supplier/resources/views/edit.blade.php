@extends('app.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Upraviť dodávateľa</h1>
                </div>

                <!-- Form Card -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">Detail dodávateľa: {{ $supplier->name_supplier }}</h6>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSupplierModal">
                            <i class="fas fa-trash-alt"></i> Vymazať
                        </button>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('supplier.update', $supplier->id) }}" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 border-bottom pb-2">Základné informácie</h5>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editName" class="font-weight-bold">Názov dodávateľa *</label>
                                        <input type="text" name="name" id="editName" class="form-control"
                                               value="{{ old('name', $supplier->name_supplier) }}" required>
                                        <div class="invalid-feedback">Prosím vyplňte názov dodávateľa</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editNote" class="font-weight-bold">Poznámka</label>
                                        <textarea class="form-control" name="note" id="editNote" rows="1">{{ old('note', $supplier->note) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 border-bottom pb-2">Kontaktné údaje</h5>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editEmail" class="font-weight-bold">Email</label>
                                        <input type="email" name="email" id="editEmail" class="form-control"
                                               value="{{ old('email', $supplier->email) }}" require>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editPhone" class="font-weight-bold">Telefónne číslo</label>
                                        <input type="tel" name="phone" id="editPhone" class="form-control"
                                               value="{{ old('phone', $supplier->phone) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3 border-bottom pb-2">Adresa</h5>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="editAddress" class="font-weight-bold">Ulica</label>
                                        <input type="text" name="address" id="editAddress" class="form-control"
                                               value="{{ old('address', $supplier->address) }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="editAddressNumber" class="font-weight-bold">Číslo domu</label>
                                        <input type="text" name="address_number" id="editAddressNumber" class="form-control"
                                               value="{{ old('address_number', $supplier->address_number) }}">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="editCity" class="font-weight-bold">Mesto</label>
                                        <input type="text" name="city" id="editCity" class="form-control"
                                               value="{{ old('city', $supplier->city) }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editPsc" class="font-weight-bold">PSČ</label>
                                        <input type="text" name="psc" id="editPsc" class="form-control"
                                               value="{{ old('psc', $supplier->psc) }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="editStat" class="font-weight-bold">Štát</label>
                                        <input type="text" name="stat" id="editStat" class="form-control"
                                               value="{{ old('stat', $supplier->stat) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary mr-2">
                                        <i class="fas fa-times mr-1"></i> Zrušiť
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i> Uložiť zmeny
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteSupplierModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Potvrdenie zmazania</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Naozaj chcete vymazať dodávateľa <strong>{{ $supplier->name_supplier }}</strong>?</p>
                    <p class="text-muted small">Táto akcia je nevratná a zmaže všetky súvisiace údaje.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Zrušiť
                    </button>
                    <form method="POST" action="{{ route('supplier.destroy', $supplier->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt mr-1"></i> Vymazať
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#deleteSupplierModal form').submit(function(e) {
                if (!confirm('Naozaj chcete vymazať tohto dodávateľa?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
