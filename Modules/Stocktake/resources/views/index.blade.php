@extends('app.layouts.app')

@section('css')
    <style>
        .processing-row td {
            position: relative;
            padding: 8px;
        }

        .blur-content {
            filter: blur(2px);
            opacity: 0.5;
            pointer-events: none;
        }

        .processing-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0,0,0, 0.1);
            color: #6c757d;
            font-weight: 500;
        }

        .processing-row td:first-child .processing-overlay {
            justify-content: flex-start;
            padding-left: 12px;
        }

        #loadingIndicator {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
    </style>
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Prehľad inventúr</h1>

                <div id="loadingIndicator" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Načítavam...</span>
                    </div>
                    <p class="mt-2">Aktualizujem dáta...</p>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="DataTableInvPrehld" width="99%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Názov inventúry</th>
                                    <th style="width: 10rem" class="text-center">Počet produktov</th>
                                    <th style="width: 10rem" class="text-center">Dátum vytvorenia</th>
                                    <th style="width: 15rem" class="text-center">Dátum vymazania inventúry</th>
                                    <th>Export</th>
                                </tr>
                                </thead>
                                <tbody id="stocktakesTableBody">
                                @include('stocktake::partials.closed_stocktakes', ['stocktakes' => $stocktakes])
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
    @if($reload)
        <script>
        $(document).ready(function() {
            let autoRefreshEnabled = true;
            let refreshTimeout;

            // Funkcia pre načítanie dát
            function loadStocktakes() {
                if (!autoRefreshEnabled) return;

                $('#loadingIndicator').show();

                $.ajax({
                    url: '{{ route("stocktake.closed") }}',
                    type: 'GET',
                    success: function(response) {
                        $('#stocktakesTableBody').html(response.html);
                        initializeTooltips();

                        // Aktualizácia stavu auto refresh podľa odpovede z backendu
                        autoRefreshEnabled = response.reload;

                        if (autoRefreshEnabled) {
                            scheduleNextRefresh();
                        }
                    },
                    error: function(xhr) {
                        console.error('Chyba pri načítaní dát:', xhr);
                        toastr.error('Nepodarilo sa načítať dáta');
                        scheduleNextRefresh();
                    },
                    complete: function() {
                        $('#loadingIndicator').hide();
                    }
                });
            }

            function scheduleNextRefresh() {
                if (refreshTimeout) clearTimeout(refreshTimeout);
                if (autoRefreshEnabled) {
                    refreshTimeout = setTimeout(loadStocktakes, 20000);
                }
            }

            // Inicializácia tooltipov (ak sú použité)
            function initializeTooltips() {
                $('[data-toggle="tooltip"]').tooltip();
            }

            // Prvé spustenie
            loadStocktakes();

            // Inicializácia po prvom načítaní
            initializeTooltips();
        });
    </script>
    @endif
@endsection
