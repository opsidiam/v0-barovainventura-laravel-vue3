@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">

                {{-- Header --}}
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">{{ __('admin.user_profile') }}</h1>
                    <div class="d-flex flex-wrap">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light border">
                            <i class="fas fa-arrow-left mr-1"></i> {{ __('admin.back_to_list') }}
                        </a>
                    </div>
                </div>

                @php
                    use Carbon\Carbon;
                    $licenceExpire = $user->licence_expire ? Carbon::parse($user->licence_expire) : null;
                    $daysLeft = $licenceExpire
                        ? (int) floor(Carbon::now()->startOfDay()->diffInDays($licenceExpire->startOfDay(), false))
                        : null;

                    $emailInfoVerified    = (int)($user->email_info_verify ?? 0) === 1;
                    $emailInvoiceVerified = (int)($user->email_invoice_verify ?? 0) === 1;

                    $permissionMap = [
                        0 => __('admin.permission.user'),
                        1 => __('admin.permission.moderator'),
                        2 => __('admin.permission.superadmin'),
                    ];
                    $licenceCategoryMap = [
                        1 => __('admin.licences_category.basic'),
                        2 => __('admin.licences_category.manager'),
                        3 => __('admin.licences_category.admin'),
                    ];
                    $licenceNotifyMap = [
                        'last_week' => __('admin.licence_last_notify.last_week'),
                        'last_day'  => __('admin.licence_last_notify.last_day'),
                        'expire'    => __('admin.licence_last_notify.expire'),
                    ];

                    // Zápožička – status
                    $loanStart  = $user->device_loan_start_at ? \Carbon\Carbon::parse($user->device_loan_start_at) : null;
                    $loanDays   = (int) ($user->device_loan_days ?? 0);
                    $loanDue    = $loanStart && $loanDays ? $loanStart->copy()->addDays($loanDays) : null;
                    $loanActive = $user->device_loan_start_at && $user->device_loan_serial && $user->device_loan_days
                                  && !$user->device_loan_purchased_at && !$user->device_loan_returned_at;
                @endphp
                                {{-- ======= SUMMARY CARD (iba dôležité info + akčné tlačidlá) ======= --}}
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between">
                            <div class="mb-3 mb-xl-0">
                                <div class="h4 mb-1">
                                    {{ $user->name }} {{ $user->surname ?? '' }}
                                </div>
                                <div class="small text-muted">
                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    @if($user->email_verified_at)
                                        <span class="badge badge-success ml-2">{{ __('admin.email_verified') }}</span>
                                    @else
                                        <span class="badge badge-warning ml-2">{{ __('admin.email_not_verified') }}</span>
                                    @endif
                                </div>

                                <div class="mt-2">
                                    {{-- Licencia badge --}}
                                    @if($licenceExpire)
                                        @if($daysLeft < 0)
                                            <span class="badge badge-danger mr-2">{{ __('admin.licence_expired') }}</span>
                                        @elseif($daysLeft === 0)
                                            <span class="badge badge-warning mr-2">{{ __('admin.expires_today') }}</span>
                                        @elseif($daysLeft <= 7)
                                            <span class="badge badge-warning mr-2">
                                                {{ __('admin.expires_in_days') }} {{ $daysLeft }} {{ __('admin.days') }}
                                            </span>
                                        @else
                                            <span class="badge badge-info mr-2">
                                                {{ __('admin.expires_in_days') }} {{ $daysLeft }} {{ __('admin.days') }}
                                            </span>
                                        @endif
                                    @endif

                                    {{-- Kategória licencie + počet podnikov --}}
                                    <span class="badge badge-light border mr-2">
                                        {{ $licenceCategoryMap[$user->licences_category] ?? $user->licences_category ?? '—' }}
                                    </span>
                                    <span class="badge badge-light border">
                                        {{ __('admin.table.licence_bar_count') }}: {{ $user->licence_bar_count ?? 0 }}
                                    </span>
                                    <span class="badge badge-light border">
                                        Zariadenie do: {{ $loanDue ? $loanDue->format('Y-m-d') : '—' }}
                                    </span>

                                </div>
                            </div>

                            {{-- Akcie – všetko v modaloch --}}
                            <div class="d-flex flex-wrap">
                                <button class="btn btn-outline-primary mr-2 mb-2"
                                        data-toggle="modal" data-target="#userDetailModal">
                                    <i class="fas fa-id-card mr-1"></i> Detail profilu
                                </button>
                                <button class="btn btn-outline-secondary mr-2 mb-2"
                                        data-toggle="modal" data-target="#billingModal">
                                    <i class="fas fa-file-invoice mr-1"></i> Fakturačné údaje
                                </button>
                                <button class="btn btn-outline-info mr-2 mb-2"
                                        data-toggle="modal" data-target="#licenceModal">
                                    <i class="fas fa-key mr-1"></i> Licencia
                                </button>
                                <button class="btn btn-outline-warning mr-2 mb-2"
                                        data-toggle="modal" data-target="#loanModal">
                                    <i class="fas fa-box-open mr-1"></i> Zápožička zariadenia
                                </button>
                                <button class="btn btn-outline-dark mr-2 mb-2"
                                        data-toggle="modal" data-target="#barsModal">
                                    <i class="fas fa-store mr-1"></i> Podniky
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @php $userNotes = $user->notes()->with('author')->latest()->get(); @endphp
                <div class="row">
                    <div class="col-12 col-xl-6">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Obchodník</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.users.assign-partner', $user) }}" method="POST" class="form-inline">
                                    @csrf
                                    <div class="form-group mr-2">
                                        <label for="partner_id" class="mr-2">Priradiť</label>
                                        <select name="partner_id" id="partner_id" class="form-control">
                                            <option value="">-- vyber --</option>
                                            @foreach($partners as $p)
                                                <option value="{{ $p->id }}" {{ $user->partner_id == $p->id ? 'selected' : '' }}>
                                                    {{ $p->full_name }} @if($p->company) ({{ $p->company }}) @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="btn btn-primary">Uložiť</button>
                                </form>

                                @if($user->partner)
                                    <hr>
                                    <form action="{{ route('admin.users.unassign-partner', $user) }}" method="POST"
                                          onsubmit="return confirm('Naozaj odpojiť obchodníka od používateľa?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger">Odpojiť obchodníka</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @include('admin::users.partials.notes', [
                                      'modelClass' => \App\Models\User::class,
                                      'modelId'    => $user->id,
                                      'notes'      => $userNotes,
                                    ])
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between">
                                    <div class="p-3 border-bottom">
                                        <form class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center"
                                              action="{{ route('admin.users.files.store', $user) }}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="custom-file mr-md-2 mb-2 mb-md-0">
                                                <input type="file" class="custom-file-input" id="userFile" name="file" required>
                                                <label class="custom-file-label" for="userFile">{{ __('admin.choose_file') ?? 'Vyber súbor' }}</label>
                                            </div>
                                            <input type="text" name="label" class="form-control mr-md-2 mb-2 mb-md-0"
                                                   placeholder="{{ __('admin.file_label_placeholder') ?? 'Popis (voliteľné)' }}">
                                            <input type="text" name="notes" class="form-control mr-md-2 mb-2 mb-md-0"
                                                   placeholder="{{ __('admin.file_notes_placeholder') ?? 'Poznámka (voliteľné)' }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-upload mr-1"></i> {{ __('admin.upload') ?? 'Nahrať' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Názov súboru</th>
                                                <th class="text-center" style="width:220px">Akcie</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($user->files()->latest()->get() as $f)
                                                @php $modalId = 'file-modal-'.$f->id; @endphp
                                                <tr>
                                                    <td class="text-truncate" style="max-width:420px" title="{{ $f->original_name }}">{{ $f->original_name }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.users.files.download', [$user, $f]) }}" class="btn btn-sm btn-outline-primary" title="Stiahnuť">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#{{ $modalId }}" title="Detail">
                                                            <i class="fas fa-info-circle"></i>
                                                        </button>
                                                        <form action="{{ route('admin.users.files.destroy', [$user, $f]) }}" method="POST" class="d-inline"
                                                              onsubmit="return confirm('{{ __('admin.confirm_delete') }}');">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger" title="Zmazať">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center text-muted py-4">{{ __('admin.no_files') ?? 'Zatiaľ žiadne súbory.' }}</td>
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
            </div>
        </div>
    </div>


        {{-- Detail profilu --}}
        <div class="modal fade" id="userDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"><div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-id-card mr-1"></i> Detail profilu</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                @foreach ([
                                    ['key' => 'name',        'val' => $user->name],
                                    ['key' => 'surname',     'val' => $user->surname ?? '—'],
                                    ['key' => 'mail',        'val' => null],
                                    ['key' => 'reference',   'val' => $user->reference],
                                    ['key' => 'permission',  'val' => $permissionMap[$user->permission] ?? $user->permission],
                                    ['key' => 'last_seen_at','val' => optional($user->last_seen_at)->format('Y-m-d H:i') ?? '—'],
                                    ['key' => 'created',     'val' => optional($user->created_at)->format('Y-m-d H:i')],
                                    ['key' => 'updated',     'val' => optional($user->updated_at)->format('Y-m-d H:i')],
                                ] as $row)
                                    <tr>
                                        <th class="bg-light text-left text-xl-right">{{ __('admin.table.' . $row['key']) }}</th>
                                        <td>
                                            @if($row['key'] === 'mail')
                                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                @if($user->email_verified_at)
                                                    <span class="badge badge-success ml-2">{{ __('admin.email_verified') }}</span>
                                                @else
                                                    <span class="badge badge-warning ml-2">{{ __('admin.email_not_verified') }}</span>
                                                @endif
                                            @elseif($row['key'] === 'reference')
                                                <code class="d-inline-block text-truncate" style="max-width:100%">{{ $row['val'] }}</code>
                                            @else
                                                {{ $row['val'] }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{-- E-mailové adresy info/invoice --}}
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                <tr>
                                    <th class="bg-light" style="width: 300px">{{ __('admin.table.email_info') }}</th>
                                    <td>
                                        {{ $user->email_info ?? '—' }}
                                        @if($user->email_info)
                                            <span class="badge badge-{{ $emailInfoVerified ? 'success' : 'warning' }} ml-2">
                                    {{ $emailInfoVerified ? __('admin.verified') : __('admin.not_verified') }}
                                </span>
                                            @if(!$emailInfoVerified && $user->email_info_token)
                                                <code class="ml-2">{{ Str::limit($user->email_info_token, 12, '…') }}</code>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">{{ __('admin.table.email_invoice') }}</th>
                                    <td>
                                        {{ $user->email_invoice ?? '—' }}
                                        @if($user->email_invoice)
                                            <span class="badge badge-{{ $emailInvoiceVerified ? 'success' : 'warning' }} ml-2">
                                    {{ $emailInvoiceVerified ? __('admin.verified') : __('admin.not_verified') }}
                                </span>
                                            @if(!$emailInvoiceVerified && $user->email_invoice_token)
                                                <code class="ml-2">{{ Str::limit($user->email_invoice_token, 12, '…') }}</code>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">{{ __('admin.table.missing_mail_send') }}</th>
                                    <td>
                            <span class="badge badge-{{ (int)$user->missing_mail_send ? 'info' : 'secondary' }}">
                                {{ (int)$user->missing_mail_send ? __('admin.sent') : __('admin.not_sent') }}
                            </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div></div>
        </div>

        {{-- Fakturačné údaje --}}
        <div class="modal fade" id="billingModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"><div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-file-invoice mr-1"></i> Fakturačné údaje</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                @foreach ([
                                    'invoice_phone','invoice_name','invoice_surname','invoice_company_name',
                                    'invoice_address','invoice_psc','invoice_city','invoice_stat',
                                    'invoice_ico','invoice_dic','invoice_icdph'
                                ] as $field)
                                    <tr>
                                        <th class="bg-light" style="width: 300px">{{ __('admin.table.' . $field) }}</th>
                                        <td>{{ $user->{$field} ?? '—' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div></div>
        </div>

        {{-- Licencia --}}
        <div class="modal fade" id="licenceModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"><div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-key mr-1"></i> Licencia</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                <tr>
                                    <th class="bg-light" style="width: 300px">{{ __('admin.table.licences_category') }}</th>
                                    <td>{{ $licenceCategoryMap[$user->licences_category] ?? $user->licences_category }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">{{ __('admin.table.licence_bar_count') }}</th>
                                    <td>{{ $user->licence_bar_count }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">{{ __('admin.table.licence_expire') }}</th>
                                    <td>
                                        {{ $licenceExpire ? $licenceExpire->format('Y-m-d H:i') : '—' }}
                                        @if(!is_null($daysLeft))
                                            @if($daysLeft < 0)
                                                <span class="badge badge-danger ml-2">{{ __('admin.expired') }}</span>
                                            @elseif($daysLeft === 0)
                                                <span class="badge badge-warning ml-2">{{ __('admin.expires_today') }}</span>
                                            @else
                                                <span class="badge badge-info ml-2">
                                            {{ __('admin.expires_in_days') }} {{ $daysLeft }} {{ __('admin.days') }}
                                        </span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">{{ __('admin.table.licence_last_notify') }}</th>
                                    <td>{{ $user->licence_last_notify ? ($licenceNotifyMap[$user->licence_last_notify] ?? $user->licence_last_notify) : '—' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">{{ __('admin.table.close_stocktake_notification') }}</th>
                                    <td>
                                <span class="badge badge-{{ (int)$user->close_stocktake_notification ? 'success' : 'secondary' }}">
                                    {{ (int)$user->close_stocktake_notification ? __('admin.enabled') : __('admin.disabled') }}
                                </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div></div>
        </div>

        {{-- Zápožičanie zariadenia --}}
        <div class="modal fade" id="loanModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"><div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-box-open mr-1"></i> Zápožičanie zariadenia</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        @if($user->device_loan_purchased_at)
                            <span class="badge badge-success mb-3">Zakúpené {{ optional($user->device_loan_purchased_at)->format('Y-m-d') }}</span>
                        @elseif($user->device_loan_returned_at)
                            <span class="badge badge-secondary mb-3">Vrátené {{ optional($user->device_loan_returned_at)->format('Y-m-d') }}</span>
                        @elseif($loanActive)
                            <span class="badge badge-info mb-3">Aktívne</span>
                        @endif

                        @if(!$loanActive)
                            <form method="POST" action="{{ route('admin.users.device_loan.store', $user) }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-sm-4">
                                        <label>Od kedy</label>
                                        <input type="date" name="device_loan_start_at" class="form-control"
                                               value="{{ old('device_loan_start_at', optional($loanStart)->format('Y-m-d')) }}" required>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Sériové číslo</label>
                                        <input type="text" name="device_loan_serial" class="form-control"
                                               value="{{ old('device_loan_serial', $user->device_loan_serial) }}" required>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Počet dní</label>
                                        <input type="number" min="1" name="device_loan_days" class="form-control"
                                               value="{{ old('device_loan_days', $user->device_loan_days ?? 30) }}" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Uložiť zápožičanie
                                </button>
                            </form>
                        @else
                            <div class="mb-3">
                                <div><strong>Od:</strong> {{ $loanStart->format('Y-m-d') }}</div>
                                <div><strong>Do:</strong> {{ $loanDue ? $loanDue->format('Y-m-d') : '—' }}</div>
                                <div><strong>Sériové číslo:</strong> {{ $user->device_loan_serial }}</div>
                                <div><strong>Počet dní:</strong> {{ $loanDays }}</div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <form method="POST" action="{{ route('admin.users.device_loan.purchased', $user) }}" class="mr-2">
                                    @csrf
                                    <button class="btn btn-success" onclick="return confirm('Potvrdiť: zariadenie bolo zakúpené?')">
                                        <i class="fas fa-shopping-cart mr-1"></i> Zariadenie zakúpil
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.device_loan.returned', $user) }}">
                                    @csrf
                                    <button class="btn btn-secondary" onclick="return confirm('Potvrdiť: zariadenie bolo vrátené?')">
                                        <i class="fas fa-undo mr-1"></i> Zariadenie vrátil
                                    </button>
                                </form>
                            </div>
                        @endif
                        @if($postalPackages)
                            <div class="table-responsive pt-3">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Sledovacie číslo</th>
                                        <th class="text-center" style="width:220px">Akcie</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($postalPackages as $postalPackage)
                                        <tr>
                                            <td class="text-truncate" style="max-width:420px">{{ $postalPackage->parcel_number }}</td>
                                            <td class="text-center">
                                                @if($postalPackage->label_url)
                                                    <a href="{{ $postalPackage->label_url }}" target="_blank" class="btn btn-sm btn-outline-info" title="Podací hárok">
                                                        <i class="fas fa-envelopes-bulk"></i>
                                                    </a>
                                                @endif
                                                @if($postalPackage->invoice_url)
                                                    <a href="{{ $postalPackage->invoice_url }}" target="_blank" class="btn btn-sm btn-outline-success" title="Faktúra">
                                                        <i class="fas fa-file-invoice-dollar"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-4">Zatiaľ žiadne dáta.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">

                        <form method="POST" action="{{ route('admin.users.device_loan.contract', $user) }}">
                            @csrf
                            <button class="btn btn-info">
                                <i class="fas fa-paper-plane mr-1"></i> Odoslať formulár na zmluvu
                            </button>
                        </form>
                        @if($deliveryInfo)
                            <form method="POST" action="{{ route('users.postal-package.sheet.create', $user) }}">
                                @csrf
                                <button class="btn btn-warning border">
                                    <i class="fas fa-paper-plane mr-1"></i> Vygenerovať ePodací hárok
                                </button>
                            </form>
                        @endif
                        <button class="btn btn-outline-success mr-2 mb-2"
                                data-dismiss="modal"
                                data-toggle="modal" data-target="#contractModal">
                            <i class="fas fa-file-pdf mr-1"></i> Vygenerovať zmluvu
                        </button>
                        <button class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div></div>
        </div>

        {{-- Detail každého súboru + poznámky k súboru --}}
        @foreach($user->files()->latest()->get() as $f)
            @php $fileModalId = 'file-modal-'.$f->id; @endphp
            <div class="modal fade" id="{{ $fileModalId }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document"><div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fas fa-file mr-1"></i> Detail súboru</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-bordered mb-3">
                                        <tbody>
                                        <tr><th>Názov</th><td>{{ $f->original_name }}</td></tr>
                                        <tr><th>MIME</th><td>{{ $f->mime ?? '—' }}</td></tr>
                                        <tr><th>Veľkosť</th>
                                            <td>
                                                @php
                                                    $sz = $f->size ?? 0;
                                                    $human = $sz >= 1048576 ? number_format($sz/1048576,2).' MB'
                                                          : ($sz >= 1024 ? number_format($sz/1024,1).' KB' : $sz.' B');
                                                @endphp
                                                {{ $human }}
                                            </td>
                                        </tr>
                                        <tr><th>Popis (label)</th><td>{{ $f->label ?? '—' }}</td></tr>
                                        <tr><th>Poznámka</th><td>{{ $f->notes ?? '—' }}</td></tr>
                                        <tr><th>Nahrané</th><td>{{ optional($f->created_at)->format('Y-m-d H:i') }}</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    @php $fileNotes = $f->notes()->with('author')->latest()->get(); @endphp
                                    @include('admin::users.partials.notes', [
                                      'modelClass' => \App\Models\UserFile::class,
                                      'modelId'    => $f->id,
                                      'notes'      => $fileNotes,
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('admin.users.files.download', [$user, $f]) }}" class="btn btn-primary">
                                <i class="fas fa-download mr-1"></i> Stiahnuť
                            </a>
                            <button type="button" class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                        </div>
                    </div></div>
            </div>
        @endforeach

        {{-- Vygenerovať zmluvu --}}
        <div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document"><div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-file-pdf mr-1"></i> {{ __('admin.generate_contract') }}</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('users.contracts.simple.store', $user) }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('admin.contract_template') }}</label>
                                <select name="template" class="form-control" required>
                                    @foreach(config('contracts.templates', []) as $key => $tplKey)
                                        <option value="{{ $key }}">{{ $tplKey['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label>{{ __('admin.loan_days') }}</label>
                                    <input type="number" name="param1" value="30" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label>{{ __('admin.label') }}</label>
                                    <input type="text" name="label" value="{{ __('admin.contract_label_placeholder') }}" class="form-control" placeholder="{{ __('admin.contract_label_placeholder') }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>{{ __('admin.notes') }}</label>
                                    <input type="text" name="notes" class="form-control">
                                </div>
                            </div>

                            <button class="btn btn-primary">
                                <i class="fas fa-file-pdf mr-1"></i> {{ __('admin.generate') }}
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div></div>
        </div>

        {{-- (Nepovinné) Podniky + poznámky k podnikom v modaloch --}}
        @isset($bars)
            @foreach($bars as $bar)
                @php $barModal = "barNotes_{$bar->id}"; @endphp
                <div class="modal fade" id="{{ $barModal }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document"><div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fas fa-store mr-1"></i> {{ $bar->name }} – poznámky</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                @php $barNotes = $bar->notes()->with('author')->latest()->get(); @endphp
                                @include('admin::users.partials.notes', [
                                  'modelClass' => \App\Models\Bar::class,
                                  'modelId'    => $bar->id,
                                  'notes'      => $barNotes,
                                ])
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                            </div>
                        </div></div>
                </div>
            @endforeach
        @endisset

    {{-- Zoznam barov používateľa --}}
    <div class="modal fade" id="barsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document"><div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-store mr-1"></i> Podniky v konte</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th style="width:28%">Názov</th>
                                <th>Mesto</th>
                                <th>Adresa</th>
                                <th>Šéf</th>
                                <th>Telefón</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user->bars ?? [] as $bar)
                                @php $barModalId = 'bar-detail-'.$bar->id; @endphp
                                <tr>
                                    <td class="text-truncate" title="{{ $bar->name }}">{{ $bar->name }}</td>
                                    <td>{{ $bar->city }}</td>
                                    <td>{{ $bar->address }} {{ $bar->number }}, {{ $bar->psc }}, {{ $bar->country }}</td>
                                    <td>{{ $bar->chef }}</td>
                                    <td>{{ $bar->phone }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Žiadne podniky.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                </div>
            </div></div>
    </div>

    {{-- Detail každého baru + poznámky k baru (ak používaš notes partial) --}}
    @foreach(($bars ?? []) as $bar)
        @php $barModalId = 'bar-detail-'.$bar->id; @endphp
        <div class="modal fade" id="{{ $barModalId }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document"><div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-store mr-1"></i> {{ $bar->name }} – detail
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive mb-3">
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                <tr><th class="bg-light" style="width: 220px">Názov</th><td>{{ $bar->name }}</td></tr>
                                <tr><th class="bg-light">Viac produktov</th><td>{{ (int)$bar->multiple_products ? 'Áno' : 'Nie' }}</td></tr>
                                <tr><th class="bg-light">Mesto</th><td>{{ $bar->city }}</td></tr>
                                <tr><th class="bg-light">Adresa</th><td>{{ $bar->address }} {{ $bar->number }}, {{ $bar->psc }}, {{ $bar->country }}</td></tr>
                                <tr><th class="bg-light">Šéfkuchár</th><td>{{ $bar->chef }}</td></tr>
                                <tr><th class="bg-light">Telefón</th><td>{{ $bar->phone }}</td></tr>
                                <tr><th class="bg-light">Vytvorený</th><td>{{ optional($bar->created_at)->format('Y-m-d H:i') }}</td></tr>
                                <tr><th class="bg-light">Upravený</th><td>{{ optional($bar->updated_at)->format('Y-m-d H:i') }}</td></tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Poznámky k baru (polymorf) --}}
                        @php $barNotes = method_exists($bar, 'notes') ? $bar->notes()->with('author')->latest()->get() : collect(); @endphp
                        @if($barNotes->count() || View::exists('admin::users.partials.notes'))
                            @includeWhen(View::exists('admin::users.partials.notes'), 'admin::users.partials.notes', [
                                'modelClass' => \App\Models\Bar::class,
                                'modelId'    => $bar->id,
                                'notes'      => $barNotes,
                            ])
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light border" data-dismiss="modal">Zavrieť</button>
                    </div>
                </div></div>
        </div>
    @endforeach


@endsection

@section('js')
    @parent
    <script>
        // BS4 custom-file label
        document.addEventListener('change', function(e){
            if(e.target && e.target.classList.contains('custom-file-input')){
                e.target.nextElementSibling.innerText = e.target.files[0]?.name || '{{ __('admin.choose_file') ?? 'Choose file' }}';
            }
        });
    </script>
@endsection
