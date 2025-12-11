@extends('app.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Domov</h1>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Skladom (Druhov tovaru)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $storage_item_count }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <a href="{{ route('stocktake.create') }}" class="btn btn-success btn-block">Začať inventúru</a>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="DataTableItemHome" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Názov (Objem, Alk.)</th>
                            <th>Aktuálne skladom (ks / Bal.)</th>
                            <th>Posledná inventúra</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Názov (Objem, Alk.)</th>
                            <th>Aktuálne skladom (ks / Bal.)</th>
                            <th>Posledná inventúra</th>
                        </tr>
                        </tfoot>
                        <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td>{{ $item->name }} ({{ $item->volume }} ml, {{ $item->alcohol }} %)</td>

                                        <td @class([
                                                'font-weight-bold' => true,
                                                'text-success' => $item->weight_count && $item->weight_empty && $item->weight_full && $item->volume ,
                                                'text-warning' => $item->volume && $item->weight_count && (!$item->weight_empty || !$item->weight_full),
                                                'text-danger' => $item->weight_count === null
                                            ])>
                                            @if($item->volume && $item->weight_count && ($item->weight_count >= $item->volume))
                                                {{ $item->weight_count/1000 }} l (cca. {{ floor($item->weight_count / $item->volume) }}x kusov / balení)
                                            @elseif($item->weight_count !== null)
                                                @php
                                                    $canCalculate = $item->weight_count > 0
                                                        && $item->weight_empty > 0
                                                        && $item->weight_full > 0
                                                        && $item->volume > 0;
                                                    if ($canCalculate) {
                                                        $calculated = number_format(
                                                            (intval($item->weight_count) /
                                                            ((intval($item->weight_full) - intval($item->weight_empty)) /
                                                            intval($item->volume))),
                                                            2,
                                                            '.',
                                                            ''
                                                        );
                                                    $calculatedL = $calculated/1000;
                                                    }
                                                @endphp
                                                {{ $canCalculate ? "{$calculated} ml [{$calculatedL} l]" : "{$item->weight_count} g" }}
                                            @else
                                                Musíš uzavrieť inventúru
                                            @endif
                                        </td>

                                        <td>
                                            @if(empty($item->weight_last_stocktake))
                                                Ešte nebola vykonaná inventúra
                                            @else
                                                @php
                                                    $canCalculate = $item->weight_last_stocktake > 0
                                                        && $item->weight_empty > 0
                                                        && $item->weight_full > 0
                                                        && $item->volume > 0;

                                                    if ($canCalculate) {
                                                        $calculated = number_format(
                                                            (intval($item->weight_last_stocktake) /
                                                            ((intval($item->weight_full) - intval($item->weight_empty)) /
                                                            intval($item->volume))),
                                                            2,
                                                            '.',
                                                            ''
                                                        );
                                                    $calculatedL = $calculated/1000;
                                                    }
                                                @endphp

                                                {{ $canCalculate ? "{$calculated} ml [{$calculatedL} l]" : "{$item->weight_last_stocktake} g" }}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Žiadne položky na zobrazenie</td>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if($tutorial_show)
        <script>
            Swal.fire({
                title: "<strong>Domov</strong>",
                html: `Tu nájdeš všetky svoje produkty.<br>
               Ako si môžeš pridať produkty do svojho prehľadu?<br>
               Klikni na <strong><em>Začať inventúru</em></strong>, urob svoju prvú inventúru a po dokončení sa produkty automaticky pridajú do skladu.<br><br>
                    <b>Na váš e-mail sme poslali správu, v ktorej môžete požiadať o zapožičanie zariadenia na skúšobnú dobu.</b>`,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `
            <i class="fa fa-thumbs-up"></i> Dobre
        `,
                icon: "question"
            });
        </script>
    @endif
@endsection
