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
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Prehľad skladu</h1>
                <div class="accordion" id="faqAccordion">
                    <div class="card border-0 soft-warning mb-2">
                        <div class="card-header p-0" id="faqHeading1">
                            <button class="btn btn-link btn-block text-left px-3 py-2 d-flex justify-content-between align-items-center"
                                    type="button" data-toggle="collapse" data-target="#faq1"
                                    aria-expanded="false" aria-controls="faq1">
                                Ako funguje sklad?
                                <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                        </div>
                        <div id="faq1" class="collapse" aria-labelledby="faqHeading1" data-parent="#faqAccordion">
                            <div class="card-body pt-2 pb-3">
                                <h6 class="mb-2">Čo je <em>Sklad</em>?</h6>
                                <p class="mb-3">
                                    Sklad je prehľad všetkých položiek, ktoré sa do systému dostávajú najmä cez <strong>Barovú inventúru</strong>.
                                    Produkty si <strong>nemusíš vopred ručne vytvárať</strong>.
                                </p>

                                <h6 class="mb-2">Najrýchlejší postup (odporúčaný)</h6>
                                <ol class="mb-3 pl-3">
                                    <li>Spusti svoju <strong>prvú inventúru</strong>.</li>
                                    <li>Po jej dokončení systém <strong>automaticky pridá</strong> zistené produkty do tvojho skladu.</li>
                                    <li>Následne ich uvidíš v prehľade skladu a môžeš s nimi ďalej pracovať.</li>
                                </ol>

                                <h6 class="mb-2">Manuálne pridanie produktov (ak to chceš spraviť ručne)</h6>
                                <ol class="mb-3 pl-3">
                                    <li>Pod týmto oknom si vyber, či chceš pridať <strong>rozlievaný produkt</strong> (meraný na objem – napr. l/cl)
                                        alebo <strong>kusový produkt</strong> (počítaný na kusy).</li>
                                    <li>Po kliknutí sa otvorí okno na pridanie produktu.</li>
                                    <li>Zadaj <strong>názov produktu</strong>; systém zobrazí všetky položky, ktoré názvu zodpovedajú.</li>
                                    <li>Vyber správny produkt zo zoznamu a potvrď pridanie.</li>
                                </ol>

                                <h6 class="mb-2">Tipy a poznámky</h6>
                                <ul class="mb-0 pl-3">
                                    <li>Manuálne pridávanie je <strong>časovo náročnejšie</strong>, preto odporúčame najprv spraviť inventúru,
                                        ktorá produkty do skladu pridá automaticky.</li>
                                    <li>Ak sa ti požadovaný produkt nezobrazí, skús názov upresniť (značka, objem, balenie).</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

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
{{--                                    <th>Aktuálne skladom</th>--}}
                                    <th>Posledná inventúra</th>
                                    <th>Dodávateľ</th>
                                    <th class="text-center" style="width: 120px">Akcie</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($items ?? [] as $item)
                                    <tr>
                                        <td>
                                            {{ $item->cargo->name }}
                                            @if($item->cargo->type == 0)
                                                ({{ $item->cargo->volume }} ml, {{ $item->cargo->alcohol }} %)
                                            @else
                                                ({{ $item->cargo->volume }} g)
                                            @endif
                                        </td>

{{--                                        <td class="stock-status @if($item->cargo->weight_count >= $item->cargo->volume && $item->cargo->weight_count > 0 && $item->cargo->volume > 0) @if(floor($item->cargo->weight_count / $item->cargo->volume) == 1) stock-status--warning @else stock-status--success @endif @else stock-status--danger @endif">--}}
{{--                                            @if($item->cargo->weight_count >= $item->cargo->volume && $item->cargo->weight_count > 0 && $item->cargo->volume > 0)--}}
{{--                                                {{ number_format(($item->cargo->weight_count - (floor($item->cargo->weight_count / $item->cargo->volume) * $item->cargo->volume))/1000, 2) }} l--}}
{{--                                                ({{ floor($item->cargo->weight_count / $item->cargo->volume) }} ks)--}}
{{--                                                <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#AddItemValue_{{ $item->cargo->id }}">--}}
{{--                                                    <i class="fas fa-plus"></i>--}}
{{--                                                </button>--}}
{{--                                            @else--}}
{{--                                                Musíš uzavrieť inventúru--}}
{{--                                            @endif--}}
{{--                                        </td>--}}

                                        <td>
                                            @if($item->weight_count === null)
                                                Ešte nebola vykonaná inventúra
                                            @elseif($item->cargo->volume === null)
                                                @if($item->cargo->type == 0)
                                                    Chýbajúca hodnota 'objem'
                                                @else
                                                    Chýbajúca hodnota 'hmotnosť'
                                                @endif
                                            @else
                                            @if($item->cargo->type == 0)
                                                {{ ($item->weight_count - (floor($item->weight_count / $item->cargo->volume) * $item->cargo->volume)) }} ml
                                                ({{ $item->full_pack_count }} ks) [Spolu: {{number_format((($item->full_pack_count * $item->cargo->volume) + ($item->weight_count - (floor($item->weight_count / $item->cargo->volume) * $item->cargo->volume)))/1000, 2)}} L]
                                            @else
                                                ({{ $item->full_pack_count }} ks)
                                            @endif
                                            @endif
                                        </td>

                                        <td>
                                            <select class="form-control form-control-sm supplier-select" data-item-id="{{ $item->id }}">
                                                <option value="" disabled selected>Vyberte dodávateľa</option>
                                                @foreach($suppliers ?? [] as $supplier)
                                                    <option value="{{ $supplier->id }}" @if($item->supplier_id == $supplier->id) selected @endif>
                                                        {{ $supplier->name_supplier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-primary mr-1" title="Upraviť">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <button class="btn btn-sm btn-danger delete-item"
                                                    data-toggle="modal"
                                                    data-target="#deleteItemModal"
                                                    data-item-id="{{ $item->id }}"
                                                    data-item-name="{{ $item->cargo->name }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="AddItemValue_{{ $item->cargo->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Doplnenie tovaru</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{ route('item.value.add') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->cargo->id }}">
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

@include('item::modals.delete')
@section('js')
    @if($tutorial_show)
        <script>
            Swal.fire({
                title: "<strong>Prehľad skladu</strong>",
                html: `V sklade sa nachádzajú všetky položky, ktoré sú v podniku.<br>
               Položky si môžeš manuálne priradiť alebo budú automaticky priradené po vykonaní prvej inventúry.`,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `
            <i class="fa fa-thumbs-up"></i> Chápem
        `,
                icon: "question"
            });
        </script>

    @endif
    <script>
        $(document).ready(function() {
            $('.delete-item').click(function() {
                const delitemId = $(this).data('item-id');
                const delitemName = $(this).data('item-name');

                // Nastavíme obsah modalu
                $('#itemNameToDelete').text(delitemName);

                // Upravíme action atribút formulára
                $('#deleteItemForm').attr('action', '/app/item/' + delitemId);
            });

            // Spracovanie zmien dodávateľa s ochranou proti viacnásobnému volaniu
            $(document).off('change', '.supplier-select').on('change', '.supplier-select', function() {
                const select = $(this);
                const itemId = select.data('item-id');
                const supplierId = select.val();

                // Validácia - ak nie je vybraný dodávateľ
                if(!supplierId) {
                    toastr.warning('Prosím vyberte dodávateľa');
                    return;
                }

                // Zablokovanie selectu počas requestu
                select.prop('disabled', true);

                $.ajax({
                    type: 'POST',
                    url: '{{ route("item.supplier.update") }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': itemId,
                        'supplier_id': supplierId
                    },
                    success: function(response) {
                        if(response && response.success) {
                            toastr.success('Dodávateľ bol úspešne aktualizovaný');
                        } else {
                            toastr.warning('Dodávateľ nebol aktualizovaný');
                            select.val(select.data('previous-value'));
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Nastala chyba pri aktualizácii');
                        select.val(select.data('previous-value'));
                    },
                    complete: function() {
                        select.prop('disabled', false);
                    }
                });
            });

            $('.supplier-select').each(function() {
                $(this).data('previous-value', $(this).val());
            });
        });
    </script>
@endsection
