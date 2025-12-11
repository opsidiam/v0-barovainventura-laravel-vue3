@extends('admin.layouts.app')

@section('content')
    <style>
        .card .card-header > .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        .card .card-header > .row > [class^="col-"] {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

    </style>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">

                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-3">
                    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">{{ __('admin.leads_overview') }}</h1>
                    <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> {{ __('admin.create_lead') }}
                    </a>
                </div>

                <div class="card shadow">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs card-header-tabs" style="margin-left: -.09rem !important; margin-bottom: 0rem !important;" id="leadTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-new" data-toggle="tab" href="#pane-new" role="tab" aria-controls="pane-new" aria-selected="true">
                                    <i class="fas fa-star mr-1 text-warning"></i> {{ __('admin.leads.tab_new') }}
                                    <span class="badge badge-pill badge-light ml-1" id="count-new">—</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-contact" data-toggle="tab" href="#pane-contact" role="tab" aria-controls="pane-contact" aria-selected="false">
                                    <i class="fas fa-spinner mr-1 text-info"></i> {{ __('admin.leads.tab_contact') }}
                                    <span class="badge badge-pill badge-light ml-1" id="count-contact">—</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-waiting" data-toggle="tab" href="#pane-waiting" role="tab" aria-controls="pane-waiting" aria-selected="false">
                                    <i class="fas fa-triangle-exclamation mr-1 text-danger"></i> {{ __('admin.leads.tab_waiting') }}
                                    <span class="badge badge-pill badge-light ml-1" id="count-waiting">—</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-close" data-toggle="tab" href="#pane-close" role="tab" aria-controls="pane-close" aria-selected="false">
                                    <i class="fas fa-check mr-1 text-success"></i> {{ __('admin.leads.tab_close') }}
                                    <span class="badge badge-pill badge-light ml-1" id="count-close">—</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="leadTabsContent">
                            {{-- NEW --}}
                            <div class="tab-pane fade show active" id="pane-new" role="tabpanel" aria-labelledby="tab-new">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm w-100" id="dt-new">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">{{ __('admin.table.source') }}</th>
                                            <th class="text-center" style="width: 450px">{{ __('admin.table.data') }}</th>
                                            <th class="text-center">{{ __('admin.table.open') }}</th>
                                            <th class="text-center">{{ __('admin.table.send_lead_message') }}</th>
                                            <th class="text-center">{{ __('admin.table.send_cp') }}</th>
                                            <th class="text-center">{{ __('admin.table.status') }}</th>
                                            <th class="text-center">{{ __('admin.table.action') }}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            {{-- IN PROGRESS --}}
                            <div class="tab-pane fade" id="pane-contact" role="tabpanel" aria-labelledby="tab-contact">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm w-100" id="dt-contact">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">{{ __('admin.table.source') }}</th>
                                            <th class="text-center" style="width: 450px">{{ __('admin.table.data') }}</th>
                                            <th class="text-center">{{ __('admin.table.open') }}</th>
                                            <th class="text-center">{{ __('admin.table.send_lead_message') }}</th>
                                            <th class="text-center">{{ __('admin.table.send_cp') }}</th>
                                            <th class="text-center">{{ __('admin.table.status') }}</th>
                                            <th class="text-center">{{ __('admin.table.action') }}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            {{-- CLOSED --}}
                            <div class="tab-pane fade" id="pane-waiting" role="tabpanel" aria-labelledby="tab-waiting">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm w-100" id="dt-waiting">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">{{ __('admin.table.source') }}</th>
                                            <th class="text-center" style="width: 450px">{{ __('admin.table.data') }}</th>
                                            <th class="text-center">{{ __('admin.table.open') }}</th>
                                            <th class="text-center">{{ __('admin.table.send_lead_message') }}</th>
                                            <th class="text-center">{{ __('admin.table.send_cp') }}</th>
                                            <th class="text-center">{{ __('admin.table.status') }}</th>
                                            <th class="text-center">{{ __('admin.table.action') }}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            {{-- CLOSED --}}
                            <div class="tab-pane fade" id="pane-close" role="tabpanel" aria-labelledby="tab-close">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm w-100" id="dt-close">
                                        <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">{{ __('admin.table.source') }}</th>
                                            <th class="text-center" style="width: 450px">{{ __('admin.table.data') }}</th>
                                            <th class="text-center">{{ __('admin.table.open') }}</th>
                                            <th class="text-center">{{ __('admin.table.send_lead_message') }}</th>
                                            <th class="text-center">{{ __('admin.table.send_cp') }}</th>
                                            <th class="text-center">{{ __('admin.table.status') }}</th>
                                            <th class="text-center">{{ __('admin.table.action') }}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                        </div> {{-- /.tab-content --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        (function () {
            const endpoint = "{{ route('admin.data-table.leads') }}";

            function iconBool(data) {
                if (data > 1) return '<i class="fas fa-exclamation-circle text-warning"></i>';
                return data ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>';
            }
            function iconOpen(data) {
                return data ? '<i class="fas fa-circle text-success"></i>' : '<i class="fas fa-circle text-danger"></i>';
            }

            function buildTable(selector, status, countBadgeId) {
                const dt = $(selector).DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    deferRender: true,
                    searching: true,
                    paging: true,
                    ordering: true,
                    pageLength: 25,
                    lengthMenu: [[25, 50, 100], [25, 50, 100]],
                    ajax: {
                        url: endpoint,
                        data: function(d){
                            d.status = status; // <- filter podľa tabu
                        }
                    },
                    columns: [
                        { data: 'source', name: 'source', className: 'text-center' },
                        { data: 'data',   name: 'data',   orderable: false, searchable: true },
                        {
                            data: 'open', name: 'open', className:'text-center',
                            render: function (data, type, row) { return iconOpen(data); }
                        },
                        {
                            data: 'send_lead_message', name: 'send_lead_message', className:'text-center',
                            render: function (data, type, row) { return iconBool(data); }
                        },
                        {
                            data: 'send_cp', name: 'send_cp', className:'text-center',
                            render: function (data, type, row) { return iconBool(data); }
                        },
                        { data: 'status', name: 'status', className:'text-center' },
                        { data: 'action', name: 'action', orderable: false, searchable: false, className:'text-center' },
                    ],
                    order: [[2, 'desc']],
                    drawCallback: function(settings){
                        // pokus o update badge počtu z celkov – ak server vráti 'recordsTotal' pre filter
                        try {
                            const json = settings.json || {};
                            if (countBadgeId) {
                                document.getElementById(countBadgeId).innerText = (json.recordsTotal ?? '—');
                            }
                        } catch (e) {}
                    }
                });

                // Refresh pri zobrazení tabu (DataTables potrebuje redraw pri display:none -> block)
                $('a[data-toggle="tab"][href="'+selector.replace('#','##')+'"]').on('shown.bs.tab', function(){
                    dt.columns.adjust().responsive.recalc();
                });

                return dt;
            }

            // Inicializácia troch tabuliek
            const dtNew      = buildTable('#dt-new',      'new',        'count-new');
            const dtContact = buildTable('#dt-contact', 'contact','count-contact');
            const dtWaiting   = buildTable('#dt-waiting',   'waiting',     'count-waiting');
            const dtClose   = buildTable('#dt-close',   'close',     'count-close');

            // Ak prepneš tab manuálne
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();
            });
        })();
    </script>
@endsection
