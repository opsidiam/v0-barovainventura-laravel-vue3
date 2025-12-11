@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">{{__('admin.newsletter_overview')}}</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{route('newsletter.create')}}">
                            <button class="btn btn-success">
                                <i class="fas fa-plus-circle mr-1"></i> Pridať newsletter
                            </button>
                        </a>
                    </div>
                    <div class="card-body col-xl-12 col-sm-6">
                        <div class="table-responsive col-xl-12 col-sm-6">
                            <table class="table table-bordered" id="DataTableNewsletterAdmin" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="text-center">{{__('admin.table.subject')}}</th>
                                    <th class="text-center" style="width: 100px !important;">{{__('admin.table.mail')}}</th>
                                    <th class="text-center" style="width: 100px !important;">{{__('admin.table.status')}}</th>
                                    <th class="text-center" style="width: 140px !important;">{{__('admin.table.created')}}</th>
                                    <th class="text-center" style="width: 200px !important;">{{__('admin.table.action')}}</th>
                                </tr>
                                </thead>
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
        $('#DataTableNewsletterAdmin').DataTable({
            processing: true,
            serverSide: true,
            deferRender: true,
            searching: true,
            paging: true,
            ordering: true,
            pageLength: 50,
            ajax: "{{ route('admin.data-table.newsletter') }}",
            columns: [
                { data: 'subject', name: 'subject', orderable: true, searchable: true },
                { data: 'message', name: 'message', orderable: false, searchable: false },
                { data: 'sending_done', name: 'sending_done', orderable: true, searchable: true },
                { data: 'created_at', name: 'created_at', orderable: true, searchable: true },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            "order":[[1, 'desc']]
        });
    </script>
@endsection
