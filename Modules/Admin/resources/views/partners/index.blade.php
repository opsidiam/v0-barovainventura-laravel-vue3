@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">
            <div class="container-fluid">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h1 class="h3 text-gray-800">{{ __('admin.partners_overview') }}</h1>

                    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> {{ __('admin.add_partner') ?? 'Pridať obchodníka' }}
                    </a>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="DataTablePartners" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 320px">{{ __('admin.table.name') }}</th>
                                    <th style="width: 260px" class="text-center">{{ __('admin.table.mail') }}</th>
                                    <th class="text-center" style="width: 180px">{{ __('admin.table.created') }}</th>
                                    <th class="text-center" style="width: 180px">{{ __('admin.table.action') }}</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
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
        $(function(){
            $('#DataTablePartners').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                searching: true,
                paging: true,
                ordering: true,
                pageLength: 50,
                ajax: "{{ route('admin.data-table.partners') }}",
                columns: [
                    { data: 'name',        name: 'name', orderable: false, searchable: true },
                    { data: 'email',       name: 'email', orderable: false, searchable: true, className:'text-center' },
                    { data: 'created_at',  name: 'created_at', orderable: true, searchable: false, className:'text-center' },
                    { data: 'action',      name: 'action', orderable: false, searchable: false, className:'text-center' },
                ],
                order: [[2, 'desc']], // podľa created_at
                language: {
                    url: '{{ asset("vendor/datatables/i18n/Slovak.json") }}' // ak máš lokalizáciu
                }
            });
        });
    </script>
@endsection
