@extends('app.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Upraviť produkt</h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{$item->cargo->name}}</h5>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteItemModal">
                            <i class="fas fa-trash-alt"></i> Vymazať
                        </button>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{route('item.update', $item->id)}}">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Dodávateľ</label>
                                        <select class="form-control" name="service_id" id="supplierSelect">
                                            <option value="" disabled>Vyberte dodávateľa</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}" @if($item->supplier_id == $supplier->id) selected @endif>
                                                    {{$supplier->name_supplier}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Kód produktu dodávateľa</label>
                                        <input type="text" name="product_key_supplier" class="form-control"
                                               value="{{$item->product_key_supplier}}" placeholder="Kód produktu dodávateľa">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nákupná cena (fľaša)</label>
                                        <input type="text" name="price_buy" value="{{$item->price_buy}}"
                                               class="form-control" placeholder="Nákupná cena">
                                        <small>Cena za fľašu, napr. "10.99"</small>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Predajná cena (pohár)</label>
                                        <input type="text" name="price_sell" value="{{$item->price_sell}}"
                                               class="form-control" placeholder="Predajná cena">
                                        <small>Cena za porciu, napr. "1.20"</small>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Predajný objem (pohár 'ml')</label>
                                        <input type="text" name="weight_sell" value="{{$item->weight_sell}}"
                                               class="form-control" placeholder="Predajný objem">
                                        <small>Objem porcie v mililitroch, napr. "40"</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Uložiť zmeny</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Potvrdenie zmazania</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Naozaj chcete vymazať produkt <strong>{{ $item->cargo->name }}</strong>?
                    <p class="text-muted mt-2">Táto akcia je nevratná.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                    <form method="POST" action="{{ route('item.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Vymazať</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Inicializácia Select2 pre vyhľadávanie dodávateľov
            $('#supplierSelect').select2({
                placeholder: "Vyhľadať dodávateľa",
                selectionCssClass : "form-control",
                allowClear: true,
                escapeMarkup: function (markup) { return markup; },
                width: '100%',
                height: '38px',
                language: {
                    noResults: function() {
                        return "<b>Dodávateľ neexistuje.</b> <a href='{{route('supplier.index')}}' target='_blank'>Pridať dodávateľa</a>";
                    },
                    inputTooShort: function() {
                        return "Zadajte minimálne 2 znaky";
                    },
                    searching: function() {
                        return "Vyhľadávam...";
                    }
                },
                ajax: {
                    url: '{{route('supplier.live-data.search')}}',
                    method: 'POST',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            _token: '{{ csrf_token() }}'
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            // Ochrana proti dvojitému odoslaniu formulára
            $('form').submit(function() {
                $(this).find('button[type="submit"]').prop('disabled', true);
            });
        });
    </script>
@endsection
