@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">{{__('admin.support_overview')}}</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="DataTableItemAdmin" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">{{__('admin.table.name')}}</th>
                                    <th class="text-center">{{__('admin.table.mail')}}</th>
                                    <th class="text-center">{{__('admin.table.place')}}</th>
                                    <th class="text-center">{{__('admin.table.problem')}}</th>
                                    <th class="text-center">{{__('admin.table.message')}}</th>
                                    <th class="text-center">{{__('admin.table.status')}}</th>
                                    <th class="text-center">{{__('admin.table.action')}}</th>
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
            ordering: true,
            pageLength: 50,
            ajax: "{{ route('admin.data-table.support') }}",
            columns: [
                { data: 'name', name: 'name', orderable: true, searchable: true },
                { data: 'email', name: 'email', orderable: true, searchable: true },
                { data: 'place_problem', name: 'place_problem', orderable: true, searchable: true },
                { data: 'what_problem', name: 'what_problem', orderable: true, searchable: true },
                { data: 'message', name: 'message', orderable: true, searchable: true },
                { data: 'status', name: 'status', orderable: true, searchable: true },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            "order":[[1, 'desc']]
        });
    </script>
@endsection
