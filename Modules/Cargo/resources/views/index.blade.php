@extends('app.layouts.app')

@section('css')
    <style>

        .stock-status {
            font-weight: bold;
        }

        .stock-status--success {
            color: #1cc88a;
        }

        .stock-status--warning {
            color: #f6c23e;
        }

        .stock-status--danger {
            color: #e74a3b;
        }
    </style>
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Prehľad skladu</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#UserAddItem">
                            <i class="fas fa-plus-circle mr-1"></i> Pridať rozlievaný produkt
                        </button>
                        <button class="btn btn-info ml-2" data-toggle="modal" data-target="#UserAddItemNoAlko">
                            <i class="fas fa-plus-circle mr-1"></i> Pridať nerozlievaný produkt
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="DataTableItem" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                <tr>
                                    <th>Názov (Objem, Alk.)</th>
                                    <th>Aktuálne skladom</th>
                                    <th>Posledná inventúra</th>
                                    <th>Dodávateľ</th>
                                    <th class="text-center" style="width: 120px">Akcie</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($items ?? [] as $item)
                                    <tr>
                                        <td>
                                            {{ $item->name }}
                                            @if($item->type == 0)
                                                ({{ $item->volume }} ml, {{ $item->alcohol }} %)
                                            @else
                                                ({{ $item->volume }} g)
                                            @endif
                                        </td>

                                        <td class="stock-status @if($item->weight_count >= $item->volume && $item->weight_count > 0 && $item->volume > 0) @if(floor($item->weight_count / $item->volume) == 1) stock-status--warning @else stock-status--success @endif @else stock-status--danger @endif">
                                            @if($item->weight_count >= $item->volume && $item->weight_count > 0 && $item->volume > 0)
                                                {{ number_format(($item->weight_count - (floor($item->weight_count / $item->volume) * $item->volume))/1000, 2) }} l
                                                ({{ floor($item->weight_count / $item->volume) }} ks)
                                                <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#AddItemValue_{{ $item->id }}">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            @else
                                                Musíš uzavrieť inventúru
                                            @endif
                                        </td>

                                        <td>
                                            @if($item->weight_last_inv === null)
                                                Ešte nebola vykonaná inventúra
                                            @elseif($item->volume === null)
                                                @if($item->type == 0)
                                                    Chýbajúca hodnota 'objem'
                                                @else
                                                    Chýbajúca hodnota 'hmotnosť'
                                                @endif
                                            @else
                                                {{ number_format(($item->weight_last_inv - (floor($item->weight_last_inv / $item->volume) * $item->volume))/1000, 2) }} l
                                                ({{ floor($item->weight_last_inv / $item->volume) }} ks)
                                            @endif
                                        </td>

                                        <td>
                                            <select class="form-control form-control-sm supplier-select" data-item-id="{{ $item->id }}">
                                                <option value="" disabled selected>Vyberte dodávateľa</option>
                                                @foreach($suppliers ?? [] as $supplier)
                                                    <option value="{{ $supplier->id }}" @if($item->name_supplier == $supplier->name_supplier) selected @endif>
                                                        {{ $supplier->name_supplier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('user.item.detail', $item->id) }}" class="btn btn-sm btn-primary mr-1" title="Upraviť">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="{{ route('user.item.delete', $item->id) }}" class="btn btn-sm btn-danger" title="Odstrániť" onclick="return confirm('Naozaj chcete odstrániť tento produkt?')">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal pre doplnenie tovaru -->
                                    <div class="modal fade" id="AddItemValue_{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Doplnenie tovaru</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{ route('user.item.value.add') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Počet kusov na doplnenie</label>
                                                            <input type="number" class="form-control" name="count" value="1" min="1">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                                                        <button type="submit" class="btn btn-primary">Pridať</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Žiadne položky na zobrazenie</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Skryť loading overlay
            hideLoading('Spracúvam akciu...');

            // Spracovanie zmien dodávateľa
            $('.supplier-select').on('change', function() {
                const itemId = $(this).data('item-id');
                const serviceId = $(this).val();

                showLoading('Spracúvam akciu...');

                $.ajax({
                    type: 'POST',
                    url: '{{ route("item.supplier.update") }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': itemId,
                        'supplier_id': serviceId
                    },
                    success: function(response) {
                        if(response.success) {
                            toastr.success('Dodávateľ bol úspešne aktualizovaný');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Nastala chyba pri aktualizácii');
                    },
                    complete: function() {
                        hideLoading('Spracúvam akciu...');
                    }
                });
            });
        });
    </script>
@endsection
