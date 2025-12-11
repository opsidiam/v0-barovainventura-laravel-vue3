@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">

                {{-- Header --}}
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">{{ __('admin.partner_create_title') }}</h1>
                    <div class="d-flex flex-wrap">
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-light border">
                            <i class="fas fa-arrow-left mr-1"></i> {{ __('admin.back_to_list') }}
                        </a>
                    </div>
                </div>

                {{-- Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>{{ __('admin.form_has_errors') }}</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form card --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ __('admin.partner_basic_info') }}
                        </h6>
                        <small class="text-muted d-none d-md-inline">{{ __('admin.required_hint') }}</small>
                    </div>

                    <form method="POST" action="{{ route('admin.partners.update', $partner->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="first_name">{{ __('admin.table.first_name') }} *</label>
                                    <input type="text" id="first_name" name="first_name"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           value="{{ old('first_name', $partner->first_name) }}" required maxlength="100">
                                    @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="last_name">{{ __('admin.table.last_name') }} *</label>
                                    <input type="text" id="last_name" name="last_name"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           value="{{ old('last_name', $partner->last_name) }}" required maxlength="100">
                                    @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="company">{{ __('admin.table.company') }}</label>
                                    <input type="text" id="company" name="company"
                                           class="form-control @error('company') is-invalid @enderror"
                                           value="{{ old('company', $partner->company) }}" maxlength="150">
                                    @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="email">{{ __('admin.table.mail') }} *</label>
                                    <input type="email" id="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $partner->email) }}" required maxlength="150">
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="phone">{{ __('admin.table.phone') }}</label>
                                    <input type="text" id="phone" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone', $partner->phone) }}" maxlength="40">
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="commission_per_client">{{ __('admin.table.commission') }}</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" min="0" id="commission_per_client" name="commission_per_client"
                                               class="form-control @error('commission_per_client') is-invalid @enderror"
                                               value="{{ old('commission_per_client', $partner->commission_per_client ?? 20) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">€</span>
                                        </div>
                                        @error('commission_per_client') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                    <small class="form-text text-muted">{{ __('admin.commission_help') }}</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">{{ __('admin.table.note') }}</label>
                                <textarea id="note" name="note" rows="3"
                                          class="form-control @error('note') is-invalid @enderror"
                                          maxlength="2000">{{ old('note', $partner->note) }}</textarea>
                                @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-light border">
                                {{ __('admin.cancel') }}
                            </a>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save mr-1"></i> {{ __('admin.save') }}
                            </button>
                        </div>
                    </form>
                </div>

                {{-- (Voliteľne) Malý prehľad štatistík k partnerovi --}}
                @isset($stats)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Klienti spolu
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['clients_total'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Vyplatené provízie
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['paid_total'] ?? 0, 2, ',', ' ') }} €</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Čakajúce provízie
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['pending_total'] ?? 0, 2, ',', ' ') }} €</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

            </div>
        </div>
    </div>
@endsection
