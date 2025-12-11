@extends('app.layouts.app')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">{{__('user.order_history')}}</h1>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableServicesList" width="99%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>{{__('user.order_history_table.type')}}</th>
                                    <th>{{__('user.order_history_table.price')}}</th>
                                    <th>{{__('user.order_history_table.created')}}</th>
                                    <th style="width: 2rem !important;">{{__('user.order_history_table.order_state')}}</th>
                                    <th style="width: 2rem !important;">{{__('user.order_history_table.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($order_history ?? [] as $order)
                                    <tr>
                                        <td>{{ $order->type === 'license' ? __('user.order_history_table.license') : __('user.order_history_table.product') }}</td>
                                        <td>{{ format_price($order->price) }}</td>
                                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                        <td>
                                            @if($order->payed)
                                                <span class="badge badge-success">
                                                    Zaplatené
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    Čaká sa na platbu
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                @if($order->pay_url && !$order->payed)
                                                    <a href="{{ $order->pay_url }}"
                                                       class="btn btn-sm btn-primary"
                                                       title="{{ __('user.order_history_table.pay') }}"
                                                       data-toggle="tooltip">
                                                        <i class="fas fa-credit-card"></i>
                                                    </a>
                                                @endif

                                                @if($order->invoice_data)
                                                    <a href="{{ $order->type === 'license' ? route('license.order.checkout', $order->id) : route('product.order.checkout', $order->id) }}"
                                                       class="btn btn-sm btn-info"
                                                       title="{{ __('user.order_history_table.details') }}"
                                                       data-toggle="tooltip">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif

                                                @if($order->payed)
                                                    <a href="#"
                                                       class="btn btn-sm btn-success"
                                                       title="{{ __('user.order_history_table.download') }}"
                                                       data-toggle="tooltip">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .btn-group .btn {
            margin-right: 5px;
        }
        .btn-group .btn:last-child {
            margin-right: 0;
        }
        /* Keep empty cells from collapsing */
        td {
            min-width: 50px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Initialize DataTable
            $('#dataTableServicesList').DataTable({
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [3,4] }, // Disable sorting for status and actions columns
                    { width: "10%", targets: [3,4] } // Set fixed width for these columns
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/{{ app()->getLocale() }}.json'
                }
            });
        });
    </script>
@endpush
