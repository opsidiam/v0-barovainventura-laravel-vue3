@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">{{__('admin.warehouse_overview', ['type' => __('admin.unapproved-products')])}}</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    {{--                    <div class="card-header py-3">--}}
                    {{--                        <button class="btn btn-success" data-toggle="modal" data-target="#AdminAddItem">Pridať produkt</button>--}}
                    {{--                    </div>--}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="DataTableItemAdmin" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">{{__('warehouse.table.name')}}</th>
                                    <th class="text-center">{{__('warehouse.table.value')}}</th>
                                    <th class="text-center">{{__('warehouse.table.alcohol')}}</th>
                                    <th class="text-center">{{__('warehouse.table.type')}}</th>
                                    <th class="text-center">{{__('warehouse.table.ean')}}</th>
                                    <th class="text-center">{{__('warehouse.table.action')}}</th>
                                </tr>
                                </thead>
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

@section('js')
    <script>
        $('#DataTableItemAdmin').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true,
            searching: true,
            paging: true,
            pageLength: 50,
            ajax: "{{ route('admin.data-table.unapproved-products') }}",
            columns: [
                { data: 'name', name: 'name', orderable: true, searchable: true },
                { data: 'volume', name: 'volume', orderable: true, searchable: true },
                { data: 'alcohol', name: 'alcohol', orderable: true, searchable: true },
                { data: 'type', name: 'type', orderable: true, searchable: true },
                { data: 'ean', name: 'ean', orderable: true, searchable: true },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            ordering: true,
            "order":[[1, 'desc']]
        });
    </script>
@endsection
