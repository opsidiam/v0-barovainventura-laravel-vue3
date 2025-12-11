@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">

                {{-- Header --}}
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">
                        {{ __('admin.partners.detail_title') }} – {{ $partner->first_name ?? '' }} {{ $partner->last_name ?? '' }}
                    </h1>
                    <div>
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-light border">
                            <i class="fas fa-arrow-left mr-1"></i> {{ __('admin.back_to_list') }}
                        </a>
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-primary ml-2">
                            <i class="fas fa-edit mr-1"></i> {{ __('admin.edit') }}
                        </a>
                    </div>
                </div>

                {{-- INFO o obchodníkovi --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.partners.partner_info') }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-4 mb-2">
                                        <div class="small text-muted">{{ __('admin.table.name') }}</div>
                                        <div class="font-weight-bold">
                                            {{ $partner->first_name }} {{ $partner->last_name }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-2">
                                        <div class="small text-muted">{{ __('admin.partners.company') }}</div>
                                        <div class="font-weight-bold">
                                            {{ $partner->company ?? '—' }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-2">
                                        <div class="small text-muted">{{ __('admin.table.mail') }}</div>
                                        <div class="font-weight-bold">
                                            <a href="mailto:{{ $partner->email }}">{{ $partner->email }}</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-2">
                                        <div class="small text-muted">{{ __('admin.partners.phone') }}</div>
                                        <div class="font-weight-bold">
                                            <a href="tel:{{ $partner->phone }}">{{ $partner->phone ?? '—' }}</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-2">
                                        <div class="small text-muted">{{ __('admin.table.created') }}</div>
                                        <div class="font-weight-bold">
                                            {{ optional($partner->created_at)->format('Y-m-d H:i') ?? '—' }}
                                        </div>
                                    </div>
                                    {{-- prípadné ďalšie mini-štatistiky si vieš doplniť tu --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pridelení klienti --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.partners.assigned_clients') }}</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 26%">{{ __('admin.table.user') }}</th>
                                    <th class="text-center" style="width: 14%">{{ __('admin.table.registered_at') }}</th>
                                    <th class="text-center" style="width: 14%">{{ __('admin.table.assigned_at') }}</th>
                                    <th class="text-center" style="width: 14%">{{ __('admin.table.licence_status') }}</th>
                                    <th class="text-right" style="width: 12%">{{ __('admin.table.commission_amount') }}</th>
                                    <th class="text-center" style="width: 10%">{{ __('admin.table.payout_status') }}</th>
                                    <th class="text-center" style="width: 10%">{{ __('admin.table.paid_at') }}</th>
                                    <th class="text-center" style="width: 10%">{{ __('admin.table.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clients as $u)
                                    @php
                                        $commission = is_null($u->partnerCommissions[0]->amount) ? 20.00 : (float) $u->partnerCommissions[0]->amount;

                                        $licActive = !empty($u->licence_expire) && \Illuminate\Support\Carbon::parse($u->licence_expire)->isFuture();
                                        $licBadge  = $licActive ? 'success' : 'secondary';
                                        $licText   = $licActive ? __('admin.licence_active') : __('admin.licence_inactive');

                                        $status = (string) ($u->partnerCommissions[0]->status ?? 'pending');
                                        $badge = [
                                          'pending'   => 'warning',
                                          'paid'      => 'success',
                                          'cancelled' => 'secondary',
                                        ][$status] ?? 'light';

                                        $assignedAt = $u->partner_assigned_at ?? $u->created_at;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">{{ $u->name }}</div>
                                            <small class="text-muted">{{ $u->email }}</small>
                                        </td>
                                        <td class="text-center">
                                            {{ optional($u->created_at)->format('Y-m-d H:i') ?? '—' }}
                                        </td>
                                        <td class="text-center">
                                            {{ optional($assignedAt)->format('Y-m-d H:i') ?? '—' }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-{{ $licBadge }}">{{ $licText }}</span>
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($commission, 2, ',', ' ') }} €
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-{{ $badge }}">{{ __('admin.payout_status.'.$status) }}</span>
                                        </td>
                                        <td class="text-center">
                                            {{ optional($u->partnerCommissions[0]->paid_at)->format('Y-m-d') ?? '—' }}
                                        </td>
                                        <td class="text-center">
                                            @if($status !== 'paid')
                                                <form method="POST"
                                                      action="{{ route('admin.partners.clients.payout', ['partner' => $partner->id, 'user' => $u->id]) }}"
                                                      onsubmit="return confirm('{{ __('admin.partners.mark_paid_confirm') }}');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-sm btn-success">
                                                        <i class="fas fa-check mr-1"></i>{{ __('admin.partners.mark_paid_btn') }}
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-outline-secondary" disabled>
                                                    <i class="fas fa-check mr-1"></i>{{ __('admin.partners.already_paid') }}
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            {{ __('admin.partners.no_clients_assigned') }}
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="p-3">
                            {{ $clients->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
